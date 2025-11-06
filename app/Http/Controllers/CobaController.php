<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CobaController extends Controller
{
    /**
     * Mendapatkan semua data
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        // Validasi Input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Hash Password
        $validatedData['password'] = bcrypt($validatedData['password']);

        //Buat user baru
        $coba = User::create($validatedData);
        return response()->json($coba, 201);
    }

    /**
     * Dapatkan data dari id.
     */
    public function show($id)
    {
        $coba = User::find($id);
        if (!$coba) return response()->json(['message'=> 'Data tak ditemukan'], 404);
        return $coba;
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $coba = User::find($id);
        if (!$coba) {
            return response()->json(['massage'=>'Data tak ditemukan', 404]);
        }

        //Validasi Input
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,'. $id,
            'password' => 'nullable|string|min:8',
        ]);

        //Hash Pasword jika ada input baru
       if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        //Update data
        $coba->update($validatedData);
        return response()->json($coba, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coba = User::find($id);
        if (!$coba) return response()->json(['massage'=>'User tak ditemukan', 404]);

        $coba->delete();
        return response()->json($coba, 204);
    }
}
