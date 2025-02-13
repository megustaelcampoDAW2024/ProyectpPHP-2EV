@extends('layouts.plantilla')
@section('titulo', 'Create Tareas')
@section('seccion')
<form action="{{ route("tarea.store") }}" method="post" enctype="multipart/form-data" class="container my-4">
    @csrf
    <fieldset class="border p-4">
        <legend class="w-auto"><b>Formulario {{ isset($task) ? 'Modificación' : 'Creación' }} de Tarea</b></legend>

        @if(Auth::user()->rol == 'A')

            <div class="form-group">
                @error('cliente')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="cliente">Cliente</label>
                @enderror
                <select class="form-control" name="cliente" id="cliente">
                    <option value="0" hidden>Seleccione un Cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                @error('nombre_contacto')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="nombre_contacto">Nombre del Contacto</label>
                @enderror
                <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto" value="{{ old('nombre_contacto') }}">
            </div>

            <div class="form-group">
                @error('apellido_contacto')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="apellido_contacto">Apellido del Contacto</label>
                @enderror
                <input type="text" class="form-control" name="apellido_contacto" id="apellido_contacto" value="{{ old('apellido_contacto') }}">
            </div>

            <div class="form-group">
                @error('correo_contacto')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="correo_contacto">Correo del Contacto</label>
                @enderror
                <input type="email" class="form-control" name="correo_contacto" id="correo_contacto" value="{{ old('correo_contacto') }}">
            </div>

            <div class="form-group">
                @error('telefono_contacto')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="telefono_contacto">Teléfono del Contacto</label>
                @enderror
                <input type="text" class="form-control" name="telefono_contacto" id="telefono_contacto" value="{{ old('telefono_contacto') }}">
            </div>

            <div class="form-group">
                @error('descripcion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="descripcion">Descripción de la Tarea</label>
                @enderror
                <textarea class="form-control" name="descripcion">{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-group">
                @error('direccion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="direccion">Dirección de Realización</label>
                @enderror
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}">
            </div>

            <div class="form-group">
                @error('poblacion')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="poblacion">Población de Realización</label>
                @enderror
                <input type="text" class="form-control" name="poblacion" value="{{ old('poblacion') }}">
            </div>

            <div class="form-group">
                @error('codigo-post')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="codigo-post">Código Postal de Realización</label>
                @enderror
                <input type="text" class="form-control" name="codigo-post" value="{{ old('codigo-post') }}">
            </div>

            <div class="form-group">
                @error('provincia')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="provincia">Provincia de Realización</label>
                @enderror
                <select class="form-control" name="provincia" id="provincia">
                    <option value="0" hidden>Seleccione una Provincia</option>
                    @foreach($provincias as $provincia)
                        <option value="{{ $provincia->id }}" {{ old('provincia') == $provincia->id ? 'selected' : '' }}>{{ $provincia->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                @error('operario')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="form-control">Operario Asignado</label>
                @enderror
                <select class="form-control" name="operario" id="operario">
                    <option value="0" hidden>Seleccione un Operario</option>
                    @foreach($operarios as $operario)
                        <option value="{{ $operario->id }}" {{ old('operario') == $operario->id ? 'selected' : '' }}>{{ $operario->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
            
        <div class="form-group">
            @error('fecha-realizacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="fecha-realizacion"></label>
            @enderror
            <input type="date" class="form-control" name="fecha-realizacion" id="fecha-realizacion" value="{{ old('fecha-realizacion') }}">
        </div>

        <div class="form-group">
            @error('estado')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="estado">Estado de la Tarea</label>
            @enderror
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" id="estado" value="B" {{ old('estado') == 'B' ? 'checked' : '' }}>Esperando a Ser Aprobada
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" id="estado" value="P" {{ old('estado') == 'P' ? 'checked' : '' }}>Pendiente
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" id="estado" value="R" {{ old('estado') == 'R' ? 'checked' : '' }}>Realizada
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" id="estado" value="C" {{ old('estado') == 'C' ? 'checked' : '' }}>Cancelada
            </div>
        </div>

        <div class="form-group">
            @error('anotaciones-anteriores')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="anotaciones-anteriores">Anotaciones Anteriores a la Tarea</label>
            @enderror
            <textarea class="form-control" name="anotaciones-anteriores" id="anotaciones-anteriores">{{ old('anotaciones-anteriores') }}</textarea>
        </div>

        <div class="form-group">
            @error('anotaciones-posteriores')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="anotaciones-posteriores">Anotaciones Posteriores a la Tarea</label>
            @enderror
            <textarea class="form-control" name="anotaciones-posteriores" id="anotaciones-posteriores">{{ old('anotaciones-posteriores') }}</textarea>
        </div>

        <div class="form-group">
            @error('fich-resu')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="fich-resu">Fichero Resumen de las Tareas Realizadas</label>
            @enderror
            <input type="file" class="form-control-file" name="fich-resu" id="fich-resu" accept=".pdf">
        </div>

        <div class="form-group">
            @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="foto">Foto de las Tareas Realizadas</label>
            @enderror
            <input type="file" class="form-control-file" name="foto" id="foto" accept=".jpg, .jpeg, .png">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar o Enviar</button>
    </fieldset>
</form>
@endsection