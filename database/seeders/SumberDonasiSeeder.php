<?php

namespace Database\Seeders;

use App\Models\SumberDonasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SumberDonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SumberDonasi::factory()->count(3)->sequence(
        //     ['name' => 'Zakat'],
        //     ['name' => 'Infaq'],
        //     ['name' => 'Amil'],
        // )->create();

        $sumberDonasi = [
            'Zakat' => [
                'Zakat Maal',
                'Zakat Fitrah',
                'Zakat Profesi',
                'Zakat Muzaki request Mustahiq',
            ],

            'Infaq' => [
                'Dana Titipan',
                'Infak Shodaqoh BSI',
                'Qris BSI',
                'infak Shodaqoh BPD',
                'Qris BPD',
                'Kencleng',
                'Program Eskternal',
                'Program Internal',
                'BAGI HASIL BPD',
                'QURBAN',
                'INFAQ REFUND',
                'DONASI',
                'takjil',
                'fidyah',
                'Jumat Berkah',
                'Infaq Takmir Masjid Kampus',
                'Infaq Stand Acara',
                'Pot Infaq Gaji Dosen dan Tentik',
                'Pot Infaq HR KBK',
                'Pot Infaq Karyawan Lazismu',

            ],

            'Amil' => [
                'Dana Amil (Infaq)',
                'Dana Amil (Zakat)',
            ],
           ];

           foreach($sumberDonasi as $sumberDonasiName => $programSumber) {
               $sumberDonasi = SumberDonasi::factory()->create(['name' => $sumberDonasiName]);
               foreach ($programSumber as $programSumberName) {
                   $sumberDonasi->programSumbers()->create(['name' => $programSumberName]);
               }
           }
    }
}
