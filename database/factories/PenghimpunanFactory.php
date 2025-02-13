<?php

namespace Database\Factories;

use App\Models\ProgramSumber;
use App\Models\SumberDana;
use App\Models\Tahun;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penghimpunan>
 */
class PenghimpunanFactory extends Factory
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
            'lembaga_count' => fake()->numerify(),
            'male_count' => fake()->numerify(),
            'female_count' => fake()->numerify(),
            'no_name_count' => fake()->numerify(),
            'sumber_dana_id' => SumberDana::all()->random()->id,
            'program_sumber_id' => ProgramSumber::all()->random()->id,
            'tahun_id' => Tahun::all()->random()->id,
        ];
    }
}
