<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    @if (Auth::user()->rol == 'A')
                        <li class="nav-item px-2"><a class="nav-link" href="{{ route('tarea.index') }}">Tareas</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="{{ route('user.index') }}">Usuarios</a></li>
                    @elseif (Auth::user()->rol == 'O')
                        <li class="nav-item px-2"><a class="nav-link" href="{{ route('tarea.index') }}">Completar Tareas</a></li>
                        <li class="nav-item px-2"><a class="nav-link" href="{{ route('user.index') }}">Modificar mis Datos</a></li>                        
                    @endif
                </ul>
                <div class="d-flex align-items-center">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div>
                        <span class="text-right text-light pr-1">{{ Auth::user()->name }} | @if(Auth::user()->rol == 'A') Administrador @elseif(Auth::user()->rol == 'O') Operario @endif</span>
                        <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            LogOut
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1"/>
                                <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid mt-5 pt-4">
            @yield('seccion')
        </div>
        <footer class="bg-light text-center p-3">
            <p class="m-2">Derechos reservados por megustaelcampo. Registrado &copy; {{ date('Y') }}</p>
        </footer>
    </body>
</html>