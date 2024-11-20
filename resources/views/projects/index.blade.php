@extends('layouts.plantilla')

@section('content')
<div class="container text-white bg-dark p-5">
    <h1>Proyectos</h1>

    <!-- Botón para crear un nuevo proyecto -->
    <a href="{{ route('projects.create') }}" class="btn btn-success mb-3">Nuevo Proyecto</a>

    <!-- Mensaje de éxito, si existe -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tabla de proyectos -->
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Descripcion</th>
                <th>Documentos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Verificar si hay proyectos -->
            @forelse($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date ?? 'N/A' }}</td>
                    <td>{{ $project->description }}</td>
                    <td>
                        <a href="{{ route('documents.index', $project->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-file-upload"></i> DOCS</td>
                    <td>
                        <!-- Botón para editar el proyecto -->
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-sm">Editar</a>

                        <!-- Formulario para eliminar el proyecto -->
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                        </a>
                    </td>
                </tr>
            @empty
                <!-- Mensaje cuando no hay proyectos -->
                <tr>
                    <td colspan="5" class="text-center">No hay proyectos disponibles</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
