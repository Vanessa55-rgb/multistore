@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold mb-0">Tiendas <span class="text-primary">Registradas</span></h1>
            <p class="text-secondary">Gestiona todos tus inquilinos desde este panel central.</p>
        </div>
        <a href="{{ route('central.tenants.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Nueva Tienda
        </a>
    </div>

    <div class="row">
        @forelse($tenants as $tenant)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 overflow-hidden border-0 shadow-sm">
                    <div class="card-header border-0 p-0"
                        style="height: 120px; background: {{ $tenant->color ?? 'var(--primary-gradient)' }}; opacity: 0.8;">
                        <div class="d-flex justify-content-end p-3">
                            <span class="badge rounded-pill {{ $tenant->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $tenant->is_active ? 'Activa' : 'Inactiva' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body pt-0 mt-n5 position-relative">
                        <div class="bg-white rounded-circle shadow-sm d-flex align-items-center justify-content-center mx-auto mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-shop text-primary fs-2"></i>
                        </div>
                        <div class="text-center">
                            <h5 class="card-title fw-bold">{{ $tenant->name }}</h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-tag-fill me-1"></i>{{ $tenant->business_type }}
                            </p>

                            <div class="bg-light rounded-3 p-2 mb-4">
                                <p class="small mb-0 text-secondary">
                                    <i class="bi bi-globe me-2"></i>
                                    @foreach($tenant->domains as $domain)
                                        <a href="http://{{ $domain->domain }}:8000" target="_blank"
                                            class="text-decoration-none text-primary fw-600">
                                            http://{{ $domain->domain }}:8000/
                                        </a>{{ !$loop->last ? ',' : '' }}
                                    @endforeach

                                </p>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('central.tenants.admins.index', $tenant->id) }}"
                                    class="btn btn-outline-primary btn-sm rounded-pill">
                                    <i class="bi bi-people me-1"></i>Gestionar Admins
                                </a>
                                <div class="btn-actions-pill mx-auto">
                                    <a href="{{ route('central.tenants.edit', $tenant->id) }}" class="btn" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('central.tenants.destroy', $tenant->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" title="Eliminar" onclick="return confirm('¿Estás seguro?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="card p-5 border-0 shadow-sm bg-light">
                    <i class="bi bi-inbox display-1 text-muted mb-4"></i>
                    <h3>No hay tiendas creadas</h3>
                    <p class="text-secondary">Comienza creando tu primer inquilino para empezar a vender.</p>
                    <div class="mt-4">
                        <a href="{{ route('central.tenants.create') }}" class="btn btn-primary">Crear mi primera tienda</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection