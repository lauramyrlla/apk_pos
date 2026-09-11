<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Jenis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jenis>
 */
class JenisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'    => User::factory(),
            'nama_jenis' => fake()->unique()->randomElement([
                'Makanan', 'Minuman', 'Elektronik', 'Pakaian',
                'Food Cat', 'Peralatan Rumah', 'Alat Tulis', 'Mainan',
            ]),
        ];
    }
}