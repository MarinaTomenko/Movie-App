<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Cast;
use App\Models\Person;
use App\Models\Crew;
class FilmController extends Controller
{
    public function show(Request $request)
    {
        $movie = Movie::with(['apiRequest']);     



        return view('film.show', [
            'user' => $request->user(),
        ], compact('movie', ));
    }
    public function view($id) {
        // Загружаем фильм с apiRequest, жанрами, людьми и актерами
        $movie = Movie::with([
            'apiRequest', 
            'genres', 
            'people',
            'movieCasts',
            'movieCrews',
            'languages',
        ])->find($id);
    //dd($movie->genres);
        if (!$movie) {
            return abort(404);
        }
    
        // Добавляем full_image_url, если есть image_path
        if ($movie->apiRequest && $movie->apiRequest->image_path) {
            $movie->full_image_url = 'https://image.tmdb.org/t/p/w400' . $movie->apiRequest->image_path;
        } else {
            $movie->full_image_url = null;
        }
    
        return view("film.view", compact("movie"));
    }
    public function index()
    {
        
        $movies = Movie::with(['genres', 'apiRequest'])->paginate(12);
    
        $allGenres = [];
        foreach ($movies as $movie) {
           
            if ($movie->genres) {
         
                foreach ($movie->genres as $genre) {
                   
                    $allGenres[] = $genre->name; 
                }
            }
    
            if ($movie->apiRequest && $movie->apiRequest->image_path) {
                $movie->full_image_url = 'https://image.tmdb.org/t/p/w400' . $movie->apiRequest->image_path;
            } else {
                $movie->full_image_url = null; 
            }
        }
    
       
        //$allGenres = array_unique($allGenres);
    
        return view('film.index', compact('movies', 'allGenres'));
    }
}
