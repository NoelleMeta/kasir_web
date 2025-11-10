<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function showLoginForm()
	{
		return view('auth.login');
	}

	public function login(Request $request)
	{
		$credentials = $request->validate([
			'username' => ['required', 'string'],
			'password' => ['required', 'string'],
		]);

		if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();
            // Ubah redirect ke rute dashboard (yang sekarang ada di /admin)
            return redirect()->intended(route('dashboard')); // route('dashboard') akan otomatis mengarah ke /admin
        }

		return back()->withErrors([
			'username' => 'Username atau password salah.',
		])->onlyInput('username');
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		// Jika request dari AJAX atau halaman laporan, redirect dengan parameter
		if ($request->ajax() || $request->is('laporan/*')) {
			return redirect()->route('login')->with('session_expired', true);
		}

		return redirect()->route('login');
	}

	public function account()
	{
		return view('auth.account');
	}

	public function resetAccount(Request $request)
	{
		$validated = $request->validate([
			'current_password' => ['required', 'string'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
		]);

		$user = $request->user();
		if (! Hash::check($validated['current_password'], $user->password)) {
			return back()->withErrors(['current_password' => 'Password sekarang tidak sesuai.']);
		}

		$user->password = Hash::make($validated['password']);
		$user->save();

		return back()->with('status', 'Password berhasil diperbarui.');
	}
}


