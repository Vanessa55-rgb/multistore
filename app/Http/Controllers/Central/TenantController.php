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

        return redirect()->route('central.tenants.index')->with('success', 'Tenant created successfully.');
    }

    public function edit(Tenant $tenant)
    {
        return view('central.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'business_type' => 'required|string',
            'color' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $tenant->update([
            'name' => $validated['name'],
            'business_type' => $validated['business_type'],
            'color' => $validated['color'] ?? $tenant->color,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('central.tenants.index')->with('success', 'Tenant updated successfully.');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('central.tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
