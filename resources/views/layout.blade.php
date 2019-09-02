<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}"/>

    <title>Document</title>
</head>
<body>
<a href="{{ route('empleados.index') }}">Lista de empleados</a>
@yield('content')

</body>
</html>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')