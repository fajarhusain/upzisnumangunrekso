<?php

namespace Database\Factories;

use App\Models\Pilar;
use App\Models\Tahun;
use App\Models\Ashnaf;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\SumberDana;
use App\Models\ProgramPilar;
use App\Models\ProgramSumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penyaluran>
 */
class PenyaluranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => fake()->dateTime(),
            'uraian' => fake()->word(),
            'nominal' => fake()->randomNumber(5, true),
            //'penerima_manfaat_id' => PenerimaManfaat::factory(),
            'lembaga_count' => fake()->numerify(),
            'male_count' => fake()->numerify(),
            'female_count' => fake()->numerify(),
            'ashnaf_id' => Ashnaf::all()->random()->id,
            // 'pilar_id' => Pilar::factory(),
            'program_pilar_id' => ProgramPilar::all()->random()->id,
            // 'provinsi_id' => Provinsi::all()->random()->id,
            'kabupaten_id' => Kabupaten::all()->random()->id,
            'sumber_dana_id' => SumberDana::all()->random()->id,
            'program_sumber_id' => ProgramSumber::all()->random()->id,
            'tahun_id' => Tahun::all()->random()->id,
        ];
    }
}
