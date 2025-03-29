<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OsonTaklif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Global Layout */
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

        /* Shared Components */
        .page-title {
            margin-top: 8px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .page-subtitle {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .content-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
        }

        .main-content {
            flex: 3;
            min-width: 60%;
        }

        /* Cards and Grids */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-top: 25px;
        }

        .item-card {
            border: 1px solid #ccc;
            padding: 15px;
            text-align: center;
            display: block;
            text-decoration: none;
            color: black;
            transition: 0.2s ease;
            border-radius: 5px;
        }

        .item-card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .content-box {
            border: 1px solid #D2D2D2;
            padding: 15px;
            border-radius: 5px;
            position: relative;
        }

        .timestamp {
            font-size: 0.9em;
            color: #777;
            margin-top: 10px;
        }

        /* Forms */
        .search-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .search-input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: 0.3s ease-in-out;
            font-size: 16px;
        }

        .search-input:focus {
            border-color: #007bff;
        }

        .filter-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .radio-group {
            display: flex;
            gap: 10px;
        }

        /* Buttons */
        .btn-primary {
            padding: 8px 12px;
            border: 1px solid #007bff;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn-outline {
            padding: 8px 12px;
            border: 1px solid #007bff;
            background-color: transparent;
            color: #007bff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-outline:hover, .btn-primary:hover {
            opacity: 0.85;
        }

        /* Tables */
        .data-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead tr {
            border-bottom: 2px solid #ddd;
        }

        .data-table th, .data-table td {
            padding: 10px;
            text-align: left;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #eee;
        }

        .table-link {
            text-decoration: none;
            color: #007bff;
        }

        /* Alerts */
        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Ad Space */
        .ad-container {
            flex: 1;
            min-width: 250px;
            background-color: #f9f9f9;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
