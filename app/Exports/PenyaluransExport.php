<?php

namespace App\Exports;

use App\Models\Penyaluran;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PenyaluransExport implements FromQuery, ShouldAutoSize, WithColumnFormatting, WithHeadings, WithMapping
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

    public string $month;

    public string $year;

    public string $provinsi;

    public string $kabupaten;

    public string $ashnaf;

    public string $pilar;

    public string $proPil;

    public string $sumDa;

    public string $proSum;

    public string $sumDon;

    public function __construct(string $month, string $year, string $provinsi, string $kabupaten, string $ashnaf, string $pilar, string $proPil, string $sumDa, string $proSum, string $sumDon)
    {
        $this->month = $month;
        $this->year = $year;
        $this->ashnaf = $ashnaf;
        $this->provinsi = $provinsi;
        $this->kabupaten = $kabupaten;
        $this->pilar = $pilar;
        $this->proPil = $proPil;
        $this->sumDa = $sumDa;
        $this->proSum = $proSum;
        $this->sumDon = $sumDon;


    }

    public function query()
    {
        // return Penyaluran::query()->with('pilar', 'programPilar', 'ashnaf', 'tahun');

        return Penyaluran::orderByDesc('updated_at')
            ->with('ashnaf', 'tahun', 'programPilar', 'kabupaten', 'sumberDana', 'programSumber')
            ->when($this->month, function ($query) {
                $query->whereMonth('tanggal', $this->month);
            })
            ->when($this->year, function ($query) {
                $query->where('tahun_id', $this->year);
            })
            ->when($this->provinsi, function ($query) {
                $query->whereHas('kabupaten', function ($query) {
                    $query->where('provinsi_id', $this->provinsi);
                });
            })
            ->when($this->kabupaten, function ($query) {
                $query->where('kabupaten_id', $this->kabupaten);
            })
            ->when($this->ashnaf, function ($query) {
                $query->where('ashnaf_id', $this->ashnaf);
            })
            ->when($this->pilar, function ($query) {
                $query->whereHas('programPilar', function ($query) {
                    $query->where('pilar_id', $this->pilar);
                });
            })
            ->when($this->proPil, function ($query) {
                $query->where('program_pilar_id', $this->proPil);
            })
            ->when($this->sumDa, function ($query) {
                $query->where('sumber_dana_id', $this->sumDa);
            })
            ->when($this->proSum, function ($query) {
                $query->where('program_sumber_id', $this->proSum);
            })
            ->when($this->sumDon, function ($query) {
                $query->whereHas('programSumber', function ($query) {
                    $query->where('sumber_donasi_id', $this->sumDon);
                });
            });
    }

    public function headings(): array
    {
        return [
            'Id',
            'Tanggal',
            'Uraian',
            'Sumber Donasi',
            'Program Sumber',
            'Sumber Dana',
            'Nominal',
            'Pilar',
            'Program Pilar',
            'Ashnaf',
            'Jumlah Lembaga',
            'Jumlah Pria',
            'Jumlah Wanita',
            'Provinsi',
            'Kabupaten',
            'Tahun',

        ];
    }

    public function map($penyaluran): array
    {

        return [
            $penyaluran->id,
            \Carbon\Carbon::parse($penyaluran->tanggal)->format('d/m/Y'), //->isoFormat('LL'),
            $penyaluran->uraian,
            $penyaluran->programSumber->sumberDonasi->name ?? null,
            $penyaluran->programSumber->name ?? null,
            $penyaluran->sumberDana->name ?? null,
            $this->formatRupiah($penyaluran->nominal),
            $penyaluran->programPilar->pilar->name ?? null,
            $penyaluran->programPilar->name ?? null,
            $penyaluran->ashnaf->name ?? null,
            $penyaluran->lembaga_count,
            $penyaluran->male_count,
            $penyaluran->female_count,
            $penyaluran->kabupaten->provinsi->name ?? null,
            $penyaluran->kabupaten->name ?? null,
            $penyaluran->tahun->name ?? null,
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
