<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    // Admin: Tambah Akun Pengguna Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
        ]);

        DB::transaction(function () use ($request) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);
        });

        return response()->json(['message' => 'Pengguna baru berhasil ditambahkan oleh Admin'], 201);
    }

    // Admin: Hapus Akun Pengguna (Atomic Delete)
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            
            // Catatan: Jika relasi task/list menggunakan Cascade Delete di Foreign Key DB,
            // seluruh data pengguna, daftar, & keanggotaan akan terhapus otomatis secara atomic.
            $user->delete();
        });

        return response()->json(['message' => 'Akun pengguna berhasil dihapus']);
    }
}
