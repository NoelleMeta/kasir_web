
@forelse($transactions as $trx)
<div class="card mb-2">
    <button class="card-header d-flex justify-content-between align-items-center trx-toggle" data-target="trx-{{ $trx->id }}" style="background:#f8fafc; cursor:pointer; border:0; text-align:left; width: 100%;">
        <div>
            <strong>{{ $trx->nomor_transaksi }}</strong>
            <span class="text-muted" style="margin-left:8px; font-weight:400;">{{ \Carbon\Carbon::parse($trx->waktu_transaksi)->format('d M Y, H:i') }}</span>
        </div>
        <div>
            <span class="badge bg-secondary">Total: Rp {{ number_format($trx->grand_total, 0, ',', '.') }}</span>
            <span class="caret" aria-hidden="true" style="margin-left: 8px;">▾</span>
        </div>
    </button>
    <div id="trx-{{ $trx->id }}" class="collapse-body" style="display:none;">
        <div class="card-body">
            <p class="mb-2"><strong>Meja:</strong> {{ $trx->lokasi_meja }} - {{ $trx->nomor_meja }} | <strong>Pembayaran:</strong> {{ $trx->metode_pembayaran }}</p>
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
</div>
@empty
<div class="card">
    <div class="card-body text-center text-muted">
        Tidak ada data transaksi pada periode ini.
    </div>
</div>
@endforelse

{{-- Pagination standar Laravel yang akan bekerja dengan AJAX --}}
@if (isset($transactions) && $transactions->hasPages())
<div class="mt-4 d-flex justify-content-center">
    {{ $transactions->links() }}
</div>
@endif
