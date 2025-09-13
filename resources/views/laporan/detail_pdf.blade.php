<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0; color: #666; }
        .summary { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .summary h3 { margin: 0 0 10px 0; font-size: 16px; }
        .summary-item { display: inline-block; margin-right: 20px; }
        .transaction {
            margin-bottom: 30px;
            page-break-inside: avoid;
            border: 2px solid #2d4055;
            border-radius: 8px;
            padding: 15px;
            background: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .transaction-header {
            background: #a0a0a0;
            color: rgb(0, 0, 0);
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .transaction-header div { margin: 2px 0; }
        .transaction-items { margin-left: 0; }
        .item-row {
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 5px;
        }
        .item-row:last-child { border-bottom: none; }
        .transaction-total {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            border: 1px solid #dee2e6;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-weight-bold { font-weight: bold; }
        .transaction-number { font-size: 14px; font-weight: bold; }
        .transaction-details { font-size: 11px; opacity: 0.9; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Detail Transaksi</h1>
        <p>Periode:
            @if($period === 'day')
                Hari ini ({{ now()->format('d/m/Y') }})
            @elseif($period === 'week')
                Minggu ini ({{ now()->startOfWeek()->format('d/m/Y') }} - {{ now()->endOfWeek()->format('d/m/Y') }})
            @elseif($period === 'month')
                Bulan ini ({{ now()->format('F Y') }})
            @elseif($period === 'range' && $startDate && $endDate)
                {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
            @else
                Semua Waktu
            @endif
        </p>
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <h3>Ringkasan</h3>
        <div class="summary-item">
            <strong>Total Transaksi:</strong> {{ $summary['totalTransactions'] }}
        </div>
        <div class="summary-item">
            <strong>Total Pendapatan:</strong> Rp {{ number_format($summary['totalRevenue'], 0, ',', '.') }}
        </div>
        <div class="summary-item">
            <strong>Periode:</strong> {{ $summary['dateLabel'] }}
        </div>
    </div>

    @forelse($transactions as $transaction)
    <div class="transaction">
        <div class="transaction-header">
            <div class="transaction-number">{{ $transaction->nomor_transaksi }}</div>
            <div class="transaction-details">{{ \Carbon\Carbon::parse($transaction->waktu_transaksi)->format('d/m/Y H:i:s') }}</div>
            <div class="transaction-details">Meja: {{ $transaction->lokasi_meja }} - {{ $transaction->nomor_meja }}</div>
            <div class="transaction-details">Metode: {{ $transaction->metode_pembayaran }}</div>
        </div>

        <div class="transaction-items">
            @foreach($transaction->items as $item)
            <div class="item-row">
                <div style="display: flex; justify-content: space-between;">
                    <span>{{ $item->nama_produk }} ({{ $item->kuantitas }}x)</span>
                    <span class="text-right">Rp {{ number_format($item->harga_satuan * $item->kuantitas, 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach

            <div class="transaction-total">
                <div class="item-row font-weight-bold">
                    <div style="display: flex; justify-content: space-between;">
                        <span>Subtotal:</span>
                        <span class="text-right">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="item-row font-weight-bold">
                    <div style="display: flex; justify-content: space-between;">
                        <span>PPN:</span>
                        <span class="text-right">Rp {{ number_format($transaction->ppn_jumlah, 0, ',', '.') }}</span>
                    </div>
                </div>
                <div class="item-row font-weight-bold" style="border-top: 2px solid #3a4755; margin-top: 8px; padding-top: 8px;">
                    <div style="display: flex; justify-content: space-between;">
                        <span><strong>TOTAL:</strong></span>
                        <span class="text-right font-weight-bold">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center">
        <p>Tidak ada data transaksi</p>
    </div>
    @endforelse
</body>
</html>
