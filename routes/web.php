<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AuthController; // Asegúrate de incluir el controlador de autenticación

// Rutas para el login
Route::get('/login', function () {
    return view('auth.login'); // Muestra la vista de login
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Rutas para el registro de usuario
Route::get('/register', function () {
    return view('auth.register'); // Muestra la vista de registro
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Rutas para el logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas para proyectos
Route::resource('projects', ProjectController::class);

// Rutas para documentos
Route::get('/projects/{project}/documents', [DocumentController::class, 'index'])->name('documents.index'); // Ver documentos de un proyecto
Route::post('/projects/{project}/documents', [DocumentController::class, 'store'])->name('documents.store'); // Subir documentos a un proyecto

Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy'); // Eliminar un documento

// Ruta para editar documentos (si es necesario)
Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit'); // Editar documento
Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update'); // Actualizar documento
