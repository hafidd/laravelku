<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="min-h-screen w-full flex flex-col">
        <div class="flex p-2 px-4 border-b w-full justify-between">
            <p class="font-bold text-lg">Laravelku</p>
            @if (Route::has('login'))
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="px-1">Logout</button>
                    </form>
                @else
                    <div class="">
                        <a href="{{ route('login') }}"
                            class="{{ Route::is('login') ? 'font-bold' : '' }} mr-2 mb-2">Login</a>
                        <a href="{{ route('register') }}"
                            class="{{ Route::is('register') ? 'font-bold' : '' }}">Register</a>
                    </div>
                @endauth
            @endif
        </div>
        @yield('content')
    </div>
</body>

</html>
