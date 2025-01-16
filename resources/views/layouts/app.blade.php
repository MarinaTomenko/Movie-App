<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Movie-App') }}</title>

        <!-- Подключение Material Dashboard CSS -->
        <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet">

        <!-- Подключение Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <!-- Боковая панель (если используется) -->
            <div class="sidebar" data-color="purple" data-background-color="white">
                <!-- Содержимое боковой панели -->
            </div>

            <!-- Основной контент -->
            <div class="main-panel">
                <!-- Навигация -->
                @include('layouts.navigation')

                <!-- Контент страницы -->
                <div class="content">
                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Подключение PerfectScrollbar -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/perfect-scrollbar/1.5.5/perfect-scrollbar.min.js"></script>

        <!-- Подключение jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Подключение Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Подключение Material Dashboard JS -->
        <script src="{{ asset('js/material-dashboard.js') }}"></script>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Инициализация PerfectScrollbar -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sidebar = document.querySelector('.sidebar');
                if (sidebar) {
                    new PerfectScrollbar(sidebar);
                }

                const mainPanel = document.querySelector('.main-panel');
                if (mainPanel) {
                    new PerfectScrollbar(mainPanel);
                }
            });
        </script>
    </body>
</html>