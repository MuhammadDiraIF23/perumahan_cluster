<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'nik' => $this->faker->unique()->numerify('###############'),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'no_whatsapp' => $this->faker->phoneNumber,
            'no_telepon' => $this->faker->phoneNumber,
            'alamat' => $this->faker->address,
            'foto_diri' => null,
            'akses' => 'on',
        ];
    }
}
