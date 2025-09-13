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
        try {
            DB::transaction(function () use ($request) {
                // Simpan data transaksi utama, termasuk data baru
                $transaction = Transaction::create([
                    'nomor_transaksi' => $request->nomorTransaksi,
                    'waktu_transaksi' => $request->waktuTransaksi,
                    'subtotal' => $request->subtotal,
                    'ppn_jumlah' => $request->ppnJumlah,
                    'grand_total' => $request->grandTotal,
                    'metode_pembayaran' => $request->metodePembayaran,
                    'lokasi_meja' => $request->lokasiMeja,
                    'nomor_meja' => $request->nomorMeja,
                    'jumlah_bayar' => $request->jumlahBayar,
                    'jumlah_kembali' => $request->jumlahKembali,
                ]);

                // Simpan setiap item transaksi, termasuk kategori_id
                foreach ($request->items as $item) {
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
