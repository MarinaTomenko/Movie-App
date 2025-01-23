<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Cast;
class FilmController extends Controller
{
    public function show(Request $request)
    {
        return view('film.show', [
            'user' => $request->user(),
        ]);
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
