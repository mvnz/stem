<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    //use WithoutModelEvents;

    public function run(): void
    {
        $faker = Faker::create('id_ID');   
        $data = [];

        for ($i = 1; $i <= 25; $i++) {
            $data[] = [
                'nama_pegawai' => $faker->name(),
                'alamat'       => $faker->address(),
                'no_telp'      => '08' . $faker->numberBetween(10000000, 99999999),
                'unit_kerja'   => 'Petugas Kebersihan',
                'status'       => 'Active',
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        DB::table('pegawais')->insert($data);
    }
}