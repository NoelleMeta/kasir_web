<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Fungsi untuk MENGIRIM data transaksi ke aplikasi Flutter DENGAN PAGINASI.
     */
    public function index()
    {
        $transactions = Transaction::with('items')
                                ->orderBy('waktu_transaksi', 'desc')
                                ->paginate(100);

        // Mengembalikan data sebagai JSON terstruktur yang sudah mendukung paginasi.
        return response()->json($transactions);
    }
    public function store(Request $request)
    {
        // Validasi ketat agar sesuai kolom DB dan struktur data
        $validated = $request->validate([
            'nomorTransaksi' => 'required|string|unique:transactions,nomor_transaksi',
            'waktuTransaksi' => 'required|date',
            'subtotal' => 'required|integer|min:0',
            'ppnJumlah' => 'required|integer|min:0',
            'grandTotal' => 'required|integer|min:0',
            'metodePembayaran' => 'required|string',
            'lokasiMeja' => 'nullable|string',
            'nomorMeja' => 'nullable|integer',
            'items' => 'required|array|min:1',
            'items.*.namaProduk' => 'required|string',
            'items.*.kuantitas' => 'required|integer|min:1',
            'items.*.hargaSatuan' => 'required|integer|min:0',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // Simpan data transaksi utama
                $transaction = Transaction::create([
                    'nomor_transaksi' => $validated['nomorTransaksi'],
                    'waktu_transaksi' => $validated['waktuTransaksi'],
                    'subtotal' => $validated['subtotal'],
                    'ppn_jumlah' => $validated['ppnJumlah'],
                    'grand_total' => $validated['grandTotal'],
                    'metode_pembayaran' => $validated['metodePembayaran'],
                    'lokasi_meja' => $validated['lokasiMeja'] ?? null,
                    'nomor_meja' => $validated['nomorMeja'] ?? null,
                ]);

                // Simpan setiap item transaksi
                foreach ($validated['items'] as $item) {
                    $transaction->items()->create([
                        'nama_produk' => $item['namaProduk'],
                        'kategori_id' => $item['kategoriId'],
                        'kuantitas' => $item['kuantitas'],
                        'harga_satuan' => $item['hargaSatuan'],
                    ]);
                }
            });
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Transaksi berhasil disimpan'], 201);
    }
}
