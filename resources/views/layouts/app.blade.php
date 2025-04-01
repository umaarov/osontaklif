<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>OsonTaklif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2989575196315667"
            crossorigin="anonymous"></script>
    <meta name="google-adsense-account" content="ca-pub-2989575196315667">
</head>
<body class="d-flex flex-column min-vh-100">
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"
         style="position: fixed; top: 0; width: 100%; z-index: 100;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">OsonTaklif</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('mock') }}">Mock</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('requirements') }}">Requirements</a></li>
                </ul>
                <div class="d-flex">
                    <a href="https://www.buymeacoffee.com/umarov" target="_blank" class="btn btn-warning btn-sm">
                        <i class="fa fa-coffee me-1"></i> Buy me a coffee
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="content-wrapper">
    <div class="container">
        @yield('content')
    </div>
</div>

<footer class="footer text-center mt-auto">
    <div class="container d-flex flex-column align-items-center py-3 mb-4">
        <p class="mb-2 text-secondary fw-semibold">{{__('osontaklif_by_umarov_ismoiljon')}}</p>
        <div class="d-flex gap-3">
            <a href="https://telegram.me/dribbblxr" target="_blank" class="text-dark">
                <i class="fab fa-telegram fa-lg"></i>
            </a>
            <a href="https://github.com/umaarov" target="_blank" class="text-dark">
                <i class="fab fa-github fa-lg"></i>
            </a>
            <a href="https://linkedin.com/in/umaarov" target="_blank" class="text-dark">
                <i class="fab fa-linkedin fa-lg"></i>
            </a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
