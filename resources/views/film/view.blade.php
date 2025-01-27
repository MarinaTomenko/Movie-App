@extends('layouts.app')

@section('title', 'This Film')

@section('content')
    <div class="container">
    <div class="row">
  
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ $movie->title }}</h4>
                    <h5 class="card-overview">{{ $movie->overview }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="d-flex justify-content-left align-items-center"> 
                                @if ($movie->full_image_url)
                                    <img src="{{ $movie->full_image_url }}" class="card-img-top w-25" alt="{{ $movie->title }}" loading="lazy">
                                @else
                                    <img src="https://via.placeholder.com/200x300" class="card-img-top w-25" alt="Изображение отсутствует" loading="lazy">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-cast-tab" data-bs-toggle="tab" data-bs-target="#nav-cast" type="button" role="tab" aria-controls="nav-cast" aria-selected="true">Cast</button>
                                    <button class="nav-link" id="nav-crew-tab" data-bs-toggle="tab" data-bs-target="#nav-crew" type="button" role="tab" aria-controls="nav-crew" aria-selected="false">Crew</button>
                                    <button class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" data-bs-target="#nav-detail" type="button" role="tab" aria-controls="nav-detail" aria-selected="false">Details</button>
                                    <button class="nav-link" id="nav-genre-tab" data-bs-toggle="tab" data-bs-target="#nav-genre" type="button" role="tab" aria-controls="nav-genre" aria-selected="false">Genres</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-cast" role="tabpanel" aria-labelledby="nav-cast-tab">
                                    <h4>Cast:</h4>
                                    <ul>
                                        @if($movie->movieCasts->isNotEmpty())
                                            <ul>
                                                @foreach ($movie->movieCasts as $movieCast)
                                                    <li>
                                                        <strong>{{ $movieCast->character_name }}:</strong> {{ $movieCast->person->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No crew information available.</p>
                                        @endif
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="nav-crew" role="tabpanel" aria-labelledby="nav-crew-tab">
                                    <h4>Crew:</h4>
                                    <ul>
                                        @foreach ($movie->movieCrews as $movieCrew)
                                            <li>
                                                <strong>{{ $movieCrew->department->name }}:</strong> {{ $movieCrew->person->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                                    <h4>Languages:</h4>
                                    <ul>
                                        @if($movie->languages->isNotEmpty())
                                            <ul>
                                                @foreach ($movie->languages as $language)
                                                    <li>
                                                        <strong>{{ $language->code }}:</strong> {{ $language->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No language information available.</p>
                                        @endif
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="nav-genre" role="tabpanel" aria-labelledby="nav-genre-tab">
                                    <h4>Genres:</h4>
                                    <ul>
                                        @if($movie->genres->isNotEmpty())
                                            <ul>
                                                @foreach ($movie->genres as $genre)
                                                    <li>
                                                        <strong>Genre:</strong> {{ $genre->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <p>No genre information available.</p>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        
    </div>
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