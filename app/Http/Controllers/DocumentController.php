<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Mostrar los documentos del proyecto
    public function index(Project $project)
    {
        $documents = $project->documents; // Obtener documentos asociados al proyecto
        return view('documents.index', compact('project', 'documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     // Subir un nuevo documento al proyecto
     public function store(Request $request, Project $project)
     {
         // Validar el archivo
         $request->validate([
             'document' => 'required|mimes:pdf,doc,docx|max:20480', // max 20MB
         ]);
     
         // Subir el archivo
         $file = $request->file('document');
         $originalName = $file->getClientOriginalName(); // Obtener el nombre original del archivo
     
         // Usar storeAs para guardar el archivo con su nombre original
         $path = $file->storeAs('documents', $originalName, 'public');
     
         // Guardar el nuevo documento en la base de datos
         $document = new Document();
         $document->project_id = $project->id;
         $document->name = $originalName; // Guardar el nombre original
         $document->file_path = $path; // Guardar la ruta donde se almacena el archivo
         $document->save();
     
         // Redirigir con mensaje de éxito
         return redirect()->route('documents.index', $project->id)->with('success', 'Documento subido exitosamente');
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Buscar el documento por su ID
    $document = Document::find($id);

    if ($document) {
        // Eliminar el archivo de almacenamiento
        if (Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        // Eliminar el documento de la base de datos
        $document->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('documents.index', $document->project_id)
                         ->with('success', 'Documento eliminado exitosamente.');
    }

    // En caso de no encontrar el documento
    return redirect()->route('documents.index', $document->project_id)
                     ->with('error', 'Documento no encontrado.');
}
}
