<?php

namespace Database\Seeders;

use App\Models\ProgramSumber;
use Illuminate\Database\Seeder;

class ProgramSumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramSumber::factory()->count(4)->sequence(
            ['name' => 'Zakat Maal'],
            ['name' => 'Zakat Fitrah'],
            ['name' => 'Infaq'],
            ['name' => 'Amil'],
        )->create();
    }
}
