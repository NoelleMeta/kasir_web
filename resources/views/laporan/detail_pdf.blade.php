<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Detail Transaksi</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .card { border: 1px solid #ddd; border-radius: 8px; margin-bottom: 12px; }
        .card-header { padding: 8px 10px; background: #f1f5f9; font-weight: bold; display:flex; justify-content:space-between; }
        .card-body { padding: 8px 10px; }
        .card-footer { padding: 8px 10px; background: #f8fafc; }
        .muted { color: #64748b; }
        table { border-collapse: collapse; width: 100%; }
        .items-table td { padding: 4px 0; border-bottom: 1px solid #eee; }
        .items-table tr:last-child td { border-bottom: 0; }
        .items-table td.name { width: auto; }
        .items-table td.price { width: 140px; text-align: right; }
        .total-table { width: 100%; }
        .total-table td.label { text-align: right; }
        .total-table td.value { width: 160px; text-align: right; }
    </style>
    </head>
<body>
    <h2 style="margin-bottom:10px;">Laporan Detail Transaksi</h2>
    @foreach($transactions as $trx)
    <div class="card">
        <div class="card-header">
            <span>{{ $trx->nomor_transaksi }}</span>
            <span>{{ \Carbon\Carbon::parse($trx->waktu_transaksi)->format('d M Y, H:i') }}</span>
        </div>
        <div class="card-body">
            <div class="muted" style="margin-bottom:6px;">Meja: {{ $trx->lokasi_meja }} - {{ $trx->nomor_meja }} | Metode: {{ $trx->metode_pembayaran }}</div>
            <table class="items-table">
                @foreach($trx->items as $item)
                <tr>
                    <td class="name">{{ $item->kuantitas }}x {{ $item->nama_produk }}</td>
                    <td class="price">Rp {{ number_format($item->kuantitas * $item->harga_satuan, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            <table class="total-table">
                <tr>
                    <td class="label">Subtotal</td>
                    <td class="value">Rp {{ number_format($trx->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">PPN (10%)</td>
                    <td class="value">Rp {{ number_format($trx->ppn_jumlah, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label" style="font-weight:bold;">Total</td>
                    <td class="value" style="font-weight:bold;">Rp {{ number_format($trx->grand_total, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>
    @endforeach
    <div style="text-align:right; margin-top:12px; font-weight:bold;">Grand Total: Rp {{ number_format($grandTotal ?? 0, 0, ',', '.') }}</div>
    </body>
</html>


