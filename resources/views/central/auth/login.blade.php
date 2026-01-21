@extends('layouts.app')

@section('content')
    <div class="row justify-content-center py-5">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-lg p-4 rounded-5">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 70px; height: 70px;">
                            <i class="bi bi-shield-lock-fill fs-1"></i>
                        </div>
                        <h3 class="fw-bold">Panel <span class="text-primary">Central</span></h3>
                        <p class="text-secondary">Administración Global de MultiStore</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">

                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-600">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-0"
                                    placeholder="admin@multistore.com" required autofocus>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-600">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                Entrar al Sistema <i class="bi bi-box-arrow-in-right ms-2"></i>
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-5">
                        <a href="{{ url('/') }}" class="text-decoration-none text-muted small">
                            <i class="bi bi-arrow-left me-1"></i> Volver al Inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection