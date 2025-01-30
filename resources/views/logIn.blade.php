<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <title>Document</title>
    </head>
    <body class="container mt-5">
        <form action="{{route('logIn.store')}}" method="POST" class="border p-4 bg-light">
            @csrf
            {{-- @if(!$logError)
                <h3>Log In</h3>
            @else
                <h3 class="text-danger">Usuario o Contraseña Incorrectos</h3>
            @endif --}}
            <div class="form-group">
                <label for="user">Usuario</label>
                @error('user')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="text" class="form-control" name="user" id="user" value="{{old('user')}}">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                @error('pass')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="password" class="form-control" name="pass" id="pass" value="{{old('pass')}}">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Recordar Usuario</label>
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </body>
</html>