<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #343a40;
            padding: 15px 0;
        }

        .navbar-custom .navbar-brand {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #fff;
            font-size: 18px;
            margin-right: 20px;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: #ffc107;
        }

        body {
            background-image: url('/img/wallpaper.png');
            background-size: cover;
            background-color: #343a40;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            image-resolution: brightness(70%) blur(3px);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">@yield('module_name')</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Página principal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tareas-en-proceso') }}">Tareas en proceso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/lista-de-tareas') }}">Lista de tareas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('welcome')

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>

<footer class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="social-links mb-4">
                <a href="https://www.linkedin.com/in/leonardo-rodriguez-developer/" target="_blank" class="social-link" style="margin-right: 10px;">
                    <i class="fab fa-linkedin fa-lg" style="color: #FFFFFF; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); font-size: 24px;"></i>
                </a>
                <a href="https://www.instagram.com/leoru88/" target="_blank" class="social-link" style="margin-right: 10px;">
                    <i class="fab fa-instagram fa-lg" style="color: #FFFFFF; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); font-size: 24px;"></i>
                </a>
                <a href="https://www.facebook.com/leonardo.rodriguez.uzcategui/" target="_blank" class="social-link">
                    <i class="fab fa-facebook-f fa-lg" style="color: #FFFFFF; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); font-size: 24px;"></i>
                </a>
            </div>
            <p style="color: #FFFFFF;">© 2024 Ing. Leonardo Rodríguez.</p>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

</html>