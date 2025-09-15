<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TaskManager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="page-wrapper">
    <nav>
            <div class="header">
                <div class="nav-menu">
                        <a class="nav-link" href="{{ route('tasks.index') }}">Главная</a>
                        <a class="nav-link" href="{{ route('tasks.create') }}">Создать задачу</a>
                        <a class="nav-link" href="{{ route('tasks.show', ['id' => $user['id']]) }}">Мои задачи</a>

                        <a>{{ $user['name'] }}</a>
                        <div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                            this.closest('form').submit();">
                                    {{ __('Выйти') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                </div>
            </div>
    </nav>
    <div class="flex-grow-1 container my-4">
        @yield('content')
    </div>

    <footer>
        <div class="footer">
            footer
        </div>
    </footer>
</div>
</body>
</html>
