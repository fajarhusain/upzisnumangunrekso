<?php

namespace Database\Seeders;

use App\Models\Ashnaf;
use Illuminate\Database\Seeder;

class AshnafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Ashnaf::factory(10)->create();

        Ashnaf::factory()->count(8)->sequence(
            ['name' => 'Fakir'],
            ['name' => 'Miskin'],
            ['name' => 'Amil'],
            ['name' => 'Mualaf'],
            ['name' => 'Riqan'],
            ['name' => 'Gharimin'],
            ['name' => 'Fisabilillah'],
            ['name' => 'Ibnu Sabil'],
        )->create();
    }
}
