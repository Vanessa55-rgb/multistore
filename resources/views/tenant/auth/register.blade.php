@extends('layouts.app')

@section('content')
    <div class="row justify-content-center py-5">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-lg p-4 rounded-5">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 70px; height: 70px;">
                            <i class="bi bi-person-plus fs-1"></i>
                        </div>
                        <h3 class="fw-bold">Crear <span class="text-primary">Cuenta</span></h3>
                        <p class="text-secondary">Únete a {{ tenant('name') }}</p>
                    </div>

                    <form method="POST" action="{{ route('tenant.register.post') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-600">Nombre Completo</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-0"
                                    placeholder="Tu nombre" required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-600">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-0"
                                    placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-600">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-600">Confirmar Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-key-fill"></i></span>
                                <input type="password" name="password_confirmation" class="form-control bg-light border-0"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                Registrarse <i class="bi bi-check-circle ms-2"></i>
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-5">
                        <p class="text-muted small">¿Ya tienes cuenta?
                            <a href="{{ route('tenant.login') }}" class="text-primary fw-bold text-decoration-none">Inicia
                                Sesión</a>
                        </p>
                        <a href="{{ route('tenant.catalog') }}" class="text-decoration-none text-muted small">
                            <i class="bi bi-arrow-left me-1"></i> Volver al Catálogo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection