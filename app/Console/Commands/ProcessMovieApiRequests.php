<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;
use App\Models\MovieApiRequest;
use Illuminate\Support\Facades\Storage;

class ProcessMovieApiRequests extends Command
{
    protected $signature = 'movie:process 
                            {--i|init= : Initialize N new movie API requests}
                            {--g|get-images : Download poster images for ready records}';

    protected $description = 'Process movie API requests and download images';

    private const API_URL = 'https://api.themoviedb.org/3/search/movie';
    private const API_TOKEN = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJmMGEwMzJmMDA0NDFkNGYzOTA2YzUxODc4M2E1OTY5NCIsIm5iZiI6MTczMTk4NDY0Mi43NDg5MTUyLCJzdWIiOiI2NzNiZjJmYThmYmMwODk2MWEyMzhlODciLCJzY29wZXMiOlsiYXBpX3JlYWQiXSwidmVyc2lvbiI6MX0.IJ64t0IDNv6hH_vV1OiFOARf_uVE7R8N_a2yf3yGoaQ';

    
    public function handle()
    {
        if ($this->option('init') !== null) {
            $limit = (int)$this->option('init');
            $created = $this->createPendingRequests($limit);
            $this->info("Created {$created} new API requests");
        }
    
        if ($this->option('get-images')) {
            return $this->downloadImages();
        }
    
        $requests = MovieApiRequest::where('status', 'init')->limit(100)->get();
    
        if ($requests->isEmpty()) {
            $this->info('No pending requests to process');
            return 0;
        } else {
            $this->info("Found {$requests->count()} pending requests to process");
        }
    
        foreach ($requests as $request) {
            try {
                $movie = Movie::find($request->movie_id);
    
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . self::API_TOKEN,
                    'Accept' => 'application/json',
                ])->get(self::API_URL, [
                    'query' => $movie->title,
                    'include_adult' => false,
                    'language' => 'en-US',
                    'page' => 1,
                ]);
    
                $this->info("API response status for movie ID {$movie->id} - {$movie->title}: " . $response->status());
    
                if ($response->status() !== 200) {
                    $this->error("API request failed for movie ID {$movie->id} - {$movie->title}. Status code: " . $response->status());
                    $request->status = 'error';
                    $request->save();
                    continue;
                }
    
                $results = $response->json();
    
                $this->info("API response for movie ID {$movie->id} - {$movie->title}:");
                $this->info(json_encode($results, JSON_PRETTY_PRINT));
    
                if (!isset($results['results']) || empty($results['results'])) {
                    $this->info("No results found for movie ID {$movie->id} - {$movie->title}");
                    $request->status = 'notfound';
                    $request->save();
                    continue;
                }
    
                $bestMatch = null;
                $highestSimilarity = 0;
    
                foreach ($results['results'] as $result) {
                    $similarity = similar_text(
                        strtolower($movie->title),
                        strtolower($result['title']),
                        $percent
                    );
    
                    if ($percent > $highestSimilarity) {
                        $highestSimilarity = $percent;
                        $bestMatch = $result;
                    }
                }
    
                if ($bestMatch && $highestSimilarity > 70) {
                    $request->json_response = json_encode($bestMatch);
                    $request->status = 'ready';
                    $request->image_path = $bestMatch['poster_path'] ?? null;

                    $this->info("Saving data for movie ID {$movie->id}:");
                    $this->info("JSON Response: " . $request->json_response);
                    $this->info("Image Path: " . $request->image_path);
                } else {
                    $request->status = 'notfound';
                    $this->info("No match found for movie ID {$movie->id} - {$movie->title}");
                }
    
                $request->save();
                $this->info("Processed movie ID: {$movie->id} - {$movie->title}");
    
            } catch (\Exception $e) {
                $this->error("Error processing movie ID {$request->movie_id}: " . $e->getMessage());
                $request->status = 'error';
                $request->save();
            }
    
            sleep(1);
        }
    
        return 0;
    }
    private function createPendingRequests(int $limit = 1): int
    {
        // Находим фильмы, для которых ещё не созданы запросы
        $movies = Movie::leftJoin('movie_api_requests', 'movie_api_requests.movie_id', '=', 'movies.id')
            ->whereNull('movie_api_requests.id') 
            ->select('movies.*') 
            ->limit($limit)
            ->get();
    
        $count = 0;
        foreach ($movies as $movie) {
            $request = new MovieApiRequest([
                'movie_id' => $movie->id,
                'status' => 'init',
            ]);
    
            if ($request->save()) {
                $count++;
            }
        }
    
        return $count;
    }
    private function downloadImages(): int
    {
        $requests = MovieApiRequest::where('status', 'ready')
            ->whereNotNull('image_path')
            ->get();

        if ($requests->isEmpty()) {
            $this->info('No images to download');
            return 0;
        }

        $baseImageUrl = 'https://image.tmdb.org/t/p/w400';
        $targetDir = storage_path('app/public/movies');

        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        foreach ($requests as $request) {
            try {
                $imageUrl = $baseImageUrl . $request->image_path;
                $extension = pathinfo($request->image_path, PATHINFO_EXTENSION) ?: 'png';
                $targetPath = $targetDir . 'public/movies/poster_' . $request->movie_id . '.' . $extension;
                $relativeImagePath = 'movies/poster_' . $request->movie_id . '.' . $extension;

                if (file_exists($targetPath)) {
                    $this->info("Image already exists for movie ID: {$request->movie_id}");
                    continue;
                }

                $response = Http::get($imageUrl);

                $movie = Movie::find($request->movie_id);
                if ($response->status() === 200) {
                    file_put_contents($targetPath, $response->body());
                    $this->info("Downloaded image for movie ID: {$request->movie_id}");

                    $movie->image_path = $relativeImagePath;
                    $request->status = 'processed';

                    if ($movie->save()) {
                        $this->info("Updated poster path for movie ID: {$request->movie_id}");
                    } else {
                        $this->error("Failed to update poster path for movie ID: {$request->movie_id}");
                    }

                } else {
                    $request->status = 'noimage';
                    $this->error("Failed to download image for movie ID: {$request->movie_id}");
                }

                $request->save();

                sleep(1);
            } catch (\Exception $e) {
                $this->error("Error downloading image for movie ID {$request->movie_id}: " . $e->getMessage());
            }
        }

        return 0;
    }
}
