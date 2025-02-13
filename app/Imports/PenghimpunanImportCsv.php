<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Tahun;
use App\Models\SumberDana;
use App\Models\Penghimpunan;
use App\Models\ProgramSumber;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithValidation;

class PenghimpunanImportCsv implements ToModel, WithCustomCsvSettings, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Penghimpunan([
            'tanggal' => Carbon::createFromFormat('d/m/Y', $row['tanggal'])->toDateTimeString(),
            'uraian' => $row['uraian'],
            'nominal' => $this->parseRupiah($row['nominal']),
            'lembaga_count' => $row['jumlah_lembaga'],
            'male_count' => $row['jumlah_pria'],
            'female_count' => $row['jumlah_wanita'],
            'no_name_count' => $row['jumlah_no_name'],
            'program_sumber_id' => ProgramSumber::where('name', $row['program_sumber'])->first()?->id,
            'sumber_dana_id' => SumberDana::where('name', $row['sumber_dana'])->first()?->id,
            'tahun_id' => Tahun::where('name', $row['tahun'])->first()?->id,
            'user_id' => Auth()->user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'tanggal' => ['required'], // Tanggal harus ada dan valid
            'uraian' => ['required', 'string'], // Uraian wajib diisi
            'nominal' => ['required', 'numeric'], // Nominal harus berupa angka
            'jumlah_lembaga' => ['nullable', 'integer'], // Nullable dan integer
            'jumlah_pria' => ['nullable', 'integer'], // Nullable dan integer
            'jumlah_wanita' => ['nullable', 'integer'], // Nullable dan integer
            'jumlah_no_name' => ['nullable', 'integer'], // Nullable dan integer
            'program_sumber' => ['required', Rule::exists('program_sumbers', 'name')], // Validasi nama harus ada di tabel
            'sumber_dana' => ['required', Rule::exists('sumber_danas', 'name')], // Validasi nama harus ada di tabel
            'tahun' => ['required', Rule::exists('tahuns', 'name')], // Validasi nama harus ada di tabel
        ];
    }

    public function customValidationMessages()
    {
        return [
            'tanggal.required' => 'Kolom tanggal wajib diisi.',
            'uraian.required' => 'Kolom uraian wajib diisi.',
            'nominal.required' => 'Kolom nominal wajib diisi.',
            'nominal.numeric' => 'Kolom nominal harus berupa angka.',
            'program_sumber.required' => 'Nama Program sumber wajib diisi.',
            'program_sumber.exists' => 'Nama Program sumber belum atau tidak terdaftar pada sistem.',
            'sumber_dana.required' => 'Nama Sumber dana wajib diisi.',
            'sumber_dana.exists' => 'Nama Sumber dana belum atau tidak terdaftar pada sistem.',
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.exists' => 'Tahun belum atau tidak terdaftar pada sistem.',
        ];
    }


    public function parseRupiah($value)
    {
        // Remove "Rp.", commas, and dots from the nominal input
        $numericValue = preg_replace('/[Rp \s]/', '', $value);

        // Convert the resulting string to an integer
        return (int) str_replace('.', '', $numericValue);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
        ];
    }
}
