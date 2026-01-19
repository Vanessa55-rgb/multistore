<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Data\User as TenantUser;

class TenantAdminController extends Controller
{
    public function index(Tenant $tenant)
    {
        $users = $tenant->run(function () {
            return \App\Models\User::all();
        });

        return view('central.tenants.admins.index', compact('tenant', 'users'));
    }

    public function create(Tenant $tenant)
    {
        return view('central.tenants.admins.create', compact('tenant'));
    }

    public function store(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        $tenant->run(function () use ($validated) {
            \App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        });

        return redirect()->route('central.tenants.admins.index', $tenant->id)
            ->with('success', 'Tenant Admin created successfully');
    }

    public function destroy(Tenant $tenant, $userId)
    {
        $tenant->run(function () use ($userId) {
            \App\Models\User::findOrFail($userId)->delete();
        });

        return back()->with('success', 'Tenant Admin deleted successfully');
    }
}
