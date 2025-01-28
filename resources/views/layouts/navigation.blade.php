<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <!-- Логотип и бренд -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            {{ config('app.name', 'MovieGroove') }}
        </a>

        <!-- Кнопка для мобильного меню -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Основное меню -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <!-- Ссылки навигации -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-link-text">{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="nav-item">
    <a class="nav-link" href="{{ route('films') }}">
        <i class="material-icons">local_movies</i>
        <span class="nav-link-text">{{ __('Films') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('series') }}">
        <i class="material-icons">tv</i>
        <span class="nav-link-text">{{ __('Series') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('members') }}">
        <i class="material-icons">people</i>
        <span class="nav-link-text">{{ __('Members') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('collections.index') }}">
        <i class="material-icons">receipt_long</i>
        <span class="nav-link-text">{{ __('Lists') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('blog') }}">
        <i class="material-icons">article</i>
        <span class="nav-link-text">{{ __('Blog') }}</span>
    </a>
</li>
                <!-- Выпадающее меню для профиля -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <span class="nav-link-text">{{ auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>