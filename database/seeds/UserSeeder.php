<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'laloge_h',
            'email' => 'hugo.laloge@epitech.eu',
            'password' => Hash::make('Alohomora'),
            'api_token' => str_random(32),
            'admin' => true
        ]);
    }
}
