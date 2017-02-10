<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $password = env('ADMIN_PASSWORD');
        if (is_null($password)) {
            throw new InvalidArgumentException("Please fill the ADMIN_PASSWORD env variable");
        }

        if (User::where('email', 'admin@epitech.eu')->first() == null)
            User::create([
                'name' => 'admin',
                'email' => 'admin@epitech.eu',
                'password' => Hash::make($password),
                'api_token' => str_random(32),
                'admin' => true
            ]);
    }
}
