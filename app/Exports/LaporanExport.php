<?php

namespace App\Exports;

use App\Models\Laporan;
use App\Models\Operator;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = Laporan::with(['pro','operatorA','operatorB']);

        if($this->bulan && $this->tahun){
            $query->whereMonth('tanggal', $this->bulan)
                  ->whereYear('tanggal', $this->tahun);
        }

        return $query->orderBy('tanggal', 'desc')->get();
    }

    public function map($laporan): array
    {
        $periodeText = $this->bulan && $this->tahun 
            ? date('F', mktime(0,0,0,$this->bulan,1)) . " - " . $this->tahun
            : 'Semua Periode';

        return [
            $laporan->tanggal,
            $laporan->pro->nama_pro ?? $laporan->id_pro,
            $laporan->acara,
            $laporan->topik,
            $laporan->narasumber,
            $laporan->media,
            $laporan->operatorA->nama_operator ?? '-',
            $laporan->operatorB->nama_operator ?? '-',
            $laporan->link_youtube,
            $periodeText
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'PRO',
            'Acara',
            'Topik',
            'Narasumber',
            'Media',
            'Operator A',
            'Operator B',
            'Link YouTube',
            'Keterangan Periode'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestColumn = $sheet->getHighestColumn();
                
                // Header utama
                $sheet->getStyle('A1:'.$highestColumn.'1')->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                               'startColor' => ['argb' => 'FF4682B4']]
                ]);

                // Auto width
                foreach(range('A', $highestColumn) as $col){
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Operator Rekap di sheet bawah
                $startRow = $this->collection()->count() + 3;
                $sheet->setCellValue('A'.$startRow, 'Rekap Operator');
                $sheet->getStyle('A'.$startRow)->applyFromArray([
                    'font' => ['bold' => true, 'size' => 11, 'color' => ['argb' => 'FFFFFFFF']], // teks putih
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => '1D3557'] // biru, bisa ganti sesuai selera
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT]
                ]);

                $operators = Operator::all()->map(function($op){
                    $totalA = $op->laporanA()->when($this->bulan, function($q){ $q->whereMonth('tanggal', $this->bulan)->whereYear('tanggal', $this->tahun); })->count();
                    $totalB = $op->laporanB()->when($this->bulan, function($q){ $q->whereMonth('tanggal', $this->bulan)->whereYear('tanggal', $this->tahun); })->count();
                    $total = $totalA + $totalB;

                    if($total > 0 && $op->nama_operator !== '-'){  // tambahkan pengecekan disini
                        return [
                            'Nama Operator' => $op->nama_operator,
                            'Total Laporan' => $total
                        ];
                    }
                })->filter()->values();


                // Tambahkan header kolom operator
                $sheet->fromArray([['Nama Operator','Total Laporan']], NULL, 'A'.($startRow+1));
                $sheet->getStyle('A'.($startRow+1).':B'.($startRow+1))->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                               'startColor' => ['argb' => 'FF4682B4']],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
                ]);

                // Tambahkan data operator
                $sheet->fromArray($operators->toArray(), NULL, 'A'.($startRow+2));

                // Hias baris operator (alternating row color)
                $operatorRows = $operators->count();
                for($i = 0; $i < $operatorRows; $i++){
                    $rowNum = $startRow + 2 + $i;
                    $fillColor = $i % 2 == 0 ? 'FFDCE6F1' : 'FFFFFFFF';
                    $sheet->getStyle('A'.$rowNum.':B'.$rowNum)->applyFromArray([
                        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                   'startColor' => ['argb' => $fillColor]]
                    ]);
                }

                // Center alignment for total column
                $sheet->getStyle('B'.($startRow+2).':B'.($startRow+1+$operatorRows))
                      ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
}
