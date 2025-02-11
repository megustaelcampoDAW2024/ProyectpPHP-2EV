<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="bg-light p-3">
            {{-- <p class="text-right">Usuario: {{$_SESSION['usuario']}} | @if($_SESSION['status'] == 'A') Administrador @else Operario @endif | <a href="{{miUrl('logOut')}}" class="btn btn-danger btn-sm">Log Out</a></p> --}}
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="text-center w-100">@yield('titulo')</h1>
                <div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LogOut</a>
                </div>
            </div>
        </header>
        <div class="d-flex">
            <nav class="navbar navbar-light bg-light flex-column p-3" style="width: 250px;">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('tarea.index') }}">Listar Tareas</a></li>
                    {{-- @if ($_SESSION['status'] == 'A') --}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('tarea.index') }}">Crear Tarea</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tarea.index') }}">Administrar Usuarios</a></li>
                    {{-- @endif --}}
                </ul>
            </nav>
            <div class="container-fluid mt-4">
                @yield('seccion')
            </div>
        </div>
        <footer class="bg-light text-center p-3">
            <p class="m-2">Derechos reservados por megustaelcampo. Registrado &copy; {{ date('Y') }}</p>
        </footer>
    </body>
</html>