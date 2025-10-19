<div class="alert alert-info">
    <div><strong>Periode:</strong> {{ $summary['dateLabel'] ?? '-' }}</div>
    <div><strong>Jumlah Transaksi:</strong> {{ number_format($summary['totalTransactions']) }}</div>
    <div><strong>Total Pendapatan:</strong> Rp {{ number_format($summary['totalRevenue'], 0, ',', '.') }}</div>
</div>


