@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg p-5 rounded-5">
                <div class="card-body">
                    <div class="mb-5 text-center">
                        <div class="bg-dark bg-opacity-10 text-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-shield-lock display-5 text-primary"></i>
                        </div>
                        <h2 class="fw-bold">Editar <span class="text-primary">Admin Global</span></h2>
                        <p class="text-secondary small">Actualiza los datos de <strong>{{ $admin->name }}</strong>.</p>
                    </div>

                    <form action="{{ route('central.admins.update', $admin->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nombre Completo</label>
                            <input type="text" name="name" class="form-control rounded-pill px-4" value="{{ $admin->name }}"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control rounded-pill px-4"
                                value="{{ $admin->email }}" required>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold">Nueva Contraseña (Opcional)</label>
                            <input type="password" name="password" class="form-control rounded-pill px-4"
                                placeholder="Dejar en blanco para mantener actual">
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                                <i class="bi bi-save me-2"></i>Guardar Cambios
                            </button>
                            <a href="{{ route('central.admins.index') }}"
                                class="btn btn-light btn-lg rounded-pill px-4 border text-muted">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection