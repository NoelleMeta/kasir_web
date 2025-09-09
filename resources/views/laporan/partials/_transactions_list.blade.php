@foreach($transactions as $trx)
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between">
        <strong>{{ $trx->nomor_transaksi }}</strong>
        <span>{{ \Carbon\Carbon::parse($trx->waktu_transaksi)->format('d M Y, H:i') }}</span>
    </div>
    <div class="card-body">
        <p>Meja: {{ $trx->lokasi_meja }} - {{ $trx->nomor_meja }} | Pembayaran: {{ $trx->metode_pembayaran }}</p>
        <ul class="list-group">
            @foreach($trx->items as $item)
            <li class="list-group-item d-flex justify-content-between">
                <span>{{ $item->kuantitas }}x {{ $item->nama_produk }}</span>
                <span>Rp {{ number_format($item->kuantitas * $item->harga_satuan, 0, ',', '.') }}</span>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer text-end">
        <div>Subtotal: Rp {{ number_format($trx->subtotal, 0, ',', '.') }}</div>
        <div>PPN(10%): Rp {{ number_format($trx->ppn_jumlah, 0, ',', '.') }}</div>
        <strong>Total: Rp {{ number_format($trx->grand_total, 0, ',', '.') }}</strong>
    </div>
    </div>
@endforeach

@if (isset($transactions) && $transactions instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-3">{{ $transactions->links() }}</div>
@endif


