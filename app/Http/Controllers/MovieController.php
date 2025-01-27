<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Cast;
class MovieController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q'); // Термин поиска
        $page = $request->input('page', 1); // Номер страницы
    
        // Поиск фильмов по названию
        $movies = Movie::where('title', 'ilike', '%' . $query . '%')
            ->orderBy('title')
            ->paginate(10, ['*'], 'page', $page);
    
        // Форматирование результатов для Select2
        $results = $movies->map(function ($movie) {
            return [
                'id' => $movie->id,
                'text' => $movie->title,
                'title' => $movie->title,
                'year' => $movie->release_date,
                'image' => $movie->image_path
            ];
        });
    
        return response()->json([
            'results' => $results,
            'more' => $movies->hasMorePages() // Есть ли еще данные для загрузки
        ]);
    }
}
