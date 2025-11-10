@extends('layouts.app')
@section('title','Akun')
@section('page_title','Pengaturan Akun')
@section('content')
    <div class="container" style="max-width:720px;">
        @if (session('status'))
            <div style="background:#064e3b;color:#d1fae5;border:1px solid #065f46;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
                {{ session('status') }}
            </div>
        @endif
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
            <h3 style="margin:0 0 12px 0;color:#334155">Reset Password</h3>
            <form method="POST" action="{{ route('account.reset') }}">
                @csrf
                <div style="margin-bottom:12px;">
                    <label style="display:block;margin-bottom:6px;color:#475569;">Password sekarang</label>
                    <div class="password-container">
                        <input type="password" name="current_password" id="current_password" class="form-control password-input" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                            <span id="current_password-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                    <div>
                        <label style="display:block;margin-bottom:6px;color:#475569;">Password baru</label>
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
                        <label style="display:block;margin-bottom:6px;color:#475569;">Konfirmasi password</label>
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
                    <button type="submit" class="btn primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection


