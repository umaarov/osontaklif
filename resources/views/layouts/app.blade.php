<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsonTaklif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .header {
            width: 100%;
            background: #f8f9fa;
            padding: 15px 0;
            position: relative;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content-wrapper {
            flex: 1;
            padding-top: 70px;
            padding-bottom: 40px;
        }
    </style>
</head>
<header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"
         style="position: fixed; top: 0; width: 100%; z-index: 100;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">OsonTaklif</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('mock') }}">Mock</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('requirements') }}">Requirements</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body>
<div class="content-wrapper">
    <div class="container">
        @yield('content')
    </div>
</div>
</body>

<footer class="footer text-center mt-auto">
    <div class="container d-flex flex-column align-items-center py-3 mb-4">
        <p class="mb-2 text-secondary fw-semibold">Osontaklif by Umarov Ismoiljon</p>
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

</html>
