@extends('layouts.plantilla')

@section('title', 'Registro')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card p-4 bg-dark">
                <h2 class="text-center mb-4">Crear Cuenta</h2>
                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirma tu contraseña" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Crear Cuenta</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <small class="text-muted">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-success">Inicia sesión</a></small>
                </div>
            </div>
        </div>
    </div>
@endsection
