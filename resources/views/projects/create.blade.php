@extends('layouts.plantilla')

@section('content')
<div class="container text-white bg-dark p-5">
    <h1>Nuevo Proyecto</h1>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name">Nombre del Proyecto</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="start_date">Fecha de Inicio</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="end_date">Fecha de Fin</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Crear Proyecto</button>
    </form>

    <!-- Botón Volver en la esquina inferior derecha -->
    <a href="{{ route('projects.index') }}" class="btn btn-warning position-fixed bottom-0 end-0 m-4">Volver</a>
</div>
@endsection
