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
        @media (max-width: 900px) { .cards { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) {
            .container { padding: 0 12px; }
            .title { font-size: 18px; }
            .metric { font-size: 20px; }
            .cards { grid-template-columns: 1fr; }
            th, td { padding: 10px 12px; font-size: 13px; }
            .btn { padding: 8px 12px; font-size: 13px; }
        }
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
                <div class="metric" id="m-total-transaksi">{{ number_format($totalTransaksi) }}</div>
            </div>
            <div class="card">
                <h3>Total Pendapatan</h3>
                <div class="metric" id="m-total-pendapatan">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
            </div>
            <div class="card">
                <h3>Total Item Terjual</h3>
                <div class="metric" id="m-total-item">{{ number_format($totalItemTerjual) }}</div>
            </div>
        </div>

        <div class="section">
            <h3 style="margin: 12px 0; color:#334155">Top 5 Produk Terlaris</h3>
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kuantitas</th>
                    </tr>
                </thead>
                <tbody id="top-products-body">
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
            </div>
            <div class="links">
                <a class="btn" href="{{ route('laporan.ringkas') }}">Lihat Laporan Ringkas</a>
                <a class="btn secondary" href="{{ route('laporan.detail') }}">Lihat Laporan Detail</a>
            </div>
        </div>
    </div>
    <script>
        function formatNumber(idn) {
            return new Intl.NumberFormat('id-ID').format(idn);
        }
        function formatRupiah(num) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(num));
        }
        async function refreshDashboard() {
            try {
                const resp = await fetch('{{ route('dashboard.data') }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
                const data = await resp.json();
                document.getElementById('m-total-transaksi').textContent = formatNumber(data.totalTransaksi);
                document.getElementById('m-total-pendapatan').textContent = formatRupiah(data.totalPendapatan);
                document.getElementById('m-total-item').textContent = formatNumber(data.totalItemTerjual);

                const tbody = document.getElementById('top-products-body');
                if (Array.isArray(data.produkTerlaris) && data.produkTerlaris.length) {
                    tbody.innerHTML = data.produkTerlaris.map(function(row){
                        return '<tr><td>' + row.nama_produk + '</td><td>' + formatNumber(row.total_kuantitas) + '</td></tr>';
                    }).join('');
                } else {
                    tbody.innerHTML = '<tr><td colspan="2" style="text-align:center; color:#64748b">Belum ada data</td></tr>';
                }
            } catch (e) {
                // fail silently
            }
        }
        setInterval(refreshDashboard, 10000);
    </script>
</body>
</html>



