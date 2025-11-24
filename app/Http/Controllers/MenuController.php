<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MenuController extends Controller
{
    /**
     * Serve existing compiled PDF `public/images/semua_menu.pdf` inline in-browser.
     */
    public function daftarPdf(Request $request)
    {
        // Try to get from database first
        $menuPdf = \App\Models\LandingPageSetting::getValue('menu_pdf', 'images/semua_menu.pdf');
        $pdfPath = public_path($menuPdf);

        // Fallback to default if database file doesn't exist
        if (!file_exists($pdfPath)) {
            $pdfPath = public_path('images/semua_menu.pdf');
        }

        if (!file_exists($pdfPath)) {
            return response()->json(['message' => 'File daftar menu tidak ditemukan.'], 404);
        }

        // Serve the file inline so the browser opens it in PDF viewer
        return response()->file($pdfPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="semua_menu.pdf"'
        ]);
    }

    /**
     * Backward compatible alias used in some routes: daftarView -> daftarPdf
     */
    public function daftarView(Request $request)
    {
        return $this->daftarPdf($request);
    }

    /**
     * Backward compatible alias used in routes: showPdf -> daftarPdf
     */
    public function showPdf(Request $request)
    {
        return $this->daftarPdf($request);
    }
}
