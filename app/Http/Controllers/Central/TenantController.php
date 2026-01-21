<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('domains')->get();
        return view('central.tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('central.tenants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|alpha_dash|unique:tenants,id',
            'name' => 'required|string',
            'domain' => 'required|string|unique:domains,domain',
            'business_type' => 'required|string',
            'color' => 'nullable|string',
        ]);

        $tenant = Tenant::create([
            'id' => $validated['id'],
            'name' => $validated['name'],
            'business_type' => $validated['business_type'],
            'color' => $validated['color'] ?? '#ffffff',
            'is_active' => true,
        ]);

        $tenant->domains()->create([
            'domain' => $validated['domain']
        ]);

        return redirect()->route('central.tenants.index')->with('success', 'Tienda creada correctamente.');
    }

    public function edit(Tenant $tenant)
    {
        $tenant->load('domains');
        return view('central.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $domainId = $tenant->domains->first()?->id;
        $validated = $request->validate([
            'name' => 'required|string',
            'domain' => 'required|string|unique:domains,domain' . ($domainId ? ',' . $domainId : ''),
            'business_type' => 'required|string',
            'color' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $tenant->update([

            'name' => $validated['name'],
            'business_type' => $validated['business_type'],
            'color' => $validated['color'] ?? $tenant->color,
            'is_active' => $request->has('is_active'),
        ]);

        if ($tenant->domains()->exists()) {
            $tenant->domains()->first()->update(['domain' => $validated['domain']]);
        } else {
            $tenant->domains()->create(['domain' => $validated['domain']]);
        }

        return redirect()->route('central.tenants.index')->with('success', 'Tienda actualizada correctamente.');
    }


    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('central.tenants.index')->with('success', 'Tienda eliminada correctamente.');
    }
}
