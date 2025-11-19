<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function topProducts(Request $request)
    {
        // Accept selected_month/selected_year (from UI) or fallback to current month/year
        $currentMonth = $request->query('selected_month') ?? $request->query('month') ?? date('m');
        $currentYear = $request->query('selected_year') ?? $request->query('year') ?? date('Y');

        try {
            // Top 5 produk makanan (kategori_id = 1) terlaris bulan ini/terpilih
            $topFoodProducts = DB::table('transaction_items as ti')
                ->join('transactions as t', 'ti.transaction_id', '=', 't.id')
                ->select(
                    'ti.nama_produk',
                    DB::raw('SUM(ti.kuantitas) AS total_terjual')
                )
                ->where('ti.kategori_id', 1)
                ->whereMonth('t.waktu_transaksi', $currentMonth)
                ->whereYear('t.waktu_transaksi', $currentYear)
                ->groupBy('ti.nama_produk')
                ->orderBy('total_terjual', 'DESC')
                ->limit(5)
                ->get();

            // Top 5 produk minuman (kategori_id = 2) terlaris bulan ini/terpilih
            $topDrinkProducts = DB::table('transaction_items as ti')
                ->join('transactions as t', 'ti.transaction_id', '=', 't.id')
                ->select(
                    'ti.nama_produk',
                    DB::raw('SUM(ti.kuantitas) AS total_terjual')
                )
                ->where('ti.kategori_id', 2)
                ->whereMonth('t.waktu_transaksi', $currentMonth)
                ->whereYear('t.waktu_transaksi', $currentYear)
                ->groupBy('ti.nama_produk')
                ->orderBy('total_terjual', 'DESC')
                ->limit(5)
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'top_food_products' => $topFoodProducts,
                    'top_drink_products' => $topDrinkProducts,
                    'bulan' => (int) $currentMonth,
                    'tahun' => (int) $currentYear,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function monthlySummary(Request $request)
    {
        // Accept selected_month/selected_year (from UI) or fallback to current month/year
        $currentMonth = $request->query('selected_month') ?? $request->query('month') ?? date('m');
        $currentYear = $request->query('selected_year') ?? $request->query('year') ?? date('Y');

        try {
            // Total transaksi bulan ini
            $totalTransactions = DB::table('transactions')
                ->whereMonth('waktu_transaksi', $currentMonth)
                ->whereYear('waktu_transaksi', $currentYear)
                ->count();

            // Total pendapatan bulan ini
            $totalRevenue = DB::table('transactions')
                ->whereMonth('waktu_transaksi', $currentMonth)
                ->whereYear('waktu_transaksi', $currentYear)
                ->sum('grand_total');

            // Total item terjual bulan ini
            $totalItemsSold = DB::table('transaction_items')
                ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
                ->whereMonth('transactions.waktu_transaksi', $currentMonth)
                ->whereYear('transactions.waktu_transaksi', $currentYear)
                ->sum('transaction_items.kuantitas');

            return response()->json([
                'success' => true,
                'data' => [
                    'total_transactions' => $totalTransactions,
                    'total_revenue' => $totalRevenue,
                    'total_items_sold' => $totalItemsSold,
                    'bulan' => (int) $currentMonth,
                    'tahun' => (int) $currentYear,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
