<?php

use App\Models\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    public function run()
    {
        if (House::where('name', 'gryffindor')->first() == null)
            House::create(['name' => 'gryffindor', 'score' => 0]);
        if (House::where('name', 'hufflepuff')->first() == null)
            House::create(['name' => 'hufflepuff', 'score' => 0]);
        if (House::where('name', 'ravenclaw')->first() == null)
            House::create(['name' => 'ravenclaw', 'score' => 0]);
        if (House::where('name', 'slytherin')->first() == null)
            House::create(['name' => 'slytherin', 'score' => 0]);
    }
}
