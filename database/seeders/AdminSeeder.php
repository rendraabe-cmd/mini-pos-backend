<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin POS',
            'email'    => 'admin@minipos.com',
            'password' => bcrypt('password123'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Kasir 1',
            'email'    => 'kasir@minipos.com',
            'password' => bcrypt('password123'),
            'role'     => 'kasir',
        ]);
    }
}
