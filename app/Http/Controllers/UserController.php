<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Menyimpan user baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['kasir', 'sosmed'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit user.
     */
    public function edit(User $user)
    {
        // Superadmin tidak bisa mengedit role superadmin lain
        if ($user->role === 'superadmin' && $user->id !== auth()->id()) {
            abort(403, 'Tidak dapat mengedit superadmin lain.');
        }
        
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user.
     */
    public function update(Request $request, User $user)
    {
        // Superadmin tidak bisa mengedit role superadmin lain
        if ($user->role === 'superadmin' && $user->id !== auth()->id()) {
            abort(403, 'Tidak dapat mengedit superadmin lain.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string', Rule::in(['kasir', 'sosmed'])],
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        
        // Hanya bisa mengubah role jika bukan superadmin
        if ($user->role !== 'superadmin') {
            $user->role = $validated['role'];
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user.
     */
    public function destroy(User $user)
    {
        // Tidak bisa menghapus superadmin
        if ($user->role === 'superadmin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat menghapus superadmin.');
        }

        // Tidak bisa menghapus diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
