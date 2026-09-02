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
            'user_id' => User::where('role_id', 1)->inRandomOrder()->value('id'),
            'foto' => 'jenis/' . $this->faker->uuid . '.jpg',
            'nama' => ucfirst($this->faker->unique()->words(2, true)),
        ];
    }
}