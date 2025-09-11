<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RingkasReportExport;
use App\Exports\DetailReportExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function dashboard()
    {
        $totalTransaksi = Transaction::count();
        $totalPendapatan = Transaction::sum('grand_total');
        $totalItemTerjual = TransactionItem::sum('kuantitas');
        $produkTerlaris = TransactionItem::select('nama_produk', DB::raw('SUM(kuantitas) as total_kuantitas'))
            ->groupBy('nama_produk')
            ->orderByDesc('total_kuantitas')
            ->limit(5)
            ->get();

        return view('index', compact(
            'totalTransaksi',
            'totalPendapatan',
            'totalItemTerjual',
            'produkTerlaris'
        ));
    }
    public function dashboardData()
    {
        $totalTransaksi = Transaction::count();
        $totalPendapatan = Transaction::sum('grand_total');
        $totalItemTerjual = TransactionItem::sum('kuantitas');
        $produkTerlaris = TransactionItem::select('nama_produk', DB::raw('SUM(kuantitas) as total_kuantitas'))
            ->groupBy('nama_produk')
            ->orderByDesc('total_kuantitas')
            ->limit(5)
            ->get();

        return response()->json([
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan,
            'totalItemTerjual' => $totalItemTerjual,
            'produkTerlaris' => $produkTerlaris,
        ]);
    }
    public function ringkas(Request $request)
    {
        // Sorting params with defaults
        $allowedSorts = ['nama_produk', 'total_kuantitas', 'total_pendapatan'];
        $sort = in_array($request->query('sort'), $allowedSorts, true) ? $request->query('sort') : 'total_pendapatan';
        $direction = strtolower($request->query('direction')) === 'asc' ? 'asc' : 'desc';

        $query = Transaction::query()
            ->join('transaction_items as ti', 'ti.transaction_id', '=', 'transactions.id')
            ->select(
                'ti.nama_produk',
                DB::raw('SUM(ti.kuantitas) as total_kuantitas'),
                DB::raw('SUM(ti.kuantitas * ti.harga_satuan) as total_pendapatan')
            )
            ->groupBy('ti.nama_produk');

        // Use alias names for ordering
        $query->orderBy($sort, $direction);

        $reportData = $query->get();
        $grandTotal = $reportData->sum('total_pendapatan');

        return view('laporan.ringkas', compact('reportData', 'grandTotal', 'sort', 'direction'));
    }

    public function detail(Request $request)
    {
        $period = $request->query('period'); // month|week|day|range|null
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Transaction::with('items');
        $statsQuery = Transaction::query();

        if ($period === 'month') {
            $query->whereMonth('waktu_transaksi', now()->month)
                  ->whereYear('waktu_transaksi', now()->year);
            $statsQuery->whereMonth('waktu_transaksi', now()->month)
                  ->whereYear('waktu_transaksi', now()->year);
        } elseif ($period === 'week') {
            $query->whereBetween('waktu_transaksi', [now()->startOfWeek(), now()->endOfWeek()]);
            $statsQuery->whereBetween('waktu_transaksi', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'day') {
            $query->whereDate('waktu_transaksi', now()->toDateString());
            $statsQuery->whereDate('waktu_transaksi', now()->toDateString());
        } elseif ($period === 'range' && $startDate && $endDate) {
            $query->whereBetween('waktu_transaksi', [
                date('Y-m-d 00:00:00', strtotime($startDate)),
                date('Y-m-d 23:59:59', strtotime($endDate)),
            ]);
            $statsQuery->whereBetween('waktu_transaksi', [
                date('Y-m-d 00:00:00', strtotime($startDate)),
                date('Y-m-d 23:59:59', strtotime($endDate)),
            ]);
        }

        $transactions = $query->orderBy('waktu_transaksi', 'desc')
            ->paginate(20)
            ->appends($request->query());

        // Build summary
        $totalTransactions = (clone $statsQuery)->count();
        $totalRevenue = (clone $statsQuery)->sum('grand_total');
        $minDate = (clone $statsQuery)->min('waktu_transaksi');
        $maxDate = (clone $statsQuery)->max('waktu_transaksi');

        $dateLabel = null;
        if ($period === 'day') {
            $dateLabel = now()->format('d M Y');
        } elseif ($period === 'week') {
            $start = now()->startOfWeek();
            $end = now()->endOfWeek();
            $dateLabel = $start->format('d M Y') . ' - ' . $end->format('d M Y');
        } elseif ($period === 'month') {
            $start = now()->startOfMonth();
            $end = now();
            $dateLabel = $start->format('d M Y') . ' - ' . $end->format('d M Y');
        } elseif ($period === 'range' && $startDate && $endDate) {
            $dateLabel = date('d M Y', strtotime($startDate)) . ' - ' . date('d M Y', strtotime($endDate));
        } else {
            // Semua
            if ($minDate && $maxDate) {
                $dateLabel = date('d M Y', strtotime($minDate)) . ' - ' . date('d M Y', strtotime($maxDate));
            }
        }

        $summary = [
            'dateLabel' => $dateLabel,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'period' => $period,
        ];

        if ($request->ajax() && $request->boolean('only_list')) {
            return view('laporan.partials._transactions_list', compact('transactions'));
        }
        if ($request->ajax() && $request->boolean('only_summary')) {
            return view('laporan.partials._transactions_summary', compact('summary'));
        }

        return view('laporan.detail', compact('transactions', 'period', 'startDate', 'endDate', 'summary'));
    }

    public function exportRingkasExcel(Request $request)
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $suffix = now()->format('Ymd_His');
        return Excel::download(new RingkasReportExport($period, $startDate, $endDate), "laporan-ringkas_{$suffix}.xlsx");
    }

    public function exportDetailExcel(Request $request)
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $suffix = now()->format('Ymd_His');
        return Excel::download(new DetailReportExport($period, $startDate, $endDate), "laporan-detail_{$suffix}.xlsx");
    }

    public function exportRingkasPdf(Request $request)
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Transaction::query()
            ->join('transaction_items as ti', 'ti.transaction_id', '=', 'transactions.id')
            ->select('ti.nama_produk', DB::raw('SUM(ti.kuantitas) as total_kuantitas'), DB::raw('SUM(ti.kuantitas * ti.harga_satuan) as total_pendapatan'))
            ->groupBy('ti.nama_produk');

        if ($period === 'month') {
            $query->whereMonth('waktu_transaksi', now()->month)->whereYear('waktu_transaksi', now()->year);
        } elseif ($period === 'week') {
            $query->whereBetween('waktu_transaksi', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'day') {
            $query->whereDate('waktu_transaksi', now()->toDateString());
        } elseif ($period === 'range' && $startDate && $endDate) {
            $query->whereBetween('waktu_transaksi', [
                date('Y-m-d 00:00:00', strtotime($startDate)),
                date('Y-m-d 23:59:59', strtotime($endDate)),
            ]);
        }

        $reportData = $query->orderBy('total_pendapatan', 'desc')->get();
        $grandTotal = $reportData->sum('total_pendapatan');
        $pdf = Pdf::loadView('laporan.ringkas_pdf', compact('reportData', 'grandTotal'));
        $suffix = now()->format('Ymd_His');
        return $pdf->download("laporan-ringkas_{$suffix}.pdf");
    }

    public function exportDetailPdf(Request $request)
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Transaction::with('items');
        if ($period === 'month') {
            $query->whereMonth('waktu_transaksi', now()->month)->whereYear('waktu_transaksi', now()->year);
        } elseif ($period === 'week') {
            $query->whereBetween('waktu_transaksi', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'day') {
            $query->whereDate('waktu_transaksi', now()->toDateString());
        } elseif ($period === 'range' && $startDate && $endDate) {
            $query->whereBetween('waktu_transaksi', [
                date('Y-m-d 00:00:00', strtotime($startDate)),
                date('Y-m-d 23:59:59', strtotime($endDate)),
            ]);
        }

        $transactions = $query->orderBy('waktu_transaksi', 'asc')->get();
        $grandTotal = $transactions->sum('grand_total');
        $pdf = Pdf::loadView('laporan.detail_pdf', compact('transactions', 'grandTotal'));
        $suffix = now()->format('Ymd_His');
        return $pdf->download("laporan-detail_{$suffix}.pdf");
    }
}
