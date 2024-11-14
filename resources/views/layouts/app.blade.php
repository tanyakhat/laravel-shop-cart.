<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин Татьяна</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mx-5" href="{{ route('home') }}">Онлайн-Магазин Татьяна</a>
    <ul class="navbar-nav mr-auto">
{{--        <li class="nav-item active">--}}
{{--            <a class="nav-link" href="{{ route('home') }}">Главная</a>--}}
{{--        </li>--}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.index') }}">Корзина</a>
        </li>
    </ul>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
