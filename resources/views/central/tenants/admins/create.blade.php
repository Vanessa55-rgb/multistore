@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('central.tenants.index') }}">Tiendas</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('central.tenants.admins.index', $tenant->id) }}">Administradores</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm p-4 rounded-4">
                <div class="card-body">
                    <h2 class="fw-bold mb-4">Añadir Administrador</h2>
                    <p class="text-secondary mb-5">El usuario recibirá acceso para gestionar la tienda
                        <strong>{{ $tenant->name }}</strong>.
                    </p>

                    <form action="{{ route('central.tenants.admins.store', $tenant->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nombre Completo</label>
                            <input type="text" name="name" class="form-control" placeholder="Ej: Juan Pérez" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="juan@ejemplo.com" required>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold">Contraseña Temporal</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            <small class="text-muted">Mínimo 8 caracteres.</small>
                        </div>

                        <div class="d-grid gap-3 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">
                                <i class="bi bi-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection