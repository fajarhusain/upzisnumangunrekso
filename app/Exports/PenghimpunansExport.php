<?php

namespace App\Exports;

use App\Models\Penghimpunan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PenghimpunansExport implements FromQuery, ShouldAutoSize, WithColumnFormatting, WithHeadings, WithMapping
{
    use Exportable;

    public function columnFormats(): array
    {
        return [
            // 'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public string $dateStart;

    public string $dateEnd;

    public string $month;

    public string $year;

    public string $sumDon;

    public string $proSum;

    public string $sumDa;

    public function __construct(string $dateStart, string $dateEnd, string $month, string $year, string $sumDon, string $proSum, string $sumDa)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->month = $month;
        $this->year = $year;
        $this->sumDon = $sumDon;
        $this->proSum = $proSum;
        $this->sumDa = $sumDa;

    }

    public function query()
    {
        // return Penghimpunan::query()->with('sumberDana', 'programSumber', 'tahun');

        return Penghimpunan::orderByDesc('updated_at')
            ->when($this->dateStart && $this->dateEnd, function ($query) {
                $query->whereBetween('tanggal', [
                    Carbon::parse($this->dateStart)->startOfDay(),
                    Carbon::parse($this->dateEnd)->endOfDay(),
                ]);
            })
            ->when($this->month, function ($query) {
                $query->whereMonth('tanggal', $this->month);
            })
            ->when($this->year, function ($query) {
                $query->where('tahun_id', $this->year);
            })
            ->when($this->sumDon, function ($query) {
                $query->whereHas('programSumber', function ($query) {
                    $query->where('sumber_donasi_id', $this->sumDon);
                });
            })
            ->when($this->proSum, function ($query) {
                $query->where('program_sumber_id', $this->proSum);
            })
            ->when($this->sumDa, function ($query) {
                $query->where('sumber_dana_id', $this->sumDa);
            });
    }

    public function headings(): array
    {
        return [
            'Id',
            'Tanggal',
            'Uraian',
            'Nominal',
            'Jumlah Lembaga',
            'Jumlah Pria',
            'Jumlah Wanita',
            'Jumlah No Name',
            'Sumber Donasi',
            'Program Sumber',
            'Sumber Dana',
            'Tahun',
        ];
    }

    public function map($penghimpunan): array
    {

        return [
            $penghimpunan->id,
            \Carbon\Carbon::parse($penghimpunan->tanggal)->format('d/m/Y'), //->isoFormat('LL'),
            $penghimpunan->uraian,
            $this->formatRupiah($penghimpunan->nominal),
            $penghimpunan->lembaga_count,
            $penghimpunan->male_count,
            $penghimpunan->female_count,
            $penghimpunan->no_name_count,
            $penghimpunan->programSumber->sumberDonasi->name ?? null,
            $penghimpunan->programSumber->name ?? null,
            $penghimpunan->sumberDana->name ?? null,
            $penghimpunan->tahun->name ?? null,
        ];
    }

    /**
     * Helper untuk format Rupiah
     */
    private function formatRupiah($nominal)
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }
}
