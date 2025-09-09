<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; margin: 0; background: #f8fafc; color: #0f172a; }
        .container { max-width: 1000px; margin: 24px auto; padding: 0 16px; }
        .header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
        .title { font-size: 22px; font-weight: 700; }
        .cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .card { background: white; border-radius: 12px; padding: 16px; box-shadow: 0 1px 2px rgba(0,0,0,0.06); }
        .card h3 { margin: 0 0 8px 0; font-size: 13px; color: #475569; font-weight: 600; }
        .metric { font-size: 22px; font-weight: 700; }
        .section { margin-top: 24px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 2px rgba(0,0,0,0.06); }
        th, td { padding: 12px 14px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 14px; }
        th { background: #f1f5f9; color: #334155; font-weight: 600; }
        tr:last-child td { border-bottom: none; }
        .links { margin-top: 16px; display: flex; gap: 12px; }
        .btn { display: inline-block; padding: 10px 14px; background: #0ea5e9; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 14px; }
        .btn.secondary { background: #64748b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="title">Dashboard Penjualan</div>
        </div>

        <div class="cards">
            <div class="card">
                <h3>Total Transaksi</h3>
                <div class="metric">{{ number_format($totalTransaksi) }}</div>
            </div>
            <div class="card">
                <h3>Total Pendapatan</h3>
                <div class="metric">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <div class="card">
                <h3>Total Item Terjual</h3>
                <div class="metric">{{ number_format($totalItemTerjual) }}</div>
            </div>
        </div>

        <div class="section">
            <h3 style="margin: 12px 0; color:#334155">Top 5 Produk Terlaris</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kuantitas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produkTerlaris as $row)
                        <tr>
                            <td>{{ $row->nama_produk }}</td>
                            <td>{{ number_format($row->total_kuantitas) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="text-align:center; color:#64748b">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="links">
                <a class="btn" href="{{ route('laporan.ringkas') }}">Lihat Laporan Ringkas</a>
                <a class="btn secondary" href="{{ route('laporan.detail') }}">Lihat Laporan Detail</a>
            </div>
        </div>
    </div>
</body>
</html>


