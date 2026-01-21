@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg overflow-hidden rounded-5">
                <div class="card-header bg-primary text-white p-5 text-center border-0">
                    <i class="bi bi-rocket-takeoff display-3 mb-3"></i>
                    <h2 class="fw-bold mb-0">Nueva Tienda Inquilina</h2>
                    <p class="opacity-75 mb-0">Configura un nuevo espacio independiente en segundos.</p>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('central.tenants.store') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Identificador
                                    (Único)</label>
                                <input type="text" name="id" class="form-control rounded-3" placeholder="ej: mi-tienda"
                                    required>
                                <small class="text-muted">Solo letras, números y guiones.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Nombre del
                                    Negocio</label>
                                <input type="text" name="name" class="form-control rounded-3" placeholder="Mi Tienda Online"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Dominio o
                                    Subdominio</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-globe"></i></span>
                                    <input type="text" name="domain" class="form-control" placeholder="tienda.localhost"
                                        required>
                                </div>
                                <small class="text-muted">Asegúrate de configurar el DNS o el archivo hosts.</small>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Tipo de
                                    Negocio</label>
                                <select name="business_type" class="form-select rounded-3">
                                    <option value="Tecnología">Tecnología</option>
                                    <option value="Hogar">Hogar</option>
                                    <option value="Moda">Moda</option>
                                    <option value="Alimentos">Alimentos</option>
                                    <option value="Servicios">Servicios</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-uppercase text-secondary">Color de Marca</label>
                                <input type="color" name="color" class="form-control form-control-color w-100 rounded-3"
                                    value="#6366f1" title="Elige el color principal">
                            </div>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                <i class="bi bi-save me-2"></i>Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('central.tenants.index') }}" class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left me-1"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
@endsection