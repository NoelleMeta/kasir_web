<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // Validasi sederhana (bisa Anda kembangkan)
        $validated = $request->validate([
            'nomorTransaksi' => 'required|string|unique:transactions,nomor_transaksi',
            'items' => 'required|array|min:1'
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Simpan data transaksi utama
                $transaction = Transaction::create([
                    'nomor_transaksi' => $request->nomorTransaksi,
                    'waktu_transaksi' => $request->waktuTransaksi,
                    'subtotal' => $request->subtotal,
                    'ppn_jumlah' => $request->ppnJumlah,
                    'grand_total' => $request->grandTotal,
                    'metode_pembayaran' => $request->metodePembayaran,
                    'lokasi_meja' => $request->lokasiMeja,
                    'nomor_meja' => $request->nomorMeja,
                ]);

                // Simpan setiap item transaksi
                foreach ($request->items as $item) {
                    $transaction->items()->create([
                        'nama_produk' => $item['namaProduk'],
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
