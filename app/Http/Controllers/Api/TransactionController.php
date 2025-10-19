<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\TransactionItem;

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
        // Validasi input dasar
        $validated = $request->validate([
            'nomorTransaksi' => 'required|string|max:255',
            'waktuTransaksi' => 'required|date',
            'subtotal' => 'required|numeric',
            'ppnJumlah' => 'nullable|numeric',
            'grandTotal' => 'required|numeric',
            'metodePembayaran' => 'nullable|string|max:255',
            'lokasiMeja' => 'nullable|string|max:255',
            'nomorMeja' => 'nullable|string|max:50',
            'jumlahBayar' => 'nullable|numeric',
            'jumlahKembali' => 'nullable|numeric',
            'items' => 'required|array|min:1',
            'items.*.namaProduk' => 'required|string|max:255',
            'items.*.kategoriId' => 'nullable|integer',
            'items.*.kuantitas' => 'required|integer|min:1',
            'items.*.hargaSatuan' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // Simpan data transaksi utama
                $transaction = Transaction::create([
                    'nomor_transaksi' => $validated['nomorTransaksi'],
                    'waktu_transaksi' => $validated['waktuTransaksi'],
                    'subtotal' => $validated['subtotal'],
                    'ppn_jumlah' => $validated['ppnJumlah'] ?? 0,
                    'grand_total' => $validated['grandTotal'],
                    'metode_pembayaran' => $validated['metodePembayaran'] ?? null,
                    'lokasi_meja' => $validated['lokasiMeja'] ?? null,
                    'nomor_meja' => $validated['nomorMeja'] ?? null,
                    'jumlah_bayar' => $validated['jumlahBayar'] ?? null,
                    'jumlah_kembali' => $validated['jumlahKembali'] ?? null,
                ]);

                // Simpan setiap item transaksi
                foreach ($validated['items'] as $item) {
                    $transaction->items()->create([
                        'nama_produk' => $item['namaProduk'],
                        'kategori_id' => $item['kategoriId'] ?? null,
                        'kuantitas' => $item['kuantitas'],
                        'harga_satuan' => $item['hargaSatuan'],
                    ]);
                }
            });
    } catch (\Exception $e) {
            Log::error('Gagal menyimpan transaksi: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Transaksi berhasil disimpan'], 201);
    }
    public function destroy($nomorTransaksi)
    {
        try {
            // Cari transaksi berdasarkan nomor uniknya
            $transaction = Transaction::where('nomor_transaksi', $nomorTransaksi)->first();

            if ($transaction) {
                // Hapus transaksi (dan item-itemnya karena sudah di-cascade)
                $transaction->delete();
                return response()->json(['message' => 'Transaksi berhasil dihapus'], 200);
            } else {
                return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
