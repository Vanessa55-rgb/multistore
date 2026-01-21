@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold mb-0">Administradores <span class="text-primary">Globales</span></h1>
            <p class="text-secondary">Gestiona los usuarios con acceso total al control de la plataforma.</p>
        </div>
        <a href="{{ route('central.admins.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-person-badge-fill me-2"></i>Nuevo Administrador
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
                    @foreach($admins as $admin)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-dark bg-opacity-10 text-dark rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-shield-lock-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $admin->name }}</h6>
                                        <small class="text-muted">ID: {{ $admin->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span class="badge bg-dark bg-opacity-10 text-dark rounded-pill px-3">Super Admin</span>
                            </td>
                            <td>
                                <span class="text-muted small">
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ $admin->created_at->format('d/m/Y') }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                @if(auth()->id() !== $admin->id)
                                    <div class="btn-actions-pill">
                                        <a href="{{ route('central.admins.edit', $admin->id) }}" class="btn" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('central.admins.destroy', $admin->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn" title="Eliminar" onclick="return confirm('¿Eliminar este administrador global?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="badge bg-light text-muted rounded-pill px-3 py-2 border">Tú (Sesión activa)</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection