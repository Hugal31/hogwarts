<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('house')->delete();
        DB::table('user')->delete();
        $this->call(HouseSeeder::class);
        $this->call(UserSeeder::class);

        Model::reguard();
    }
}
