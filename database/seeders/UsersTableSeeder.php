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
            'email' => 'admin.lelangcengkeh@gmail.com',
            'is_admin' => true,
            'password' => bcrypt('password123')
        ]);

        User::create([
            'id' => 2,
            'name' =>  'Arya Rizky',
            'email' => 'aryarizky2303@gmail.com',
            'password' => bcrypt('password123')
        ]);
    }
}
