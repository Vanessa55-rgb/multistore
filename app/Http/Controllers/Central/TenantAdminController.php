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
            return \App\Models\User::all()->each->setConnection(config('tenancy.database.central_connection'));
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
            ->with('success', 'Administrador de tienda creado correctamente');
    }

    public function edit(Tenant $tenant, $userId)
    {
        $user = $tenant->run(function () use ($userId) {
            $u = \App\Models\User::findOrFail($userId);
            $u->setConnection(config('tenancy.database.central_connection'));
            return $u;
        });

        return view('central.tenants.admins.edit', compact('tenant', 'user'));
    }

    public function update(Request $request, Tenant $tenant, $userId)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8'
        ]);

        $tenant->run(function () use ($validated, $userId) {
            $user = \App\Models\User::findOrFail($userId);
            $data = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if ($validated['password']) {
                $data['password'] = Hash::make($validated['password']);
            }

            $user->update($data);
        });

        return redirect()->route('central.tenants.admins.index', $tenant->id)
            ->with('success', 'Administrador de tienda actualizado correctamente');
    }

    public function destroy(Tenant $tenant, $userId)
    {
        $tenant->run(function () use ($userId) {
            \App\Models\User::findOrFail($userId)->delete();
        });

        return back()->with('success', 'Administrador de tienda eliminado correctamente');
    }
}
