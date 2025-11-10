<?php

namespace App\Http\Controllers;

use App\Models\LandingPageSetting;
use App\Models\MenuUnggulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{
    /**
     * Menampilkan halaman edit landing page
     */
    public function index()
    {
        // Get all settings
        $settings = LandingPageSetting::all()->keyBy('key');

        // Get menu unggulan
        $menuUnggulan1 = MenuUnggulan::getByUrutan(1);
        $menuUnggulan2 = MenuUnggulan::getByUrutan(2);
        $menuUnggulan3 = MenuUnggulan::getByUrutan(3);
        $menuUnggulan4 = MenuUnggulan::getByUrutan(4);

        return view('admin.landing-page', compact('settings', 'menuUnggulan1', 'menuUnggulan2', 'menuUnggulan3', 'menuUnggulan4'));
    }

    /**
     * Update kontak settings
     */
    public function updateKontak(Request $request)
    {
        $validated = $request->validate([
            'kontak_alamat' => 'required|string',
            'kontak_telepon' => 'required|string',
            'kontak_jam_buka' => 'required|string',
            'kontak_tiktok' => 'nullable|string',
            'kontak_instagram' => 'nullable|string',
            'kontak_facebook' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            LandingPageSetting::setValue($key, $value, 'text', $this->getLabel($key));
        }

        return redirect()->route('landing-page.index')->with('success', 'Kontak berhasil diperbarui.');
    }

    /**
     * Upload background images - Save as base64 in database
     * Handles multiple backgrounds in one request
     */
    public function uploadBackground(Request $request)
    {
        $validated = $request->validate([
            'backgrounds' => 'required|array',
            'backgrounds.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB per image
        ]);

        $uploaded = [];
        foreach ($validated['backgrounds'] as $bgType => $file) {
            if ($file && $file->isValid()) {
                // Convert image to base64
                $imageData = file_get_contents($file->getRealPath());
                $base64 = base64_encode($imageData);
                $mimeType = $file->getMimeType();
                $base64String = 'data:' . $mimeType . ';base64,' . $base64;

                // Save base64 to database
                LandingPageSetting::setValue('bg_' . $bgType, $base64String, 'image', $this->getLabel('bg_' . $bgType));
                $uploaded[] = ucfirst(str_replace('_', ' ', $bgType));
            }
        }

        if (count($uploaded) > 0) {
            return redirect()->route('landing-page.index')->with('success', 'Background ' . implode(', ', $uploaded) . ' berhasil diunggah.');
        }

        return redirect()->route('landing-page.index')->with('error', 'Tidak ada file yang diunggah.');
    }

    /**
     * Reset/Delete background images
     * Can reset all or specific background
     */
    public function resetBackground(Request $request)
    {
        if ($request->has('reset_all') && $request->reset_all == '1') {
            // Reset all backgrounds
            $bgTypes = ['home_1', 'home_2', 'home_3', 'about', 'menu', 'kontak'];
            foreach ($bgTypes as $bgType) {
                $setting = LandingPageSetting::where('key', 'bg_' . $bgType)->first();
                if ($setting) {
                    $setting->value = null;
                    $setting->save();
                }
            }
            return redirect()->route('landing-page.index')->with('success', 'Semua background berhasil direset.');
        }

        // Reset specific background (backward compatibility)
        $validated = $request->validate([
            'bg_type' => 'required|in:home_1,home_2,home_3,about,menu,kontak',
        ]);

        $setting = LandingPageSetting::where('key', 'bg_' . $validated['bg_type'])->first();
        if ($setting) {
            $setting->value = null;
            $setting->save();
        }

        return redirect()->route('landing-page.index')->with('success', 'Background berhasil direset.');
    }

    /**
     * Update menu unggulan
     */
    public function updateMenuUnggulan(Request $request, $urutan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB
        ]);

        $menu = MenuUnggulan::updateOrCreate(
            ['urutan' => $urutan],
            [
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
            ]
        );

        // Handle image upload - Save as base64 in database
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            // Convert image to base64
            $imageData = file_get_contents($file->getRealPath());
            $base64 = base64_encode($imageData);
            $mimeType = $file->getMimeType();
            $base64String = 'data:' . $mimeType . ';base64,' . $base64;

            $menu->gambar = $base64String;
            $menu->save();
        }

        return redirect()->route('landing-page.index')->with('success', 'Menu unggulan berhasil diperbarui.');
    }

    /**
     * Upload menu PDF
     */
    public function uploadMenuPdf(Request $request)
    {
        $validated = $request->validate([
            'menu_pdf' => 'required|mimes:pdf|max:10240', // 10MB max
        ]);

        $file = $request->file('menu_pdf');

        // Delete old file if exists
        $oldSetting = LandingPageSetting::where('key', 'menu_pdf')->first();
        if ($oldSetting && $oldSetting->value) {
            $oldPath = public_path('images/' . basename($oldSetting->value));
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // Save new file
        $filename = 'semua_menu.pdf';
        $file->move(public_path('images'), $filename);
        $path = 'images/' . $filename;

        LandingPageSetting::setValue('menu_pdf', $path, 'file', 'Menu PDF');

        return redirect()->route('landing-page.index')->with('success', 'Menu PDF berhasil diunggah.');
    }

    /**
     * Update about section text
     */
    public function updateAbout(Request $request)
    {
        $validated = $request->validate([
            'about_text_1' => 'required|string',
            'about_text_2' => 'required|string',
            'about_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB
        ]);

        LandingPageSetting::setValue('about_text_1', $validated['about_text_1'], 'text', 'About Text 1');
        LandingPageSetting::setValue('about_text_2', $validated['about_text_2'], 'text', 'About Text 2');

        // Handle image upload - Save as base64 in database
        if ($request->hasFile('about_gambar')) {
            $file = $request->file('about_gambar');

            // Convert image to base64
            $imageData = file_get_contents($file->getRealPath());
            $base64 = base64_encode($imageData);
            $mimeType = $file->getMimeType();
            $base64String = 'data:' . $mimeType . ';base64,' . $base64;

            LandingPageSetting::setValue('about_gambar', $base64String, 'image', 'About Image');
        }

        return redirect()->route('landing-page.index')->with('success', 'About section berhasil diperbarui.');
    }

    /**
     * Helper method to get label from key
     */
    private function getLabel($key)
    {
        $labels = [
            'bg_home_1' => 'Background Home 1',
            'bg_home_2' => 'Background Home 2',
            'bg_home_3' => 'Background Home 3',
            'bg_about' => 'Background About',
            'bg_menu' => 'Background Menu',
            'bg_kontak' => 'Background Kontak',
            'kontak_alamat' => 'Alamat',
            'kontak_telepon' => 'Telepon',
            'kontak_jam_buka' => 'Jam Buka',
            'kontak_instagram' => 'Instagram',
            'kontak_facebook' => 'Facebook',
            'menu_pdf' => 'Menu PDF',
        ];

        return $labels[$key] ?? ucfirst(str_replace('_', ' ', $key));
    }
}
