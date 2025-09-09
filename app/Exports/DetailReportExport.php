<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DetailReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithStyles, WithEvents
{
    public function __construct(private ?string $period = null, private ?string $startDate = null, private ?string $endDate = null) {}

    private array $transactionRowRanges = [];
    public function collection(): Collection
    {
        $query = Transaction::with('items');
        if ($this->period === 'month') {
            $query->whereMonth('waktu_transaksi', now()->month)->whereYear('waktu_transaksi', now()->year);
        } elseif ($this->period === 'week') {
            $query->whereBetween('waktu_transaksi', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->period === 'day') {
            $query->whereDate('waktu_transaksi', now()->toDateString());
        } elseif ($this->period === 'range' && $this->startDate && $this->endDate) {
            $query->whereBetween('waktu_transaksi', [
                date('Y-m-d 00:00:00', strtotime($this->startDate)),
                date('Y-m-d 23:59:59', strtotime($this->endDate)),
            ]);
        }
        $transactions = $query->orderBy('waktu_transaksi', 'asc')->get();
        $data = new Collection();

        $currentRow = 2; // header is row 1
        foreach ($transactions as $transaction) {
            $startRow = $currentRow;
            foreach ($transaction->items as $item) {
                $data->push([
                    'nomor_transaksi' => $transaction->nomor_transaksi,
                    'waktu_transaksi' => $transaction->waktu_transaksi,
                    'nama_produk' => $item->nama_produk,
                    'kuantitas' => $item->kuantitas,
                    'harga_satuan' => $item->harga_satuan,
                    'subtotal_item' => $item->kuantitas * $item->harga_satuan,
                    'metode_pembayaran' => $transaction->metode_pembayaran,
                    'meja' => $transaction->lokasi_meja . ' - ' . $transaction->nomor_meja,
                ]);
                $currentRow++;
            }
            $endRow = $currentRow - 1;
            if ($endRow >= $startRow) {
                $this->transactionRowRanges[] = [$startRow, $endRow];
            }
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Nomor Transaksi',
            'Waktu Transaksi',
            'Nama Produk',
            'Kuantitas',
            'Harga Satuan',
            'Subtotal Item',
            'Metode Pembayaran',
            'Meja',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_DATE_DATETIME,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => '#,##0',
            'F' => '#,##0',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFE2E8F0');
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:H'.$highestRow)->getBorders()->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->getColor()->setARGB('FFCBD5E1');
        $sheet->freezePane('A2');
        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $colors = ['b9bbbe', '949598'];
                foreach ($this->transactionRowRanges as $index => $range) {
                    [$start, $end] = $range;
                    $sheet->getStyle("A{$start}:H{$end}")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($colors[$index % 2]);
                }
            }
        ];
    }
}
