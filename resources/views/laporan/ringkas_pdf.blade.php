<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Ringkas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        thead th { background: #f1f5f9; }
        tfoot th { background: #f8fafc; }
    </style>
</head>
<body>
    <h2 style="margin-bottom:10px;">Laporan Penjualan Ringkas</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Menu</th>
                <th>Jumlah Terjual</th>
                <th>Total Pendapatan</th>
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
                <td colspan="3" style="text-align:center;">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align:right;">GRAND TOTAL</th>
                <th>Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>


