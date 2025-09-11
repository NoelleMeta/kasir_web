<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Ringkas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print { display:none; } }
        .table thead th { background:#f1f5f9; }
        .table tfoot th { background:#f8fafc; }
        @media (max-width: 768px) {
            h1 { font-size: 1.5rem; }
            .btn { padding: .35rem .55rem; font-size: .9rem; }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Laporan Penjualan Ringkas</h1>

        <div class="d-flex justify-content-end mb-3 no-print">
            <a href="{{ route('laporan.ringkas.excel') }}" class="btn btn-success me-2">Export ke Excel</a>
            <a href="{{ route('laporan.ringkas.pdf') }}" class="btn btn-danger">Export ke PDF</a>
        </div>

        <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>
                        <a class="text-decoration-none text-dark" href="{{ route('laporan.ringkas', ['sort' => 'nama_produk', 'direction' => (isset($sort) && $sort==='nama_produk' && ($direction ?? 'desc')==='asc') ? 'desc' : 'asc']) }}">
                            Nama Menu
                            @if(($sort ?? '') === 'nama_produk')
                                {!! ($direction ?? 'desc') === 'asc' ? '&#9650;' : '&#9660;' !!}
                            @endif
                        </a>
                    </th>
                    <th>
                        <a class="text-decoration-none text-dark" href="{{ route('laporan.ringkas', ['sort' => 'total_kuantitas', 'direction' => (isset($sort) && $sort==='total_kuantitas' && ($direction ?? 'desc')==='desc') ? 'asc' : 'desc']) }}">
                            Jumlah Terjual
                            @if(($sort ?? '') === 'total_kuantitas')
                                {!! ($direction ?? 'desc') === 'desc' ? '&#9660;' : '&#9650;' !!}
                            @endif
                        </a>
                    </th>
                    <th>
                        <a class="text-decoration-none text-dark" href="{{ route('laporan.ringkas', ['sort' => 'total_pendapatan', 'direction' => (isset($sort) && $sort==='total_pendapatan' && ($direction ?? 'desc')==='desc') ? 'asc' : 'desc']) }}">
                            Total Pendapatan
                            @if(($sort ?? '') === 'total_pendapatan')
                                {!! ($direction ?? 'desc') === 'desc' ? '&#9660;' : '&#9650;' !!}
                            @endif
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($reportData as $item)
                <tr>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->total_kuantitas }}</td>
                    <td>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-end">GRAND TOTAL</th>
                    <th>Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</body>
</html>
