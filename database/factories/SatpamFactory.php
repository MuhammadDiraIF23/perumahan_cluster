<?php

namespace Database\Factories;

use App\Models\Satpam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SatpamFactory extends Factory
{
    protected $model = Satpam::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'pos_jaga' => $this->faker->randomElement(['Pos A', 'Pos B']),
            'jadwal_jaga' => 'Senin - Jumat',
            'shift' => 'Pagi',
            'area_patrol' => 'Blok A',
            'status_tugas' => 'Bertugas',
        ];
    }
}
