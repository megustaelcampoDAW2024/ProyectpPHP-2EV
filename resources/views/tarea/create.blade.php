@extends('layouts.plantilla')
@section('titulo', 'Create Tareas')
@section('seccion')
<form action="{{ route("tarea.store") }}" method="post" enctype="multipart/form-data" class="container my-4">
    @csrf
    <fieldset class="border p-4">
        <legend class="w-auto"><b>Formulario {{ isset($task) ? 'Modificación' : 'Creación' }} de Tarea</b></legend>

        @if(Auth::user()->rol == 'A')

            <div class="form-group">
                <label for="cliente">Cliente</label>
                <select class="form-control" name="cliente" id="cliente">
                    <option value="0" hidden>Seleccione un Cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción de la Tarea</label>
                <textarea class="form-control" name="descripcion"></textarea>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección de Realización</label>
                <input type="text" class="form-control" name="direccion">
            </div>

            <div class="form-group">
                <label for="poblacion">Población de Realización</label>
                <input type="text" class="form-control" name="poblacion">
            </div>

            <div class="form-group">
                <label for="codigo-post">Código Postal de Realización</label>
                <input type="text" class="form-control" name="codigo-post">
            </div>

            <div class="form-group">
                <label for="provincia">Provincia de Realización</label>
                <select class="form-control" name="provincia" id="provincia">
                    <option value="0" hidden>Provincia</option>
                    @foreach($provincias as $provincia)
                        <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="form-control">Operario Asignado</label>
                <select class="form-control" name="operario" id="operario">
                    <option value="0" hidden>Seleccione un Operario</option>
                    @foreach($operarios as $operario)
                        <option value="{{ $operario->id }}">{{ $operario->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
            
        <div class="form-group">
            <label for="fecha-realizacion"></label>
            <input type="text" class="form-control" name="fecha-realizacion" id="fecha-realizacion">
        </div>

        <div class="form-group">
            <label for="estado">Estado de la Tarea</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" id="estado" value="B">Esperando a Ser Aprobada
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" id="estado" value="P">Pendiente
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" id="estado" value="R">Realizada
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" id="estado" value="C">Cancelada
            </div>
        </div>

        <div class="form-group">
            <label for="anotaciones-anteriores">Anotaciones Anteriores a la Tarea</label>
            <textarea class="form-control" name="anotaciones-anteriores" id="anotaciones-anteriores"></textarea>
        </div>

        <div class="form-group">
            <label for="anotaciones-posteriores">Anotaciones Posteriores a la Tarea</label>
            <textarea class="form-control" name="anotaciones-posteriores" id="anotaciones-posteriores"></textarea>
        </div>

        <div class="form-group">
            <label for="fich-resu">Fichero Resumen de las Tareas Realizadas</label>
            <input type="file" class="form-control-file" name="fich-resu" id="fich-resu" accept=".pdf">
        </div>

        <div class="form-group">
            <label for="foto">Foto de las Tareas Realizadas</label>
            <input type="file" class="form-control-file" name="foto" id="foto" accept=".jpg, .jpeg, .png">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar o Enviar</button>
    </fieldset>
</form>
@endsection