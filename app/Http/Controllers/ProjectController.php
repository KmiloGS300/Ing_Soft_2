<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Document;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all(); // Obtener todos los proyectos
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create'); // Vista para crear proyectos
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable',
        ]);

        Project::create($request->all()); // Crear proyecto
        return redirect()->route('projects.index')->with('success', 'Proyecto creado con éxito.');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project')); // Vista para editar un proyecto
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable',
        ]);

        $project->update($request->all()); // Actualizar proyecto
        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado con éxito.');
    }

    public function destroy(Project $project)
    {
        $project->delete(); // Eliminar proyecto
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado con éxito.');
    }

    // Mostrar los documentos asociados al proyecto
    public function showDocuments(Project $project)
    {
        $documents = $project->documents; // Obtener los documentos del proyecto
        return view('documents.index', compact('project', 'documents'));
    }

    // Subir un nuevo documento al proyecto
    public function uploadDocument(Request $request, Project $project)
    {
        // Validar el archivo
        $request->validate([
            'document' => 'required|mimes:pdf,doc,docx,txt|max:10240', // max 10MB
        ]);

        // Subir el archivo
        $path = $request->file('document')->store('documents', 'public');

        // Guardar el nuevo documento en la base de datos
        $document = new Document();
        $document->project_id = $project->id;
        $document->file_path = $path;
        $document->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('documents.index', $project->id)->with('success', 'Documento subido exitosamente');
    }
}
