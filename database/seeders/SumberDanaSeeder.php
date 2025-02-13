<?php

namespace Database\Seeders;

use App\Models\SumberDana;
use Illuminate\Database\Seeder;

class SumberDanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //SumberDana::factory(5)->create();

        SumberDana::factory()->count(11)->sequence(
            ['name' => 'Tunai Zakat'],
            ['name' => 'BSI Zakat'],
            ['name' => 'BPDDIY Zakat'],
            ['name' => 'Tunai Infaq'],
            ['name' => 'BSI Infaq'],
            ['name' => 'BPDDIY Infaq'],
            ['name' => 'Muamalat Infaq'],
            ['name' => 'Madina Infaq'],
            ['name' => 'Amil Bank'],
            ['name' => 'Amil Besar'],
            ['name' => 'Amil Kecil'],
            ['name' => 'Amil Bank Madina'],
        )->create();
    }
}
