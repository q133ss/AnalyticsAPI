<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'login' => 'admin',
            'email' => 'admin@email.net',
            'password' => Hash::make('password'),
            'is_admin' => 1
        ]);

        for ($i = 0; $i < 5; $i++){
            User::create([
                'login' => 'login'.$i,
                'name' => 'user_name'.$i,
                'lastname' => 'last_name'.$i,
                'patronymic' => 'patronymic'.$i,
                'company' => 'company_'.$i,
                'email' => 'email'.$i.'@mail.net',
                'password' => Hash::make('password')
            ]);
        }
    }
}
