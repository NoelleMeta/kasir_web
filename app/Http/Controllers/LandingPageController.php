<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingPageSetting;
use App\Models\MenuUnggulan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman landing utama (V1 - Modern).
     */
    public function index()
    {
        $settings = LandingPageSetting::all()->keyBy('key');
        $menuItems = MenuUnggulan::orderBy('id', 'asc')->get();

        $data = [
            'settings' => $settings,
            'menuItems' => $menuItems,
            'menuUnggulan1' => $menuItems->firstWhere('id', 1),
            'menuUnggulan2' => $menuItems->firstWhere('id', 2),
            'menuUnggulan3' => $menuItems->firstWhere('id', 3),
            'menuUnggulan4' => $menuItems->firstWhere('id', 4),
        ];

        return view('landing', $data);
    }

    /**
     * (INI FUNGSI BARU)
     * Menampilkan halaman landing V2 (Tradisional).
     */
    public function indexV2()
    {
        // Logika pengambilan datanya sama dengan index()
        $settings = LandingPageSetting::all()->keyBy('key');
        $menuItems = MenuUnggulan::orderBy('id', 'asc')->get();

        $data = [
            'settings' => $settings,
            'menuItems' => $menuItems,
            'menuUnggulan1' => $menuItems->firstWhere('id', 1),
            'menuUnggulan2' => $menuItems->firstWhere('id', 2),
            'menuUnggulan3' => $menuItems->firstWhere('id', 3),
            'menuUnggulan4' => $menuItems->firstWhere('id', 4),
        ];

        // Mengarahkan ke view 'landing-v2'
        return view('landing-v2', $data);
    }


    /**
     * Menampilkan halaman admin untuk mengelola landing page.
     */
    public function showAdminPage()
    {
        $settings = LandingPageSetting::all()->keyBy('key');
        $menuItems = MenuUnggulan::orderBy('id', 'asc')->get();

        $data = [
            'settings' => $settings,
            'menuUnggulan1' => $menuItems->firstWhere('id', 1),
            'menuUnggulan2' => $menuItems->firstWhere('id', 2),
            'menuUnggulan3' => $menuItems->firstWhere('id', 3),
            'menuUnggulan4' => $menuItems->firstWhere('id', 4),
        ];

        return view('admin.landing-page', $data);
    }

    /**
     * Upload background images.
     */
    public function uploadBackground(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'backgrounds.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // 10MB max
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->has('backgrounds')) {
            foreach ($request->file('backgrounds') as $key => $file) {
                // Hapus file lama jika ada
                $settingKey = 'bg_' . $key;
                $oldSetting = LandingPageSetting::where('key', $settingKey)->first();
                if ($oldSetting && $oldSetting->value) {
                    Storage::disk('public')->delete($oldSetting->value);
                }

                // Simpan file baru
                $path = $file->store('images/backgrounds', 'public');

                LandingPageSetting::updateOrCreate(
                    ['key' => $settingKey],
                    ['value' => $path]
                );
            }
        }

        return back()->with('success', 'Background images berhasil di-upload.');
    }

    /**
     * Reset (hapus) background images.
     */
    public function resetBackground(Request $request)
    {
        if ($request->input('reset_all') == '1') {
            $bgKeys = ['bg_home_1', 'bg_home_2', 'bg_home_3', 'bg_about', 'bg_menu', 'bg_kontak'];
            $settings = LandingPageSetting::whereIn('key', $bgKeys)->get();

            foreach ($settings as $setting) {
                if ($setting->value) {
                    Storage::disk('public')->delete($setting->value);
                }
                $setting->delete();
            }
            return back()->with('success', 'Semua background images berhasil di-reset.');
        }
        return back()->with('error', 'Gagal me-reset background.');
    }


    /**
     * Update menu unggulan.
     */
    public function updateMenu(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:500',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // 10MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $menu = MenuUnggulan::firstOrNew(['id' => $id]);
        $menu->nama = $request->input('nama');
        $menu->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            // Simpan gambar baru
            $path = $request->file('gambar')->store('images/menu_unggulan', 'public');
            $menu->gambar = $path;
        }

        $menu->save();

        return back()->with('success', "Menu Unggulan $id berhasil disimpan.");
    }

    /**
     * Update deskripsi header menu unggulan.
     */
    public function updateMenuDeskripsi(Request $request)
    {
        $request->validate([
            'menu_unggulan_deskripsi' => 'nullable|string|max:1000',
        ]);

        LandingPageSetting::updateOrCreate(
            ['key' => 'menu_unggulan_deskripsi'],
            ['value' => $request->input('menu_unggulan_deskripsi')]
        );

        return back()->with('success', 'Deskripsi Menu Unggulan berhasil disimpan.');
    }

    /**
     * Update info kontak.
     */
    public function updateKontak(Request $request)
    {
        $data = $request->validate([
            'kontak_alamat' => 'required|string|max:255',
            'kontak_telepon' => 'required|string|max:50',
            'kontak_jam_buka' => 'required|string|max:100',
            'kontak_tiktok' => 'nullable|string|max:100',
            'kontak_instagram' => 'nullable|string|max:100',
        ]);

        foreach ($data as $key => $value) {
            LandingPageSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? '']
            );
        }

        return back()->with('success', 'Info Kontak berhasil disimpan.');
    }

    /**
     * Update section About Us.
     */
    public function updateAbout(Request $request)
    {
        $data = $request->validate([
            'about_text_1' => 'required|string|max:1000',
            'about_text_2' => 'required|string|max:1000',
            'about_gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // 10MB
        ]);

        LandingPageSetting::updateOrCreate(
            ['key' => 'about_text_1'],
            ['value' => $data['about_text_1']]
        );
        LandingPageSetting::updateOrCreate(
            ['key' => 'about_text_2'],
            ['value' => $data['about_text_2']]
        );

        if ($request->hasFile('about_gambar')) {
            $key = 'about_gambar';
            $file = $request->file('about_gambar');

            // Hapus file lama jika ada
            $oldSetting = LandingPageSetting::where('key', $key)->first();
            if ($oldSetting && $oldSetting->value) {
                Storage::disk('public')->delete($oldSetting->value);
            }

            // Simpan file baru
            $path = $file->store('images/about', 'public');

            LandingPageSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $path]
            );
        }

        return back()->with('success', 'Section About Us berhasil disimpan.');
    }

    /**
     * Upload Menu PDF.
     */
    public function uploadMenuPdf(Request $request)
    {
        $request->validate([
            'menu_pdf' => 'required|file|mimes:pdf|max:10240', // 10MB
        ]);

        if ($request->hasFile('menu_pdf')) {
            $key = 'menu_pdf';
            $file = $request->file('menu_pdf');

            // Hapus file lama jika ada
            $oldSetting = LandingPageSetting::where('key', $key)->first();
            if ($oldSetting && $oldSetting->value) {
                Storage::disk('public')->delete($oldSetting->value);
            }

            // Simpan file baru
            $path = $file->storeAs('menu', 'menu_lengkap_rm_gulai_kakek.pdf', 'public');

            LandingPageSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $path]
            );
        }

        return back()->with('success', 'Menu PDF berhasil di-upload.');
    }
}
