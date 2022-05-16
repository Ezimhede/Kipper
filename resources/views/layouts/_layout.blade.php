<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kipper</title>
    <link rel="icon" type="image/png" href="{{asset('Favicon.png')}}">

    <!-- Fonts -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Scripts -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div>
            <a class="navbar-brand" href="#">KIPPER</a>
{{--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"--}}
{{--                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}
        </div>
        <div class="" id="navbarText">
            <h6 class="d-inline">Welcome {{Auth::user()->firstName}}</h6>
{{--            <a href="{{route("logout")}}"><button class="btn btn-outline-dark">Log out</button></a>--}}
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <a href="{{route("logout")}}"><button class="btn btn-outline-dark">Log out</button></a>
            </form>
        </div>
    </div>
</nav>

@yield('index')
</body>
</html>
