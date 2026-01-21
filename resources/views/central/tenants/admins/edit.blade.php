@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('central.tenants.index') }}">Tiendas</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ route('central.tenants.admins.index', $tenant->id) }}">{{ $tenant->name }}</a></li>
            <li class="breadcrumb-item active">Editar Administrador</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg p-5 rounded-5">
                <div class="card-body">
                    <div class="mb-5 text-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-person-gear display-5"></i>
                        </div>
                        <h2 class="fw-bold">Editar <span class="text-primary">Administrador</span></h2>
                        <p class="text-secondary small">Actualiza los datos de acceso para
                            <strong>{{ $tenant->name }}</strong></p>
                    </div>

                    <form action="{{ route('central.tenants.admins.update', [$tenant->id, $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Nombre Completo</label>
                            <input type="text" class="form-control rounded-pill px-4" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Correo Electrónico</label>
                            <input type="email" class="form-control rounded-pill px-4" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label fw-bold">Nueva Contraseña (Opcional)</label>
                            <input type="password" class="form-control rounded-pill px-4" id="password" name="password"
                                placeholder="Dejar en blanco para mantener actual">
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                                <i class="bi bi-save me-2"></i>Guardar Cambios
                            </button>
                            <a href="{{ route('central.tenants.admins.index', $tenant->id) }}"
                                class="btn btn-light btn-lg rounded-pill px-4 border text-muted">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('central.tenants.admins.index', $tenant->id) }}" class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left me-1"></i>Regresar a la lista
                </a>
            </div>
        </div>
    </div>
@endsection