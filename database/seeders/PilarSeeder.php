<?php

namespace Database\Seeders;

use App\Models\Pilar;
use Illuminate\Database\Seeder;

class PilarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pilar = [
            'Pendidikan' => [
                'Beasiswa Sang Surya',
                'Beasiswa Mentari',
                'Save Our School',
                'Peduli Guru',
                'Lazismu Goes To Campus',
                'Muhammadiyah Scholarship Preparation Program (MSPP)',
                'Edutab-mu',
                'Perpus Keliling',
            ],

            'Kesehatan' => [
                'Peduli Kesehatan',
                'Indonesia Mobile Clinic',
                'SAUM',
                'Timbang',
                'END-TB',
                'Rumah Singgah Pasien',
                'Khitan',
                'Bebas Covid-19',
                'Bedah Klinik',
            ],

            'Ekonomi' => [
                'Pemberdayaan UMKM',
                'Peternakan Masyarakat Mandiri',
                'Tani Bangkit',
                'Ketahanan Pangan',
                'Keuangan Mikro',
            ],

            'Kemanusiaan' => [
                'Siaga Bencana',
                'Sekolah Cerdas',
                'Muhammadiyah AID',
                'Gudang Kemanusiaan Lazismu',
                'Pensiunan',
                'Bantuan Tenaga Tendik',
            ],

            'Sosial Dakwah' => [
                'Pemberdayaan Disabilitas',
                'Sayangi Lansia',
                'Pemberdayaan Mualaf',
                'Bedah Rumah',
                'Back to Masjid',
                'Rumah Tahfidz',
                'Indonesia Terang',
                'Takjil',
                'Jumat Berkah',
                'Program Ramadhan',
                'Dai Mandiri',
                'Qurban',
                'Zakat Fitrah',
                'Fidyah',
                'Tali Asih',
            ],

            'Lingkungan' => [
                'Penanaman Pohon',
                'Sayangi Daratmu',
                'Sayangi Lautmu',
            ],

            'Operasional' => [
                'Honorarium Bulanan (Gaji Rutin)',
                'Insentif Lembur',
                'Insentif Rapat',
                'Insentif Relawan',
                'Insentif Kebersihan',
                'Insentif Pengurus',
                'Perjalanan Dinas',
                'Konsumsi Rapat',
                'Konsumsi Pantry',
                'Perlengkapan Kantor',
                'Administrasi Umum',
                'Cetak, Fotocopy, dll',
                'Pelatihan dan Pengembangan SDM',
                'Pembelian Aset',
            ],
        ];

        foreach ($pilar as $pilarName => $programPilar) {
            $pilar = Pilar::factory()->create(['name' => $pilarName]);
            foreach ($programPilar as $programPilarName) {
                $pilar->programPilars()->create(['name' => $programPilarName]);
            }
        }
    }
}
