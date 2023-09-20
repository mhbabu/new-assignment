<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        User::create([
            'name'          => 'System Admin',
            'email'         => 'admin@gmail.com',
            'password'      => bcrypt('12345678'),
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        User::create([
            'name'          => 'Mahadi Hassan Babu',
            'email'         => 'mahadihassan.cse@gmail.com',
            'password'      => bcrypt('12345678'),
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
        
    }
}
