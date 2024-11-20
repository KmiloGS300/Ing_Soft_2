@extends('layouts.plantilla')

@section('title', 'Login')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card p-4 bg-dark">
                <h2 class="text-center mb-4">Inicio de Sesión</h2>
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Iniciar Sesión</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <small class="text-muted">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-success">Regístrate</a></small>
                </div>
            </div>
        </div>
    </div>
@endsection
