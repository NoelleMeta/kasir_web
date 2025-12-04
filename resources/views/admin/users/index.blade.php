@extends('layouts.app')
@section('title','Manajemen User')
@section('page_title','Manajemen User')
@section('actions')
    <a href="{{ route('admin.users.create') }}" class="btn primary">Tambah User</a>
@endsection
@section('content')
    <div class="container" style="max-width:1000px;">
        @if (session('success'))
            <div style="background:#064e3b;color:#d1fae5;border:1px solid #065f46;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div style="background:#3f1d1d;color:#fecaca;border:1px solid #7f1d1d;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
                {{ session('error') }}
            </div>
        @endif

        <div style="background:#ffffff;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.06);padding:16px;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="border-bottom:1px solid #e2e8f0;">
                        <th style="padding:12px;text-align:left;color:#475569;font-weight:600;">Nama</th>
                        <th style="padding:12px;text-align:left;color:#475569;font-weight:600;">Username</th>
                        <th style="padding:12px;text-align:left;color:#475569;font-weight:600;">Role</th>
                        <th style="padding:12px;text-align:right;color:#475569;font-weight:600;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:12px;color:#334155;">{{ $user->name }}</td>
                        <td style="padding:12px;color:#334155;">{{ $user->username }}</td>
                        <td style="padding:12px;">
                            <span style="display:inline-block;padding:4px 8px;border-radius:6px;font-size:12px;font-weight:600;
                                @if($user->role === 'superadmin') background:#dbeafe;color:#1e40af;
                                @elseif($user->role === 'kasir') background:#dcfce7;color:#166534;
                                @else background:#fef3c7;color:#92400e;
                                @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td style="padding:12px;text-align:right;">
                            <div style="display:flex;gap:8px;justify-content:flex-end;">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn" style="padding:6px 12px;font-size:13px;">Edit</a>
                                @if($user->role !== 'superadmin' && $user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="padding:6px 12px;font-size:13px;background:#ef4444;color:white;">Hapus</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding:24px;text-align:center;color:#64748b;">Tidak ada user.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

