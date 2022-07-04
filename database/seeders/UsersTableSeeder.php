<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' =>  'Admin Lelang Cengkeh',
            'phone' =>  '08238724734',
            'address' =>  'Jl. Patmosusastro No.74a, Darmo, Kec. Wonokromo, Kota SBY, Jawa Timur 60241',
            'email' => 'admin.lelangcengkeh@gmail.com',
            'is_admin' => true,
            'password' => bcrypt('password123')
        ]);

        User::create([
            'id' => 2,
            'name' =>  'Mahatir Muhammad',
            'phone' =>  '085707656364',
            'address' =>  'Jl. Babatan No.18, Babatan, Wiyung, Kota SBY, Jawa Timur 60227',
            'email' => 'mahatirmuhammad@gmail.com',
            'password' => bcrypt('password123')
        ]);
    }
}
