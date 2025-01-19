@extends('layouts.app')

@section('title', 'Все Фильмы')

@section('content')
    <h1>Все Фильмы</h1>
    <div class="row">
        @foreach($movies as $movie)
            <div class="col-md-4 mb-4">
                <div class="card">
                <div class="d-flex justify-content-center">
                    <!-- Проверяем, есть ли изображение -->
                    @if ($movie->full_image_url)
                        
                        <img src="{{ $movie->full_image_url }}" class="card-img-top w-50" alt="{{ $movie->title }}" loading="lazy">
                    @else
                        <img src="https://via.placeholder.com/200x300" class="card-img-top movie-image" alt="Изображение отсутствует" loading="lazy">
                    @endif
                    </div>
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ $movie->title }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $movie->description }}</p>
                        <p class="card-text">
                            Жанры: 
                            @foreach($movie->genres as $genre)
                                <span class="badge badge-primary">{{ $genre->name }}</span>
                            @endforeach
                        </p>
                        <a href="#" class="btn btn-primary">Подробнее</a>
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Пагинация -->
    <div class="mt-4">
        {{ $movies->links() }} <!-- Это создаст ссылки для пагинации -->
    </div>
@endsection

@section('styles')
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination li {
            margin: 0 5px;
            list-style: none;
        }
        .pagination li a {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
            text-decoration: none;
        }
        .pagination li.active a {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .pagination li a:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection