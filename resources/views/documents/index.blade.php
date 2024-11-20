@extends('layouts.plantilla')

@section('content')
<div class="container text-white bg-dark p-5">
    <h1>Documentos del Proyecto: {{ $project->name }}</h1>

    <!-- Mensaje de éxito, si existe -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Mensajes de error, si existen -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para subir documentos -->
    <h3 class="my-4">Subir Nuevo Documento</h3>
    <form action="{{ route('documents.store', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="document" class="form-label">Seleccionar archivo</label>
            <input type="file" class="form-control" id="document" name="document" required>
            <div class="form-text">Selecciona un documento PDF, DOC o DOCX (máximo 20MB).</div>
        </div>
        <button type="submit" class="btn btn-primary">Subir Documento</button>
    </form>

    <!-- Tabla para mostrar los documentos subidos -->
    <h3 class="my-4">Documentos Subidos</h3>
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre del Documento</th>
                <th>Previsualización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->id }}</td>
                    <td>{{ basename($document->file_path) }}</td> <!-- Nombre del archivo -->
                    <td>
                        <!-- Previsualización del archivo -->
                        @if(in_array(pathinfo($document->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <!-- Previsualización de imágenes -->
                            <img src="{{ asset('storage/' . $document->file_path) }}" alt="Vista Previa" style="width: 100px; height: auto;">
                        @elseif(pathinfo($document->file_path, PATHINFO_EXTENSION) == 'pdf')
                            <!-- Previsualización de PDF -->
                            <a href="javascript:void(0);" class="btn btn-success btn-sm" onclick="previewPDF('{{ asset('storage/' . $document->file_path) }}')">
                                    Previsualizar PDF
                            </a>
                        @else
                            <!-- Otros tipos de documentos -->
                            <span>No previsualizable</span>
                        @endif
                    </td>
                    <td>
                        <!-- Botón para descargar el documento -->
                        <a href="{{ asset('storage/' . $document->file_path) }}" class="btn btn-info btn-sm" download>Descargar</a>

                        <!-- Botón para eliminar el documento -->
                        <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este documento?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($documents->isEmpty())
        <p>No hay documentos subidos para este proyecto.</p>
    @endif
</div>

<!-- Modal de previsualización para PDF -->
<div class="modal fade" id="pdf-preview-modal" tabindex="-1" aria-labelledby="pdf-preview-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdf-preview-modal-label">Previsualización de Documento PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <canvas id="pdf-preview-canvas"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Botón Volver con confirmación -->
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#cancelModal" 
    style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
    Volver
</button>

<!-- Modal de confirmación para cancelar -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">¿Estás seguro de que deseas volver?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="{{ route('projects.index') }}" class="btn btn-warning">Volver al Menú de Proyectos</a>
            </div>
        </div>
    </div>
</div>

<!-- Script para previsualizar PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
<script>
    function previewPDF(pdfUrl) {
        const canvas = document.getElementById('pdf-preview-canvas');
        const ctx = canvas.getContext('2d');
        const modal = new bootstrap.Modal(document.getElementById('pdf-preview-modal'));
        modal.show();

        // Cargar y mostrar el PDF
        const loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                const viewport = page.getViewport({ scale: 1.5 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                page.render({ canvasContext: ctx, viewport: viewport });
            });
        });
    }
</script>

@endsection
