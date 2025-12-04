@extends('layouts.app')
@section('title','Tambah User')
@section('page_title','Tambah User Baru')
@section('content')
    <div class="container" style="max-width:720px;">
        @if ($errors->any())
            <div style="background:#3f1d1d;color:#fecaca;border:1px solid #7f1d1d;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
                <ul style="margin:0 0 0 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="background:#ffffff;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.06);padding:16px;">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div style="margin-bottom:12px;">
                    <label style="display:block;margin-bottom:6px;color:#475569;font-weight:600;">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>
                <div style="margin-bottom:12px;">
                    <label style="display:block;margin-bottom:6px;color:#475569;font-weight:600;">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" required>
                </div>
                <div style="margin-bottom:12px;">
                    <label style="display:block;margin-bottom:6px;color:#475569;font-weight:600;">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="kasir" {{ old('role') === 'kasir' ? 'selected' : '' }}>Kasir</option>
                        <option value="sosmed" {{ old('role') === 'sosmed' ? 'selected' : '' }}>Sosmed</option>
                    </select>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
                    <div>
                        <label style="display:block;margin-bottom:6px;color:#475569;font-weight:600;">Password</label>
                        <div class="password-container">
                            <input type="password" name="password" id="password" class="form-control password-input" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <span id="password-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label style="display:block;margin-bottom:6px;color:#475569;font-weight:600;">Konfirmasi Password</label>
                        <div class="password-container">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control password-input" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                <span id="password_confirmation-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div style="margin-top:14px;display:flex;gap:10px;justify-content:flex-end;">
                    <a href="{{ route('admin.users.index') }}" class="btn">Batal</a>
                    <button type="submit" class="btn primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

