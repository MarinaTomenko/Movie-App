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
        $collections = Collection::paginate(10);

         return view('collection.index', compact('collections'));
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
        dd($request->movies);

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
}
