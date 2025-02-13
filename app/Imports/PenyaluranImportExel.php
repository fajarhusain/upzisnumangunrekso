<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Pilar;
use App\Models\Tahun;
use App\Models\Ashnaf;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Penyaluran;
use App\Models\SumberDana;
use App\Models\ProgramPilar;
use App\Models\SumberDonasi;
use App\Models\ProgramSumber;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class PenyaluranImportExel implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        return new Penyaluran([
            'tanggal' => $this->convertExcelDate($row['tanggal']),
            'uraian' => $row['uraian'],
            'sumber_donasi_id' => SumberDonasi::where('name', $row['sumber_donasi'])->first()?->id,
            'program_sumber_id' => ProgramSumber::where('name', $row['program_sumber'])->first()?->id,
            'sumber_dana_id' => SumberDana::where('name', $row['sumber_dana'])->first()?->id,
            'nominal' => $this->parseRupiah($row['nominal']),
            'pilar_id' => Pilar::where('name', $row['pilar'])->first()?->id,
            'program_pilar_id' => ProgramPilar::where('name', $row['program_pilar'])->first()?->id,
            'ashnaf_id' => Ashnaf::where('name', $row['ashnaf'])->first()?->id,
            'lembaga_count' => $row['jumlah_lembaga'],
            'male_count' => $row['jumlah_pria'],
            'female_count' => $row['jumlah_wanita'],
            'provinsi_id' => Provinsi::where('name', $row['provinsi'])->first()?->id,
            'kabupaten_id' => Kabupaten::where('name', $row['kabupaten'])->first()?->id,
            'tahun_id' => Tahun::where('name', $row['tahun'])->first()?->id,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'tanggal' => ['required'], // Tanggal harus ada dan valid
            'uraian' => ['required', 'string'], // Uraian wajib diisi
            'program_sumber' => ['required', Rule::exists('program_sumbers', 'name')], // Validasi nama harus ada di tabel
            'sumber_dana' => ['required', Rule::exists('sumber_danas', 'name')], // Validasi nama harus ada di tabel
            'nominal' => ['required', 'numeric'], // Nominal harus berupa angka
            'program_pilar' => ['required', Rule::exists('program_pilars', 'name')], // Validasi nama harus ada di tabel
            'ashnaf' => ['required', Rule::exists('ashnafs', 'name')], // Validasi nama harus ada di tabel
            'jumlah_lembaga' => ['nullable', 'integer'], // Nullable dan integer
            'jumlah_pria' => ['nullable', 'integer'], // Nullable dan integer
            'jumlah_wanita' => ['nullable', 'integer'], // Nullable dan integer
            'kabupaten' => ['required', Rule::exists('kabupatens', column: 'name')], // Validasi nama harus ada di tabel
            'tahun' => ['required', Rule::exists('tahuns', 'name')], // Validasi nama harus ada di tabel

        ];
    }

    public function customValidationMessages()
    {
        return [
            'tanggal.required' => 'Kolom tanggal wajib diisi.',
            'uraian.required' => 'Kolom uraian wajib diisi.',
            'program_sumber.required' => 'Nama Program sumber wajib diisi.',
            'program_sumber.exists' => 'Nama Program sumber belum atau tidak terdaftar pada sistem.',
            'sumber_dana.required' => 'Nama Sumber dana wajib diisi.',
            'sumber_dana.exists' => 'Nama Sumber dana belum atau tidak terdaftar pada sistem.',
            'nominal.required' => 'Kolom nominal wajib diisi.',
            'nominal.numeric' => 'Kolom nominal harus berupa angka.',
            'program_pilar.required' => 'Nama Program Pilar wajib diisi.',
            'program_pilar.exists' => 'Nama Program Pilar belum atau tidak terdaftar pada sistem.',
            'ashnaf.required' => 'Nama Ashnaf wajib diisi.',
            'ashnaf.exists' => 'Nama Ashnaf belum atau tidak terdaftar pada sistem.',
            'kabupaten.required' => 'Kabupaten atau Negara wajib diisi.',
            'kabupaten.exists' => 'Kabupaten atau Negara belum atau tidak terdaftar pada sistem.',
            'tahun.required' => 'Tahun wajib diisi.',
            'tahun.exists' => 'Tahun belum atau tidak terdaftar pada sistem.',
        ];
    }


    private function convertExcelDate($value)
    {
        // Cek jika nilai adalah serial date Excel
        if (is_numeric($value)) {
            // Menggunakan PhpSpreadsheet untuk mengonversi serial date menjadi DateTime object
            $date = Date::excelToDateTimeObject($value);

            // Menggunakan Carbon untuk memformat tanggal menjadi format yang diinginkan
            return Carbon::instance($date)->format('Y-m-d');
        }

        // Jika bukan serial date, coba konversi menggunakan format tanggal umum lain
        try {
            return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            throw new \Exception('Invalid date format: ' . $value);
        }
    }

    public function parseRupiah($value)
    {
        // Remove "Rp.", commas, and dots from the nominal input
        $numericValue = preg_replace('/[Rp \s]/', '', $value);

        // Convert the resulting string to an integer
        return (int) str_replace('.', '', $numericValue);
    }
}
