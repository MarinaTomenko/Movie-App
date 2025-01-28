<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function index()
    {
        
        $collections = Collection::with(['movies'])->get();
      
        foreach ($collections as $collection) {
            $collection->imageUrl = null; // Инициализируем свойство
            if ($collection->movies && count($collection->movies) > 0) {
                foreach ($collection->movies as $movie) {
                    if ($movie->apiRequest && $movie->apiRequest->image_path) {
                        
                        $collection->imageUrl = 'https://image.tmdb.org/t/p/w400' . $movie->apiRequest->image_path;
                        break; 
                    }
                }
            }
        }
        

        $movies = Movie::with('apiRequest')->paginate(2);
 
        $movie = Movie::with('apiRequest')->first();
    
        if ($movie->apiRequest && $movie->apiRequest->image_path) {
            $movie->full_image_url = 'https://image.tmdb.org/t/p/w400' . $movie->apiRequest->image_path;
        } else {
            $movie->full_image_url = null;
        }
    
        return view('collection.index', compact('collections', 'movies', 'movie'));
    }

    public function create()
    {
        $movies = []; // Получите все фильмы из базы данных
        return view('collection.create', compact('movies'));
    }

    public function store(Request $request) {
       
        $validated = $request->validate([
            "title" => ["required", "string"],
            "description" => ["required", "string"],
            "movies" => ["nullable", "array"],
        ]);
        //dd($request->movies);

        $list = Collection::create([
            'title' => $request->title,
            'description' => $request->description,
            // 'movies' => $request->movies,
            'user_id' => Auth::id(),
        ]);

        //if (!empty($request->movies)) {
          //  $list->movies()->sync($request->movies);
       // }

        if (!empty($request->movies)) {
            $movieIds = is_array($request->movies) ? $request->movies : [$request->movies];
            $list->movies()->sync($movieIds);
        }
        
    
        return redirect()->route("collections.index")->with("success", "List created!");
    }


    public function view($id) {
        // Загружаем фильм с apiRequest, жанрами, людьми и актерами
        $collection = Collection::with([
            'movies',   
        ])->find($id);

        $movie = Movie::with([
            'apiRequest',    
        ])->find($id);
        if (!$collection) {
            return abort(404);
        }

        if ($movie->apiRequest && $movie->apiRequest->image_path) {
            $movie->full_image_url = 'https://image.tmdb.org/t/p/w400' . $movie->apiRequest->image_path;
        } else {
            $movie->full_image_url = null;
        }
    
        return view("collection.view", compact("movie", "collection"));
    }
}
