@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('tenant.admin.dashboard') }}">Administración</a></li>
            <li class="breadcrumb-item active">Configuración</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card border-0 shadow-lg p-5 rounded-5">
                <div class="card-body">
                    <div class="mb-5 text-center">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-gear-fill display-5"></i>
                        </div>
                        <h2 class="fw-bold">Configuración de <span class="text-primary">Tienda</span></h2>
                        <p class="text-secondary">Personaliza la apariencia y los datos básicos de tu negocio.</p>
                    </div>

                    <form action="{{ route('tenant.admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Nombre de la Tienda</label>
                            <input type="text" class="form-control rounded-pill px-4" id="name" name="name"
                                value="{{ $tenant->name }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="color" class="form-label fw-bold">Color Principal (CSS Gradient o Hex)</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-pill p-1">
                                    <input type="color" class="form-control form-control-color border-0"
                                        value="{{ str_contains($tenant->color, 'linear-gradient') ? '#6366f1' : $tenant->color }}"
                                        onchange="document.getElementById('color').value = this.value">
                                </span>
                                <input type="text" class="form-control rounded-end-pill px-4" id="color" name="color"
                                    value="{{ $tenant->color }}" placeholder="e.g. #6366f1 or linear-gradient(...)">
                            </div>
                            <small class="text-muted ms-3">Puedes usar un color hex o un gradiente CSS.</small>
                        </div>

                        <div class="mb-4">
                            <label for="banner" class="form-label fw-bold">Banner de la Tienda</label>
                            @if($tenant->banner)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $tenant->banner) }}" class="img-fluid rounded-4 shadow-sm"
                                        style="max-height: 200px; width: 100%; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" class="form-control rounded-pill px-4" id="banner" name="banner"
                                accept="image/*">
                            <small class="text-muted ms-3">Recomendado: 1200x400px</small>
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">
                                <i class="bi bi-save me-2"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection