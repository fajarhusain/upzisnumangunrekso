<?php

namespace Database\Seeders;

use App\Models\Penyaluran;
use Illuminate\Database\Seeder;

class PenyaluranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penyaluran::factory(5)->create();
    }
}
