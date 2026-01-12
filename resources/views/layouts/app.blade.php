<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema Académico')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="sidebar">
    <img src="{{ asset('img/logo1.png') }}" alt="Logo" />
    <h2>Sistema Académico</h2>

    <ul>
        <li><a href="#">🏠 Inicio</a></li>
        <li><a href="{{ route('carreras.index') }}" class="active">🎓 Carreras</a></li>
        <li><a href="#">👩‍🏫 Docentes</a></li>
        <li><a href="#">📘 Materias</a></li>
    </ul>
</div>

<div class="main">
    @yield('content')
</div>
@yield('scripts') <!-- <-- Aquí se cargan los scripts de cada Blade -->

</body>
</html>
