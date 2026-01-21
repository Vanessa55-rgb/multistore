@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg overflow-hidden rounded-5">
                <div class="card-header bg-dark text-white p-5 text-center border-0">
                    <i class="bi bi-pencil-square display-3 mb-3 text-primary"></i>
                    <h2 class="fw-bold mb-0">Editar <span class="text-primary">Tienda</span></h2>
                    <p class="opacity-75 mb-0">Modifica los detalles de <strong>{{ $tenant->name }}</strong>.</p>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('central.tenants.update', $tenant->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Identificador
                                    (Inmutable)</label>
                                <input type="text" class="form-control bg-light border-0 rounded-3"
                                    value="{{ $tenant->id }}" disabled>
                                <small class="text-muted">El ID del inquilino no puede ser cambiado.</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Nombre del
                                    Negocio</label>
                                <input type="text" name="name" class="form-control rounded-3" value="{{ $tenant->name }}"
                                    required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Dominio o
                                    Subdominio</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-globe"></i></span>
                                    <input type="text" name="domain" class="form-control"
                                        value="{{ $tenant->domains->first()->domain ?? '' }}" required>
                                </div>
                                <small class="text-muted">Ejemplo: mi-tienda.localhost o dominio.com</small>
                            </div>


                            <div class="col-md-8">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Tipo de
                                    Negocio</label>
                                <select name="business_type" class="form-select rounded-3">
                                    <option value="Tecnología" {{ $tenant->business_type == 'Tecnología' ? 'selected' : '' }}>
                                        Tecnología</option>
                                    <option value="Hogar" {{ $tenant->business_type == 'Hogar' ? 'selected' : '' }}>Hogar
                                    </option>
                                    <option value="Moda" {{ $tenant->business_type == 'Moda' ? 'selected' : '' }}>Moda
                                    </option>
                                    <option value="Alimentos" {{ $tenant->business_type == 'Alimentos' ? 'selected' : '' }}>
                                        Alimentos</option>
                                    <option value="Servicios" {{ $tenant->business_type == 'Servicios' ? 'selected' : '' }}>
                                        Servicios</option>
                                    <option value="Otros" {{ $tenant->business_type == 'Otros' ? 'selected' : '' }}>Otros
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Color de Marca</label>
                                <input type="color" name="color" class="form-control form-control-color w-100 rounded-3"
                                    value="{{ $tenant->color ?? '#6366f1' }}" title="Elige el color principal">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch p-3 bg-light rounded-4">
                                    <input class="form-check-input ms-0 me-3" type="checkbox" name="is_active"
                                        id="activeCheck" {{ $tenant->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="activeCheck">
                                        {{ $tenant->is_active ? 'Inquilino Activo' : 'Inquilino Inactivo' }}
                                    </label>
                                    <p class="text-muted small mb-0 mt-1 ms-5">Si se desactiva, no se podrá acceder a la
                                        tienda.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                                <i class="bi bi-check-circle me-2"></i>Guardar Cambios
                            </button>
                            <a href="{{ route('central.tenants.index') }}"
                                class="btn btn-light btn-lg rounded-pill px-4 border">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection