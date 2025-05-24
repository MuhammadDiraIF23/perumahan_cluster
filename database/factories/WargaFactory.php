<?php

namespace Database\Factories;

use App\Models\Warga;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WargaFactory extends Factory
{
    protected $model = Warga::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'no_rumah' => $this->faker->randomNumber(3, true),
            'foto_ktp' => null,
        ];
    }
}

