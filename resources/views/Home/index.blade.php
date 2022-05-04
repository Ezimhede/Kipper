<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Scripts -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>

    <title>Kipper</title>
</head>
<body class="homepage">

<!-- the navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">KIPPER</a>

        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">about us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">faq</a>
                </li>
            </ul>
        </div>
        <div class="" >
            <a href="{{route("login")}}"><button class="btn btn-outline-dark login">login</button></a>
            <a href="{{route("register")}}"><button class="btn btn-outline-dark register">register</button></a>
        </div>
    </div>
</nav>

<div class="container-fluid banner">
    <p class="text-center">Kipper is the best way to make sure your bank cards, vehicle documents and other
           important items don't expire without your knowledge
        </p>

</div>

</body>
</html>
