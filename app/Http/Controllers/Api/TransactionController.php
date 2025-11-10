<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    /**
     * Mengambil daftar transaksi dengan paginasi untuk ditampilkan di aplikasi.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $transactions = Transaction::with('items')
            ->orderBy('waktu_transaksi', 'desc')
            ->paginate(100);

        return response()->json($transactions);
    }

    /**
     * Menyimpan transaksi baru yang dikirim dari aplikasi kasir.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nomorTransaksi' => 'required|string|unique:transactions,nomor_transaksi',
                'waktuTransaksi' => 'required|date',
                'subtotal' => 'required|numeric|min:0',
                'ppnJumlah' => 'nullable|numeric|min:0',
                'grandTotal' => 'required|numeric|min:0',
                'metodePembayaran' => 'nullable|string|max:255',
                'lokasiMeja' => 'nullable|string|max:255',
                'nomorMeja' => 'nullable|integer', // Disesuaikan menjadi integer
                'jumlahBayar' => 'nullable|numeric|min:0',
                'jumlahKembali' => 'nullable|numeric|min:0',
                'items' => 'required|array|min:1',
                'items.*.namaProduk' => 'required|string|max:255',
                'items.*.kategoriId' => 'nullable|integer',
                'items.*.kuantitas' => 'required|integer|min:1',
                'items.*.hargaSatuan' => 'required|numeric|min:0',
            ]);

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

            return response()->json(['message' => 'Transaksi berhasil disimpan'], 201);

        } catch (ValidationException $e) {
            // Jika validasi gagal, kembalikan error validasi
            return response()->json(['message' => 'Data tidak valid', 'errors' => $e->errors()], 422);

        } catch (\Exception $e) {
            // Jika nomorTransaksi sudah ada (error constraint), anggap sukses untuk idempotensi
            if (str_contains($e->getMessage(), 'UNIQUE constraint failed: transactions.nomor_transaksi')) {
                return response()->json(['message' => 'Transaksi duplikat, dianggap sudah tersimpan.'], 200);
            }

            // Untuk error lainnya, log dan kembalikan error server
            Log::error('Gagal menyimpan transaksi: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menyimpan data', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Menghapus transaksi berdasarkan nomor uniknya.
     *
     * @param  string  $nomorTransaksi
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($nomorTransaksi)
    {
        try {
            $transaction = Transaction::where('nomor_transaksi', $nomorTransaksi)->first();

            if ($transaction) {
                // Hapus transaksi (dan item-itemnya karena onDelete('cascade'))
                $transaction->delete();
                return response()->json(['message' => 'Transaksi berhasil dihapus'], 200);
            }

            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);

        } catch (\Exception $e) {
            Log::error('Gagal menghapus transaksi ' . $nomorTransaksi . ': ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menghapus data', 'error' => $e->getMessage()], 500);
        }
    }
}
