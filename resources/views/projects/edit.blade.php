@extends('layouts.plantilla')

@section('content')
<div class="container text-white bg-dark p-5">
    <h1>Editar Proyecto</h1>

    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name">Nombre del Proyecto</label>
            <input type="text" name="name" id="name" value="{{ $project->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="start_date">Fecha de Inicio</label>
            <input type="date" name="start_date" id="start_date" value="{{ $project->start_date }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="end_date">Fecha de Fin</label>
            <input type="date" name="end_date" id="end_date" value="{{ $project->end_date }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="description">Descripción</label>
            <textarea name="description" id="description" class="form-control">{{ $project->description }}</textarea>
        </div>

        <!-- Botones de acción -->
        <button type="submit" class="btn btn-success">Actualizar Proyecto</button>
        
        <!-- Botón Cancelar con confirmación -->
        <button type="button" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#cancelModal">
            Cancelar
        </button>
    </form>

    <!-- Modal de confirmación para cancelar -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">¿Estás seguro de que deseas cancelar?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Si cancelas, perderás los cambios realizados en este proyecto.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="{{ route('projects.index') }}" class="btn btn-danger">Cancelar Edición</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
