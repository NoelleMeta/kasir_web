<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Ringkas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; font-weight: bold; }
        .total { font-weight: bold; background-color: #f9f9f9; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penjualan Ringkas</h1>
        <p>Periode:
            @if($period === 'day')
                Hari ini ({{ now()->format('d M Y') }})
            @elseif($period === 'week')
                Minggu ini ({{ now()->startOfWeek()->format('d M Y') }} - {{ now()->endOfWeek()->format('d M Y') }})
            @elseif($period === 'month')
                Bulan ini ({{ now()->format('F Y') }})
            @elseif($period === 'range' && $startDate && $endDate)
                {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
            @else
                Semua Waktu
            @endif
        </p>
        <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th class="text-center">Jumlah Terjual</th>
                <th class="text-right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reportData as $item)
            <tr>
                <td>{{ $item->nama_produk }}</td>
                <td class="text-center">{{ number_format($item->total_kuantitas) }}</td>
                <td class="text-right">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="2" class="text-right"><strong>GRAND TOTAL</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
