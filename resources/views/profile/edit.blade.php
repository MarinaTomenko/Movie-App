
@extends('layouts.app')

@section('content')


<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <!-- Обновление информации профиля -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Profile Information') }}</h4>
                    <p class="card-category">{{ __("Update your account's profile information and email address.") }}</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <!-- Обновление пароля -->
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Update Password') }}</h4>
                    <p class="card-category">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Удаление аккаунта -->
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header card-header-danger">
                    <h4 class="card-title">{{ __('Delete Account') }}</h4>
                    <p class="card-category">{{ __('Permanently delete your account.') }}</p>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 