<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@koperasimerahputih.id',
            'password' => 'admin123',
            'status'   => true,
        ]);

        User::create([
            'name'     => 'Budi Santoso',
            'username' => 'budi.santoso',
            'email'    => 'budi@koperasimerahputih.id',
            'password' => 'budi123',
            'status'   => true,
        ]);

        User::create([
            'name'     => 'Siti Rahayu',
            'username' => 'siti.rahayu',
            'email'    => 'siti@koperasimerahputih.id',
            'password' => 'siti123',
            'status'   => false,
        ]);
    }
}
