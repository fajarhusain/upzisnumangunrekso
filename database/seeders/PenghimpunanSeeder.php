<?php

namespace Database\Seeders;

use App\Models\Penghimpunan;
use Illuminate\Database\Seeder;

class PenghimpunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penghimpunan::factory(5)->create();
    }
}
