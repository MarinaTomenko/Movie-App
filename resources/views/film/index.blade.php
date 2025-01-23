@extends('layouts.app')

@section('title', 'All Films')

@section('content')
    <h1>All Films</h1>
    <div class="row">
        @foreach($movies as $movie)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Центрируем только изображение -->
                    <div class="d-flex justify-content-center">
                        @if ($movie->full_image_url)
                            <img src="{{ $movie->full_image_url }}" class="card-img-top w-50" alt="{{ $movie->title }}" loading="lazy">
                        @else
                            <img src="https://via.placeholder.com/200x300" class="card-img-top w-50" alt="Изображение отсутствует" loading="lazy">
                        @endif
                    </div>
                    <!-- Заголовок и тело карточки -->
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ $movie->title }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ str()->limit($movie->overview, 100) }}</p> <!-- Ограничиваем описание до 100 символов -->
                        <p class="card-text">
                            Genres: 
                            @foreach($movie->genres as $genre)
                                <span class="badge badge-primary">{{ $genre->name }}</span>
                            @endforeach
                        </p>
                        <!-- Кнопка для открытия модального окна -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#movieModal{{ $movie->id }}">
                            More...
                        </button>
                    </div>
                </div>
            </div>

            <!-- Модальное окно для каждого фильма -->
            <div class="modal fade" id="movieModal{{ $movie->id }}" tabindex="-1" aria-labelledby="movieModalLabel{{ $movie->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="movieModalLabel{{ $movie->id }}">{{ $movie->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ $movie->full_image_url }}" class="img-fluid mb-3" alt="{{ $movie->title }}">
                            <p><strong>Overview:</strong> {{ $movie->overview }}</p>
                            <p><strong>Genres:</strong> 
                                
                                @if($movie->genres->isEmpty())
                                    <span>No genres available</span>
                                @else
                                    @foreach($movie->genres as $genre)
                                    <span class="badge badge-primary">{{ $genre->name }}</span>
                                    @endforeach
                                @endif
                            </p>
                    
                            <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
                            <p><strong>Rating:</strong> {{ $movie->vote_average }}/10</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
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