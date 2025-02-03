@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary text-center">
                                    <h4 class="card-title">List by:</h4>
                                    <div class="d-flex justify-content-center">
                                        @if ($collection->user->name)
                                            <h5 class="card-title">{{ $collection->user->name }}</h5>
                                        @else
                                            <h5 class="card-title">No Owner</h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    
                                </div>

                                <div class="row">
                                    @foreach($movies as $movie)
                                        <div class="col-md-4 mb-4">
                                            <div class="card square-card">
                                                <div class="card-header card-header-primary text-center">
                                                    <h4 class="card-title">{{ $movie->title }}</h4>
                                                </div>
                                                <div class="d-flex justify-content-center">
                                               
                                                
                                                @if ($movie->full_image_url)
                                                    <img src="{{ $movie->full_image_url }}" class="card-img-top w-50" alt="{{ $movie->title }}" loading="lazy">
                                                @else
                                                    <img src="https://via.placeholder.com/200x300" class="card-img-top w-50" alt="Изображение отсутствует" loading="lazy">
                                                @endif
                                                </div>
                                                <div class="card-body">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                             
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $movies->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
.square-card {
    width: 100%;
    aspect-ratio: 1 / 1;
    overflow: hidden; 
    border-radius: 8px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    display: flex;
    flex-direction: column;
}

.card-img-container {
    flex: 1; 
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden; 
}

.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}

.card-header, .card-body {
    padding: 10px; 
}

.card-title {
    font-size: 1.2rem; 
    margin-bottom: 0; 
}

.card-text {
    font-size: 0.9rem; 
    margin-bottom: 10px;
}

.btn-sm {
    font-size: 0.8rem; 
    padding: 5px 10px; 
}
</style>