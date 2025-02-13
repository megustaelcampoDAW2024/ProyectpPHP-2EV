<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item px-2"><a class="nav-link" href="{{ route('tarea.index') }}">Listar Tareas</a></li>
                    {{-- @if ($_SESSION['status'] == 'A') --}}
                        <li class="nav-item px-2"><a class="nav-link" href="{{ route('tarea.create') }}">Crear Tarea</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="{{ route('tarea.index') }}">Administrar Usuarios</a></li>
                    {{-- @endif --}}
                </ul>
                <div class="d-flex align-items-center">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div>
                        <span class="text-right text-light pr-1">{{ Auth::user()->name }} | @if(Auth::user()->rol == 'A') Administrador @elseif(Auth::user()->rol == 'O') Operario @endif</span>
                        <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LogOut</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid mt-4">
            @yield('seccion')
        </div>
        <footer class="bg-light text-center p-3">
            <p class="m-2">Derechos reservados por megustaelcampo. Registrado &copy; {{ date('Y') }}</p>
        </footer>
    </body>
</html>