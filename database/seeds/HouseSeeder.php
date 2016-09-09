<?php

use App\Models\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    public function run()
    {
        House::create([
            'name' => 'gryffindor',
            'score' => 0
        ]);
        House::create([
            'name' => 'hufflepuff',
            'score' => 0
        ]);
        House::create([
            'name' => 'ravenclaw',
            'score' => 0
        ]);
        House::create([
            'name' => 'slytherin',
            'score' => 0
        ]);
    }
}
