<?php

namespace Database\Seeders;

namespace Database\Seeders;

use App\Models\PengaduanAspirasi;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Warga;
use App\Models\Satpam;


class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1️⃣ Seed 2 Role: warga & satpam
        $wargaRole = Role::create(['name' => 'warga']);
        $satpamRole = Role::create(['name' => 'satpam']);

        // 2️⃣ Seed 10 Users
        User::factory()->count(10)->create();

        // 3️⃣ Seed Warga (7) dan Satpam (3)
        Warga::factory()->count(7)->create();
        Satpam::factory()->count(3)->create();

        // 4️⃣ Assign Role ke masing-masing User
        $users = User::all();
        foreach ($users as $index => $user) {
            if ($index < 7) {
                $user->roles()->attach($wargaRole->id);
            } else {
                $user->roles()->attach($satpamRole->id);
            }
        }

        $this->call(AdminSeeder::class);

        $this->call([
            PengaduanAspirasiSeeder::class,
            SuratPengajuanSeeder::class,
            SuratPengantarDomisiliSeeder::class,
            SuratPengantarNikahSeeder::class,
            TamuSeeder::class,
            RiwayatAktivitasSeeder::class,
            NotifikasiSeeder::class,
        ]);
    }
}


// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      */
//     public function run(): void
//     {
//         // User::factory(10)->create();

//         // Menambahkan data dummy untuk NotifikasiSeeder
//         $this->call(NotifikasiSeeder::class);

//         $this->call(UserSeeder::class);

//         

//         $this->call(PengajuanSeeder::class);

//         $this->call(TamuSeeder::class);
//     }
// }
