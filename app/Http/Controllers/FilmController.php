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
        // Получаем все фильмы с пагинацией и загружаем связанные жанры
        $movies = Movie::with('genres')->paginate(10);
    
        $allGenres = [];
        foreach ($movies as $movie) {
            // Проверяем, что жанры загружены и не являются null
            if ($movie->genres) {
                // Получаем массив жанров для текущего фильма
                foreach ($movie->genres as $genre) {
                    // Предполагаем, что у жанра есть поле 'name' в таблице 'genres'
                    $allGenres[] = $genre->name; // Замените 'name' на поле, содержащее название жанра
                }
            }
        }
    
        // Убираем дубликаты жанров, если они есть
        $allGenres = array_unique($allGenres);
    
        // Возвращаем представление с переданными фильмами
        return view('film.index', compact('movies', 'allGenres'));
    }
}
