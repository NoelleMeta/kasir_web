<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RingkasReportExport;
use App\Exports\DetailReportExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    // =================================================================================
    // DASHBOARD METHODS
    // =================================================================================

    /**
     * Menampilkan halaman utama dashboard dengan statistik.
     */
    public function dashboard(Request $request)
    {
        return view('index', $this->getDashboardStats($request));
    }

    /**
     * Menyediakan data statistik dashboard dalam format JSON untuk API.
     */
    public function dashboardData(Request $request)
    {
        return response()->json($this->getDashboardStats($request));
    }

    // =================================================================================
    // REPORT METHODS (Tidak ada perubahan di sini, tetap sama)
    // =================================================================================
    public function ringkas(Request $request)
    {
        $allowedSorts = ['nama_produk', 'kategori', 'total_kuantitas', 'total_pendapatan'];
        $sort = in_array($request->query('sort'), $allowedSorts, true) ? $request->query('sort') : 'total_pendapatan';
        $direction = strtolower($request->query('direction')) === 'asc' ? 'asc' : 'desc';

        $query = Transaction::query()
            ->join('transaction_items as ti', 'ti.transaction_id', '=', 'transactions.id')
            ->select(
                'ti.nama_produk',
                'ti.kategori_id',
                DB::raw('SUM(ti.kuantitas) as total_kuantitas'),
                DB::raw('SUM(ti.kuantitas * ti.harga_satuan) as total_pendapatan')
            );

        $this->applyDateFilters($query, $request);

        $reportData = $query->groupBy('ti.nama_produk', 'ti.kategori_id')
            ->get();

        // Debug: Log the raw data
        Log::info('Raw report data:', $reportData->toArray());

        // Map kategori_id to kategori name
        $reportData = $reportData->map(function ($item) {
            $kategoriMap = [
                1 => 'Makanan',
                2 => 'Minuman',
                3 => 'Extra',
                '1' => 'Makanan',  // Handle string type
                '2' => 'Minuman',  // Handle string type
                '3' => 'Extra'     // Handle string type
            ];

            // Debug: Log the kategori_id value
            Log::info('Processing item:', [
                'nama_produk' => $item->nama_produk,
                'kategori_id' => $item->kategori_id,
                'kategori_id_type' => gettype($item->kategori_id),
                'kategori_id_raw' => var_export($item->kategori_id, true)
            ]);

            $item->kategori = $kategoriMap[$item->kategori_id] ?? 'Tidak Diketahui (ID: ' . $item->kategori_id . ')';
            return $item;
        });

        // Sort after mapping kategori
        if ($sort === 'kategori') {
            $reportData = $reportData->sortBy('kategori', SORT_REGULAR, $direction === 'desc');
        } else {
            $reportData = $reportData->sortBy($sort, SORT_REGULAR, $direction === 'desc');
        }

        $grandTotal = $reportData->sum('total_pendapatan');

        return view('laporan.ringkas', compact('reportData', 'grandTotal', 'sort', 'direction') + $request->only(['period', 'start_date', 'end_date']));
    }

    public function detail(Request $request)
    {
        $query = Transaction::with('items');
        $statsQuery = Transaction::query();

        $this->applyDateFilters($query, $request);
        $this->applyDateFilters($statsQuery, $request);

        $transactions = $query->orderBy('waktu_transaksi', 'desc')
            ->paginate(20)
            ->appends($request->query());

        $summary = [
            'dateLabel' => $this->getDateLabel($request, (clone $statsQuery)),
            'totalTransactions' => (clone $statsQuery)->count(),
            'totalRevenue' => (clone $statsQuery)->sum('grand_total'),
            'period' => $request->query('period'),
        ];

        if ($request->ajax()) {
            if ($request->boolean('only_list')) {
                return view('laporan.partials._transactions_list', compact('transactions'));
            }
            if ($request->boolean('only_summary')) {
                return view('laporan.partials._transactions_summary', compact('summary'));
            }
        }

        return view('laporan.detail', compact('transactions', 'summary') + $request->only(['period', 'start_date', 'end_date']));
    }

    private function getDashboardStats(Request $request = null): array
    {
        // Determine which month and year to use
        $selectedMonth = $request ? $request->query('selected_month') : null;
        $selectedYear = $request ? $request->query('selected_year') : null;

        $month = $selectedMonth ? (int)$selectedMonth : now()->month;
        $year = $selectedYear ? (int)$selectedYear : now()->year;

        // Debug logging untuk memastikan periode yang dipilih
        Log::info('Dashboard Period Selection:', [
            'selected_month' => $selectedMonth,
            'selected_year' => $selectedYear,
            'final_month' => $month,
            'final_year' => $year,
            'period_label' => Carbon::create($year, $month, 1)->format('F Y')
        ]);

        $baseQuery = Transaction::whereMonth('waktu_transaksi', $month)
            ->whereYear('waktu_transaksi', $year);

        $itemQuery = TransactionItem::whereHas('transaction', function ($q) use ($month, $year) {
            $q->whereMonth('waktu_transaksi', $month)
              ->whereYear('waktu_transaksi', $year);
        });

        $drinkKeywords = ['es', 'jus', 'teh', 'kopi', 'susu', 'chocolate', 'latte', 'tea', 'cola', 'drink'];

        // Query untuk Makanan Terlaris (produk yang BUKAN minuman)
        $makananTerlarisQuery = (clone $itemQuery)
            ->select('nama_produk', DB::raw('SUM(kuantitas) as total_kuantitas'))
            ->where(function ($query) use ($drinkKeywords) {
                foreach ($drinkKeywords as $keyword) {
                    $query->where('nama_produk', 'NOT LIKE', '%' . $keyword . '%');
                }
            })
            ->groupBy('nama_produk')
            ->orderByDesc('total_kuantitas')
            ->limit(5);

        // Query untuk Minuman Terlaris (produk yang merupakan minuman)
        $minumanTerlarisQuery = (clone $itemQuery)
            ->select('nama_produk', DB::raw('SUM(kuantitas) as total_kuantitas'))
            ->where(function ($query) use ($drinkKeywords) {
                foreach ($drinkKeywords as $keyword) {
                    $query->orWhere('nama_produk', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->groupBy('nama_produk')
            ->orderByDesc('total_kuantitas')
            ->limit(5);

        // Get actual data untuk debugging
        $totalTransaksi = (clone $baseQuery)->count();
        $totalPendapatan = (clone $baseQuery)->sum('grand_total');
        $totalItemTerjual = (clone $itemQuery)->sum('kuantitas');
        $makananTerlaris = $makananTerlarisQuery->get();
        $minumanTerlaris = $minumanTerlarisQuery->get();

        // Cek apakah ada data transaksi untuk periode yang dipilih
        $hasData = $totalTransaksi > 0;

        // Debug logging untuk memverifikasi data yang dihasilkan
        Log::info('Dashboard Data Results:', [
            'period' => Carbon::create($year, $month, 1)->format('F Y'),
            'total_transaksi' => $totalTransaksi,
            'total_pendapatan' => $totalPendapatan,
            'total_item_terjual' => $totalItemTerjual,
            'makanan_terlaris_count' => $makananTerlaris->count(),
            'minuman_terlaris_count' => $minumanTerlaris->count(),
            'date_range' => [
                'start' => Carbon::create($year, $month, 1)->format('Y-m-d'),
                'end' => Carbon::create($year, $month, 1)->endOfMonth()->format('Y-m-d')
            ],
            'query_verification' => [
                'month_filter' => $month,
                'year_filter' => $year,
                'actual_date_range' => [
                    'from' => Carbon::create($year, $month, 1)->startOfDay()->toDateTimeString(),
                    'to' => Carbon::create($year, $month, 1)->endOfMonth()->endOfDay()->toDateTimeString()
                ]
            ]
        ]);

        return [
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan,
            'totalItemTerjual' => $totalItemTerjual,
            'makananTerlaris' => $makananTerlaris,
            'minumanTerlaris' => $minumanTerlaris,
            // [NEW] Mengirim data periode untuk ditampilkan di view
            'periodeDashboard' => Carbon::create($year, $month, 1)->format('F Y'), // Hasil: "September 2025"
            'selectedMonth' => $month,
            'selectedYear' => $year,
            // [NEW] Status data untuk error handling
            'hasData' => $hasData,
            'errorMessage' => $hasData ? null : 'Tidak ada transaksi pada periode ' . Carbon::create($year, $month, 1)->format('F Y'),
        ];
    }

    /**
     * Method terpusat untuk menerapkan filter tanggal pada query.
     */
    private function applyDateFilters(Builder $query, Request $request): Builder
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Debug: Log parameter yang diterima
        Log::info('Filter parameters:', [
            'period' => $period,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'all_params' => $request->query()
        ]);

        return $query->when($period, function ($q, $period) use ($startDate, $endDate) {
            if ($period === 'month') {
                return $q->whereMonth('waktu_transaksi', now()->month)->whereYear('waktu_transaksi', now()->year);
            }
            if ($period === 'last_month') {
                return $q->whereMonth('waktu_transaksi', now()->subMonth()->month)->whereYear('waktu_transaksi', now()->subMonth()->year);
            }
            if ($period === 'week') {
                return $q->whereBetween('waktu_transaksi', [now()->startOfWeek(), now()->endOfWeek()]);
            }
            if ($period === 'day') {
                return $q->whereDate('waktu_transaksi', now()->toDateString());
            }
            if ($period === 'yesterday') {
                return $q->whereDate('waktu_transaksi', now()->subDay()->toDateString());
            }
            if ($period === 'range' && $startDate && $endDate) {
                $start = Carbon::parse($startDate)->startOfDay();
                $end = Carbon::parse($endDate)->endOfDay();
                return $q->whereBetween('waktu_transaksi', [$start, $end]);
            }
            return $q;
        });
    }

    /**
     * Membuat label tanggal untuk tampilan laporan detail.
     */
    private function getDateLabel(Request $request, Builder $statsQuery): ?string
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        switch ($period) {
            case 'day': return now()->format('d/m/Y');
            case 'yesterday': return now()->subDay()->format('d/m/Y');
            case 'week': return now()->startOfWeek()->format('d/m/Y') . ' - ' . now()->endOfWeek()->format('d/m/Y');
            case 'month': return now()->startOfMonth()->format('d/m/Y') . ' - ' . now()->endOfMonth()->format('d/m/Y');
            case 'last_month': return now()->subMonth()->startOfMonth()->format('d/m/Y') . ' - ' . now()->subMonth()->endOfMonth()->format('d/m/Y');
            case 'range':
                if ($startDate && $endDate) {
                    return Carbon::parse($startDate)->format('d/m/Y') . ' - ' . Carbon::parse($endDate)->format('d/m/Y');
                }
                return null;
            default:
                $minDate = $statsQuery->min('waktu_transaksi');
                $maxDate = $statsQuery->max('waktu_transaksi');
                return ($minDate && $maxDate)
                    ? Carbon::parse($minDate)->format('d/m/Y') . ' - ' . Carbon::parse($maxDate)->format('d/m/Y')
                    : 'Semua Waktu';
        }
    }

    // =================================================================================
    // EXPORT METHODS
    // =================================================================================

    public function exportRingkasExcel(Request $request)
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $filename = 'laporan_ringkas_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new RingkasReportExport($period, $startDate, $endDate), $filename);
    }

    public function exportRingkasPdf(Request $request)
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Ambil data yang sama dengan view
        $allowedSorts = ['nama_produk', 'total_kuantitas', 'total_pendapatan'];
        $sort = in_array($request->query('sort'), $allowedSorts, true) ? $request->query('sort') : 'total_pendapatan';
        $direction = strtolower($request->query('direction')) === 'asc' ? 'asc' : 'desc';

        $query = Transaction::query()
            ->join('transaction_items as ti', 'ti.transaction_id', '=', 'transactions.id')
            ->select(
                'ti.nama_produk',
                DB::raw('SUM(ti.kuantitas) as total_kuantitas'),
                DB::raw('SUM(ti.kuantitas * ti.harga_satuan) as total_pendapatan')
            );

        $this->applyDateFilters($query, $request);

        $reportData = $query->groupBy('ti.nama_produk')
            ->orderBy($sort, $direction)
            ->get();

        $grandTotal = $reportData->sum('total_pendapatan');

        $filename = 'laporan_ringkas_' . now()->format('Y-m-d_H-i-s') . '.pdf';

        $pdf = Pdf::loadView('laporan.ringkas_pdf', compact('reportData', 'grandTotal', 'period', 'startDate', 'endDate'));
        return $pdf->download($filename);
    }

    public function exportDetailExcel(Request $request)
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $filename = 'laporan_detail_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new DetailReportExport($period, $startDate, $endDate), $filename);
    }

    public function exportDetailPdf(Request $request)
    {
        $period = $request->query('period');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        // Ambil data yang sama dengan view
        $query = Transaction::with('items');
        $statsQuery = Transaction::query();

        $this->applyDateFilters($query, $request);
        $this->applyDateFilters($statsQuery, $request);

        $transactions = $query->orderBy('waktu_transaksi', 'desc')->get();

        $summary = [
            'dateLabel' => $this->getDateLabel($request, (clone $statsQuery)),
            'totalTransactions' => (clone $statsQuery)->count(),
            'totalRevenue' => (clone $statsQuery)->sum('grand_total'),
            'period' => $request->query('period'),
        ];

        $filename = 'laporan_detail_' . now()->format('Y-m-d_H-i-s') . '.pdf';

        $pdf = Pdf::loadView('laporan.detail_pdf', compact('transactions', 'summary', 'period', 'startDate', 'endDate'));
        return $pdf->download($filename);
    }
}
