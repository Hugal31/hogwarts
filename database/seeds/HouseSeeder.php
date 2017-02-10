<?php

use App\Models\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    public function run()
    {
        House::firstOrCreate(['name' => 'gryffindor'], ['name' => 'gryffindor', 'score' => 0]);
        House::firstOrCreate(['name' => 'hufflepuff'], ['name' => 'hufflepuff', 'score' => 0]);
        House::firstOrCreate(['name' => 'ravenclaw'], ['name' => 'ravenclaw', 'score' => 0]);
        House::firstOrCreate(['name' => 'slytherin'], ['name' => 'slytherin', 'score' => 0]);
    }
}
