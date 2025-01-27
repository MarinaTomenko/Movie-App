
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create List</title>
</head>

    @extends('layouts.app')

    @section('content')
        <div class="wrapper">
            <div class="main-panel">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">Create List</h4>
                                        <p class="card-category">Fill in the details to create a new list</p>
                                    </div>
                                    <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        </div>
                                    @endif
                                        <form action="{{ route('collections.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="listName">List Name</label>
                                                <input type="text" class="form-control" id="listName" name="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="listDescription">Description</label>
                                                <textarea class="form-control" id="listDescription" name="description" rows="4" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="movies">Select Movies</label>
                                                
                                                <select class="form-control select2" id="movies" name="movies[]" multiple="multiple" required>
                                                    @foreach($movies as $movie)
                                                        <option value="{{ $movie->id }}" 
                                                                data-title="{{ $movie->title }}" 
                                                                data-year="{{ $movie->release_date }}" 
                                                                data-image="{{ $movie->image_path }}">
                                                            {{ $movie->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="selected-movies" id="selectedMovies">
                                                <h5>Selected Movies:</h5>
                                                <div class="row" id="selectedMoviesList"></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Create List</button>
                                                <a href="{{ route('collections.index') }}" class="btn btn-secondary">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .form-control {
                border: 1px solid #007bff;
                border-radius: 0.25rem;
            }

            .form-control:focus {
                border-color: #0056b3;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            .movie-item {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }

            .movie-item img {
                width: 50px;
                height: auto;
                margin-right: 10px;
            }
        </style>

        <script>
            $(document).ready(function() {
    $('#movies').select2({
        placeholder: "Select movies",
        allowClear: true,
        ajax: {
            url: "{{ route('movies.search') }}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;

                return {
                    results: data.results,
                    pagination: {
                        more: data.more
                    }
                };
            },
            cache: true
        },
        minimumInputLength: 1
    });

    $('#movies').on('change', function() {
        $('#selectedMoviesList').empty();
        $(this).find('option:selected').each(function() {
            var title = $(this).data('title');
            var year = $(this).data('year');
            var image = $(this).data('image');

            if (!title || !year || !image) {
                console.error('Missing data for selected movie:', { title, year, image });
                return;
            }

            $('#selectedMoviesList').append(
                '<div class="movie-item">' +
                    '<img src="' + image + '" alt="' + title + '">' +
                    '<span>' + title + ' (' + year + ')</span>' +
                '</div>'
            );
        });
    });
});
        </script>
    @endsection


