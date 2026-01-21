<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $tenant = tenant();
        return view('tenant.admin.settings', compact('tenant'));
    }

    public function update(Request $request)
    {
        $tenant = tenant();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string',
            'banner' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $validated['name'],
            'color' => $validated['color'],
        ];

        if ($request->hasFile('banner')) {
            if ($tenant->banner) {
                Storage::disk('public')->delete($tenant->banner);
            }
            $data['banner'] = $request->file('banner')->store('banners', 'public');
        }

        $tenant->update($data);

        return redirect()->route('tenant.admin.settings')->with('success', 'Configuración actualizada correctamente');
    }
}
