<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::all();
        return view('central.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('central.admins.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('central.admins.index')->with('success', 'Admin created successfully');
    }

    public function edit(User $admin)
    {
        return view('central.admins.edit', compact('admin'));
    }

    public function update(Request $request, User $admin)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|min:8'
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $admin->update($data);

        return redirect()->route('central.admins.index')->with('success', 'Admin updated successfully');
    }

    public function destroy(User $admin)
    {
        if (auth()->id() == $admin->id) {
            return back()->with('error', 'Cannot delete yourself');
        }
        $admin->delete();
        return redirect()->route('central.admins.index')->with('success', 'Admin deleted successfully');
    }
}
