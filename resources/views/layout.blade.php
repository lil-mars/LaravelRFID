<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.min.css') }}"/>

    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Kantuta</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{ route('empleados.index') }}">Lista de empleados</a>
            <a class="nav-item nav-link" href="{{ route('reports.jobs') }}">Reporte de cargos</a>
            <a class="nav-item nav-link" href="{{ route('reports.civilStatus') }}">Reporte por estado civil</a>
            <a class="nav-item nav-link" href="{{ route('reports.child') }}">Reporte Segun familiar</a>
            <a class="nav-item nav-link" href="{{ route('reports.age') }}">Reporte Segun edad</a>

        </div>
    </div>
</nav>

<div class="container">
    <button class="btn btn-warning btn-lg btn-block" id="basic">Imprimir</button>
    <br>
    @yield('search')
    <div class="report">
        <div class="col-sm">
            <img  class="img-left"src="{{asset('images/kantuta.png')}}" style="width: 30px">
            <div>
                <h1>Kantuta</h1>
            </div>
        </div>
        @yield('content')
    </div>


</div>

</body>
</html>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/printThis.js') }}"></script>
<script>
    $('#basic').on("click", function () {
        $('.report').printThis({
            pageTitle: "Reporte Kantuta",
            removeInline: false, // postfix to html
            doctypeString: "",
            printDelay: 333,            // variable print delay
            base: false,
            footer: null

        });
    });
</script>


@yield('script')
