<?php


namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PembayaranExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    protected $ids;

    public function __construct(array $ids = null)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        if ($this->ids) {
            return Pembayaran::whereIn('id_pembayaran', $this->ids)->get();
        }

        return Pembayaran::all();
    }

    public function styles(Worksheet $sheet)
    {
        // Seluruh isi (kecuali header baris 1) diratakan ke tengah
        $highestRow = $sheet->getHighestRow();

        return [
            // Header (baris 1) ditebalkan dan diratakan tengah
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
            // Semua baris lainnya juga rata tengah
            'A2:M' . $highestRow => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT, // Kolom C = NIS
        ];
    }


    public function map($pembayaran): array
    {
        static $no = 1;

        return [
            $no++,
            $pembayaran->siswa->nama ?? '-',
            "\t" . (string)$pembayaran->nis,
            $pembayaran->kelas,
            $pembayaran->nama_pembayaran,
            $pembayaran->kode ?? '-',
            $pembayaran->jenis,
            $pembayaran->bulan ?? '-',
            'Rp' . number_format($pembayaran->jumlah_tagihan, 0, ',', '.'),
            'Rp' . number_format($pembayaran->dibayar, 0, ',', '.'),
            'Rp' . number_format($pembayaran->piutang, 0, ',', '.'),
            $pembayaran->status,
            $pembayaran->user->name ?? '-',
        ];
    }


    public function headings(): array
    {
        return [
            'No',
            'Nama Siswa',
            'NIS',
            'Kelas',
            'Nama Pembayaran',
            'Kode',
            'Jenis',
            'Bulan',
            'Jumlah',
            'dibayar',
            'piutang',
            'Status',
            'Oleh',
        ];
    }
}

