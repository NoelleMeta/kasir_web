<?php

namespace App\Exports;

use App\Models\TransactionItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RingkasReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithStyles
{
    public function __construct(private ?string $period = null, private ?string $startDate = null, private ?string $endDate = null) {}
    public function collection(): Collection
    {
        $query = TransactionItem::query()
            ->select('nama_produk', DB::raw('SUM(kuantitas) as total_kuantitas'), DB::raw('SUM(kuantitas * harga_satuan) as total_pendapatan'))
            ->groupBy('nama_produk');

        if ($this->period === 'month') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        } elseif ($this->period === 'week') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($this->period === 'day') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($this->period === 'range' && $this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($this->startDate)),
                date('Y-m-d 23:59:59', strtotime($this->endDate)),
            ]);
        }

        $rows = $query->orderBy('total_pendapatan', 'desc')->get();

        $data = new Collection();
        foreach ($rows as $row) {
            $data->push([
                'nama_produk' => $row->nama_produk,
                'total_kuantitas' => $row->total_kuantitas,
                'total_pendapatan' => $row->total_pendapatan,
            ]);
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Total Kuantitas',
            'Total Pendapatan',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => '#,##0',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header bold + background
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
        $sheet->getStyle('A1:C1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFE2E8F0');
        // Borders
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:C'.$highestRow)->getBorders()->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->getColor()->setARGB('FFCBD5E1');
        // Freeze header
        $sheet->freezePane('A2');
        return [];
    }
}
