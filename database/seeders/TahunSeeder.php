<?php

namespace Database\Seeders;

use App\Models\Tahun;
use Illuminate\Database\Seeder;

class TahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tahun::factory()->count(11)->sequence(
            ['name' => '2020'],
            ['name' => '2021'],
            ['name' => '2022'],
            ['name' => '2023'],
            ['name' => '2024'],
            ['name' => '2025'],
            ['name' => '2026'],
            ['name' => '2027'],
            ['name' => '2028'],
            ['name' => '2029'],
            ['name' => '2030'],
        )->create();
    }
}
