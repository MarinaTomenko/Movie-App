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
                                    <h4 class="card-title">Lists:</h4>
                                </div>
                                <div class="card-body">
                                    <p>{{ __("You're logged in!") }}</p>
                                </div>
        
                                <div class="d-inline-block">
                                <a href="{{ route('collections.create') }}" class="btn btn-primary btn-sm">
                                Create Your Own List
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection