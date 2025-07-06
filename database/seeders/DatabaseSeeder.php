<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // DB::table('users')->insert([
        //     [
        //         'name' => 'admin',
        //         'email' => 'admin@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'created_at' => date('Y-m-d H:i:s')
        //     ],
        // ]);
        // $faker = Faker::create('id_ID'); // data Indonesia

        // $totalUmkmUnik = 50;
        // $totalEventPerUmkm = 1;

        // $umkmList = [];

        // // buat 50 UMKM unik
        // for ($i = 0; $i < $totalUmkmUnik; $i++) {
        //     $nama_umkm = $faker->company();

        //     $umkmList[] = [
        //         'nama_umkm' => $nama_umkm,
        //         'nama_pemilik' => $faker->name(),
        //         'tahun_bergabung' => $faker->numberBetween(2010, now()->year),
        //         'jenis_umkm' => $faker->randomElement(['Makanan', 'Minuman', 'Kerajinan', 'Jasa']),
        //         'username_instagram' => $faker->unique()->userName(),
        //     ];
        // }

        // // masukkan ke database 50 x 10 = 500 data
        // foreach ($umkmList as $umkm) {
        //     for ($j = 0; $j < $totalEventPerUmkm; $j++) {
        //         DB::table('umkms')->insert([
        //             'nama_umkm' => $umkm['nama_umkm'],
        //             'nama_pemilik' => $umkm['nama_pemilik'],
        //             'tahun_bergabung' => $umkm['tahun_bergabung'],
        //             'jenis_umkm' => $umkm['jenis_umkm'],
        //             'username_instagram' => $umkm['username_instagram'],
        //             'nama_event' => $faker->city() . ' Expo ' . $faker->year(),
        //         ]);
        //     }
        // }

        // echo "Seeder selesai! 500 data berhasil dimasukkan.\n";
    }
}
