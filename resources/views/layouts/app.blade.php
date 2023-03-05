<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TwiStar') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">メニュー1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">メニュー2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">メニュー3</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">メニュー4</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">メニュー5</a>
                        </li>
                        <li class="nav-item">
                            <!-- Authentication Links -->
                            @guest
                                <!-- @if (Route::has('login'))
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif -->
                                <!-- @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif -->
                            @else
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    ログアウト
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            @endguest
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="footer">
        <div class="container text-center">
        <p class="text-muted">©︎{{ config('app.name', 'TwiStar') }}</p>
        </div>
    </footer>

</body>

<style>
    html {
        position: relative;
        min-height: 100%;
    }
    body {
        margin-bottom: 60px;
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px;
        background-color: #312d2a;
    }
    .container {
        width: auto;
        max-width: 680px;
        padding: 0 15px;
    }
    .container .text-muted {
        margin: 20px 0;
    }

</style>
</html>
