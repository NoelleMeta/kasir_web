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

        return view('dashboard', compact(
            'totalTransaksi',
            'totalPendapatan',
            'totalItemTerjual',
            'produkTerlaris'
        ));
    }
    public function ringkas()
    {
        $reportData = TransactionItem::query()
            ->select('nama_produk',
                DB::raw('SUM(kuantitas) as total_kuantitas'),
                DB::raw('SUM(kuantitas * harga_satuan) as total_pendapatan')
            )
            ->groupBy('nama_produk')
            ->orderBy('total_pendapatan', 'desc')
            ->get();

        $grandTotal = $reportData->sum('total_pendapatan');

        return view('laporan.ringkas', compact('reportData', 'grandTotal'));
    }

    public function detail(Request $request)
    {
        $period = $request->query('period'); // month|week|day|range|null
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Transaction::with('items');

        if ($period === 'month') {
            $query->whereMonth('waktu_transaksi', now()->month)
                  ->whereYear('waktu_transaksi', now()->year);
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

        $transactions = $query->orderBy('waktu_transaksi', 'desc')
            ->paginate(20)
            ->appends($request->query());

        if ($request->ajax() || $request->boolean('only_list')) {
            return view('laporan.partials._transactions_list', compact('transactions'));
        }

        return view('laporan.detail', compact('transactions', 'period', 'startDate', 'endDate'));
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

        $query = TransactionItem::query()
            ->select('nama_produk', DB::raw('SUM(kuantitas) as total_kuantitas'), DB::raw('SUM(kuantitas * harga_satuan) as total_pendapatan'))
            ->groupBy('nama_produk');

        if ($period === 'month') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        } elseif ($period === 'week') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'day') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($period === 'range' && $startDate && $endDate) {
            $query->whereBetween('created_at', [
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
