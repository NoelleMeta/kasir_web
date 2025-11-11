@extends('layouts.app')
@section('title','Landing Page')
@section('page_title','Kelola Landing Page')

@section('content')
<div style="max-width:1200px;">
    @if (session('success'))
        <div style="background:#064e3b;color:#d1fae5;border:1px solid #065f46;padding:10px 12px;border-radius:8px;margin-bottom:12px;">
            {{ session('success') }}
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

    <div style="background:#ffffff;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.06);padding:20px;margin-bottom:20px;">
        <h3 style="margin:0 0 16px 0;color:#334155;border-bottom:2px solid #e2e8f0;padding-bottom:8px;">Background Images</h3>

        <form method="POST" action="{{ route('landing-page.upload-background') }}" enctype="multipart/form-data" id="form-backgrounds">
            @csrf
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:16px;margin-bottom:20px;">
                @foreach(['home_1','home_2','home_3','about','menu','kontak'] as $bgType)
                <div style="border:1px solid #e2e8f0;border-radius:8px;padding:12px;">
                    <label style="display:block;margin-bottom:8px;color:#475569;font-weight:600;">Background {{ ucfirst(str_replace('_',' ',$bgType)) }}</label>
                    @php
                        $bgKey = 'bg_' . $bgType;
                        $bgSetting = $settings->get($bgKey);
                    @endphp
                    @if($bgSetting && $bgSetting->value)
                        <img src="{{ \App\Models\LandingPageSetting::getImageSrc($bgSetting->value) }}" alt="Background {{ $bgType }}" style="width:100%;height:120px;object-fit:cover;border-radius:6px;margin-bottom:8px;">
                    @else
                        <div style="width:100%;height:120px;background:#f1f5f9;border-radius:6px;margin-bottom:8px;display:flex;align-items:center;justify-content:center;color:#64748b;font-size:0.9rem;">No image</div>
                    @endif
                    <input type="file" name="backgrounds[{{ $bgType }}]" accept="image/*" id="file-bg-{{ $bgType }}" style="display:none;" onchange="updateFileName('{{ $bgType }}', this)">
                    <button type="button" onclick="document.getElementById('file-bg-{{ $bgType }}').click();" class="btn" style="width:100%;margin-bottom:4px;background:#e2e8f0;color:#475569;">Browse</button>
                    <small id="file-name-{{ $bgType }}" style="color:#64748b;display:block;font-size:0.85rem;min-height:20px;"></small>
                </div>
                @endforeach
            </div>
            <small style="color:#64748b;display:block;margin-bottom:12px;">Maksimal 10MB per gambar</small>
            <button type="submit" class="btn primary">Upload Semua Background</button>
        </form>

        <form method="POST" action="{{ route('landing-page.reset-background') }}" onsubmit="return confirm('Yakin ingin menghapus semua background?');" style="margin-top:12px;">
            @csrf
            <input type="hidden" name="reset_all" value="1">
            <button type="submit" class="btn" style="background:#dc2626;color:#fff;">Reset Semua Background</button>
        </form>
    </div>

    <div style="background:#ffffff;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.06);padding:20px;margin-bottom:20px;">
        <h3 style="margin:0 0 16px 0;color:#334155;border-bottom:2px solid #e2e8f0;padding-bottom:8px;">Menu Unggulan</h3>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div style="border:1px solid #e2e8f0;border-radius:8px;padding:16px;">
                <h4 style="margin:0 0 12px 0;color:#475569;">Menu Unggulan 1 (Top Left)</h4>
                <form method="POST" action="{{ route('landing-page.update-menu', 1) }}" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Nama Menu</label>
                        <input type="text" name="nama" value="{{ $menuUnggulan1->nama ?? '' }}" required class="form-control">
                    </div>
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Deskripsi</label>
                        <textarea name="deskripsi" required class="form-control" rows="4">{{ $menuUnggulan1->deskripsi ?? '' }}</textarea>
                    </div>
                    @if($menuUnggulan1 && $menuUnggulan1->gambar)
                        <img src="{{ $menuUnggulan1->getImageSrc() }}" alt="Menu 1" style="width:100%;max-width:200px;height:150px;object-fit:cover;border-radius:6px;margin-bottom:8px;">
                    @endif
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Gambar Menu</label>
                        <input type="file" name="gambar" accept="image/*" class="form-control">
                        <small style="color:#64748b;display:block;margin-top:4px;">Maksimal 10MB</small>
                    </div>
                    <button type="submit" class="btn primary">Simpan Menu 1</button>
                </form>
            </div>

            <div style="border:1px solid #e2e8f0;border-radius:8px;padding:16px;">
                <h4 style="margin:0 0 12px 0;color:#475569;">Menu Unggulan 2 (Bottom Right)</h4>
                <form method="POST" action="{{ route('landing-page.update-menu', 2) }}" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Nama Menu</label>
                        <input type="text" name="nama" value="{{ $menuUnggulan2->nama ?? '' }}" required class="form-control">
                    </div>
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Deskripsi</label>
                        <textarea name="deskripsi" required class="form-control" rows="4">{{ $menuUnggulan2->deskripsi ?? '' }}</textarea>
                    </div>
                    @if($menuUnggulan2 && $menuUnggulan2->gambar)
                        <img src="{{ $menuUnggulan2->getImageSrc() }}" alt="Menu 2" style="width:100%;max-width:200px;height:150px;object-fit:cover;border-radius:6px;margin-bottom:8px;">
                    @endif
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Gambar Menu</label>
                        <input type="file" name="gambar" accept="image/*" class="form-control">
                        <small style="color:#64748b;display:block;margin-top:4px;">Maksimal 10MB</small>
                    </div>
                    <button type="submit" class="btn primary">Simpan Menu 2</button>
                </form>
            </div>

            <div style="border:1px solid #e2e8f0;border-radius:8px;padding:16px;">
                <h4 style="margin:0 0 12px 0;color:#475569;">Menu Unggulan 3 (Top Right)</h4>
                <form method="POST" action="{{ route('landing-page.update-menu', 3) }}" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Nama Menu</label>
                        <input type="text" name="nama" value="{{ $menuUnggulan3->nama ?? '' }}" required class="form-control">
                    </div>
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Deskripsi</label>
                        <textarea name="deskripsi" required class="form-control" rows="4">{{ $menuUnggulan3->deskripsi ?? '' }}</textarea>
                    </div>
                    @if($menuUnggulan3 && $menuUnggulan3->gambar)
                        <img src="{{ $menuUnggulan3->getImageSrc() }}" alt="Menu 3" style="width:100%;max-width:200px;height:150px;object-fit:cover;border-radius:6px;margin-bottom:8px;">
                    @endif
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Gambar Menu</label>
                        <input type="file" name="gambar" accept="image/*" class="form-control">
                        <small style="color:#64748b;display:block;margin-top:4px;">Maksimal 10MB</small>
                    </div>
                    <button type="submit" class="btn primary">Simpan Menu 3</button>
                </form>
            </div>

            <div style="border:1px solid #e2e8f0;border-radius:8px;padding:16px;">
                <h4 style="margin:0 0 12px 0;color:#475569;">Menu Unggulan 4 (Bottom Left)</h4>
                <form method="POST" action="{{ route('landing-page.update-menu', 4) }}" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Nama Menu</label>
                        <input type="text" name="nama" value="{{ $menuUnggulan4->nama ?? '' }}" required class="form-control">
                    </div>
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Deskripsi</label>
                        <textarea name="deskripsi" required class="form-control" rows="4">{{ $menuUnggulan4->deskripsi ?? '' }}</textarea>
                    </div>
                    @if($menuUnggulan4 && $menuUnggulan4->gambar)
                        <img src="{{ $menuUnggulan4->getImageSrc() }}" alt="Menu 4" style="width:100%;max-width:200px;height:150px;object-fit:cover;border-radius:6px;margin-bottom:8px;">
                    @endif
                    <div style="margin-bottom:12px;">
                        <label style="display:block;margin-bottom:6px;color:#475569;">Gambar Menu</label>
                        <input type="file" name="gambar" accept="image/*" class="form-control">
                        <small style="color:#64748b;display:block;margin-top:4px;">Maksimal 10MB</small>
                    </div>
                    <button type="submit" class="btn primary">Simpan Menu 4</button>
                </form>
            </div>
        </div>
    </div>

    <div style="background:#ffffff;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.06);padding:20px;margin-bottom:20px;">
        <h3 style="margin:0 0 16px 0;color:#334155;border-bottom:2px solid #e2e8f0;padding-bottom:8px;">Kontak Kami</h3>
        <form method="POST" action="{{ route('landing-page.update-kontak') }}">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="display:block;margin-bottom:6px;color:#475569;">Alamat</label>
                    <input type="text" name="kontak_alamat" value="{{ $settings->get('kontak_alamat') ? $settings->get('kontak_alamat')->value : 'Jl. Lintas Padang-Solok, Lubuk Selasih' }}" required class="form-control">
                </div>
                <div>
                    <label style="display:block;margin-bottom:6px;color:#475569;">Telepon</label>
                    <input type="text" name="kontak_telepon" value="{{ $settings->get('kontak_telepon') ? $settings->get('kontak_telepon')->value : '0813-6345-4213' }}" required class="form-control">
                </div>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:6px;color:#475569;">Jam Buka</label>
                <input type="text" name="kontak_jam_buka" value="{{ $settings->get('kontak_jam_buka') ? $settings->get('kontak_jam_buka')->value : 'Senin - Minggu, 07:30 - 22:00' }}" required class="form-control">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label style="display:block;margin-bottom:6px;color:#475569;">TikTok</label>
                    <input type="text" name="kontak_tiktok" value="{{ $settings->get('kontak_tiktok') ? $settings->get('kontak_tiktok')->value : '@gulaikambiangkakek' }}" class="form-control" placeholder="@gulaikambiangkakek">
                </div>
                <div>
                    <label style="display:block;margin-bottom:6px;color:#475569;">Instagram</label>
                    <input type="text" name="kontak_instagram" value="{{ $settings->get('kontak_instagram') ? $settings->get('kontak_instagram')->value : '@rm.gulai_kambiang_kakek' }}" class="form-control" placeholder="@rm.gulai_kambiang_kakek">
                </div>
            </div>
            <div style="margin-top:14px;display:flex;gap:10px;justify-content:flex-end;">
                <button type="submit" class="btn primary">Simpan Kontak</button>
            </div>
        </form>
    </div>

    <div style="background:#ffffff;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.06);padding:20px;margin-bottom:20px;">
        <h3 style="margin:0 0 16px 0;color:#334155;border-bottom:2px solid #e2e8f0;padding-bottom:8px;">About Us</h3>
        <form method="POST" action="{{ route('landing-page.update-about') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:6px;color:#475569;">Teks About 1</label>
                <textarea name="about_text_1" required class="form-control" rows="3">{{ $settings->get('about_text_1') ? $settings->get('about_text_1')->value : 'Di Gulai Kambiang Kakek, kami percaya bahwa masakan yang enak berasal dari resep yang tulus. Berdiri pada tahun 2024, kami membawa misi sederhana: menghadirkan gulai kambing seenak buatan "Kakek" di rumah—penuh cinta, kaya rempah, dan tak terlupakan.' }}</textarea>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:6px;color:#475569;">Teks About 2</label>
                <textarea name="about_text_2" required class="form-control" rows="3">{{ $settings->get('about_text_2') ? $settings->get('about_text_2')->value : 'Kami adalah rumah bagi para pencinta hidangan kambing. Dengan bangga, kami menempatkan Gulai Kepala Kambing dan Gulai Kambing sebagai bintang utama di dapur kami. Dibuat dari bahan-bahan segar dan daging pilihan, kami menjamin tekstur yang empuk dan bumbu yang meresap hingga ke tulang.' }}</textarea>
            </div>
            @if($settings->get('about_gambar') && $settings->get('about_gambar')->value)
                <img src="{{ \App\Models\LandingPageSetting::getImageSrc($settings->get('about_gambar')->value) }}" alt="About Image" style="width:100%;max-width:300px;height:200px;object-fit:cover;border-radius:6px;margin-bottom:8px;">
            @endif
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:6px;color:#475569;">Gambar About</label>
                <input type="file" name="about_gambar" accept="image/*" class="form-control">
                <small style="color:#64748b;display:block;margin-top:4px;">Maksimal 10MB</small>
            </div>
            <div style="margin-top:14px;display:flex;gap:10px;justify-content:flex-end;">
                <button type="submit" class="btn primary">Simpan About</button>
            </div>
        </form>
    </div>

    <div style="background:#ffffff;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.06);padding:20px;margin-bottom:20px;">
        <h3 style="margin:0 0 16px 0;color:#334155;border-bottom:2px solid #e2e8f0;padding-bottom:8px;">Deskripsi Menu Unggulan</h3>
        <form method="POST" action="{{ route('landing-page.update-menu-deskripsi') }}">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:6px;color:#475569;">Teks Deskripsi</label>
                <textarea name="menu_unggulan_deskripsi" class="form-control" rows="5" placeholder="Dengan bangga kami persembahkan hidangan terbaik kami...">{{ $settings->get('menu_unggulan_deskripsi') ? $settings->get('menu_unggulan_deskripsi')->value : '' }}</textarea>
                <small style="color:#64748b;display:block;margin-top:4px;">Teks ini akan muncul di area judul menu unggulan (di tempat Anda silang).</small>
            </div>
            <div style="margin-top:14px;display:flex;gap:10px;justify-content:flex-end;">
                <button type="submit" class="btn primary">Simpan Deskripsi</button>
            </div>
        </form>
    </div>
    <div style="background:#ffffff;border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.06);padding:20px;margin-bottom:20px;">
        <h3 style="margin:0 0 16px 0;color:#334155;border-bottom:2px solid #e2e8f0;padding-bottom:8px;">Menu PDF</h3>
        @if($settings->get('menu_pdf') && $settings->get('menu_pdf')->value)
            <p style="margin:0 0 12px 0;color:#64748b;">File saat ini: <a href="{{ asset($settings->get('menu_pdf')->value) }}" target="_blank">{{ basename($settings->get('menu_pdf')->value) }}</a></p>
        @endif
        <form method="POST" action="{{ route('landing-page.upload-menu-pdf') }}" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;margin-bottom:6px;color:#475569;">Upload Menu PDF</label>
                <input type="file" name="menu_pdf" accept=".pdf" required class="form-control">
                <small style="color:#64748b;display:block;margin-top:4px;">Maksimal 10MB</small>
            </div>
            <div style="margin-top:14px;display:flex;gap:10px;justify-content:flex-end;">
                <button type="submit" class="btn primary">Upload Menu PDF</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(bgType, input) {
        const fileNameDisplay = document.getElementById('file-name-' + bgType);
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
            fileNameDisplay.textContent = fileName + ' (' + fileSize + ' MB)';
            fileNameDisplay.style.color = '#059669';
        } else {
            fileNameDisplay.textContent = '';
        }
    }
</script>
@endsection
