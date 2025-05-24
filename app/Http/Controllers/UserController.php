<?php

// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'password' => 'required',
            'nik' => 'required|size:16|unique:users',
            'email' => 'required|email|unique:users',
            'no_whatsapp' => 'required',
            'alamat' => 'required',
            'no_rumah' => 'required',
            'role' => 'in:warga,satpam',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['akses'] = 'on';

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->except(['password']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
