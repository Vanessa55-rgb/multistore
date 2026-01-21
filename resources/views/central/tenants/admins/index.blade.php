@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('central.tenants.index') }}">Tiendas</a></li>
            <li class="breadcrumb-item active">{{ $tenant->name }}</li>
            <li class="breadcrumb-item active">Administradores</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold mb-0">Administradores de <span class="text-primary">{{ $tenant->name }}</span></h1>
            <p class="text-secondary">Usuarios autorizados para gestionar el inventario de esta tienda.</p>
        </div>
        <a href="{{ route('central.tenants.admins.create', $tenant->id) }}"
            class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-person-plus-fill me-2"></i>Nuevo Administrador
        </a>
    </div>


    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4">Administrador</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Registrado</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $user->name }}</h6>
                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">Admin</span>
                            </td>
                            <td>
                                <span class="text-muted small">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-actions-pill">
                                    <a href="{{ route('central.tenants.admins.edit', [$tenant->id, $user->id]) }}" class="btn" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('central.tenants.admins.destroy', [$tenant->id, $user->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" title="Eliminar" onclick="return confirm('¿Eliminar este administrador?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-people display-1 text-muted opacity-25 mb-3"></i>
                                <p class="text-muted mb-0">No hay administradores registrados para esta tienda.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('central.tenants.index') }}" class="btn btn-light rounded-pill border">
            <i class="bi bi-arrow-left me-2"></i>Volver a Tiendas
        </a>
    </div>
@endsection