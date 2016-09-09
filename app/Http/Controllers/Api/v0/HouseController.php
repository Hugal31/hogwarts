<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;

class HouseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function houses() {
        // Temporary mock
        return response()->json([
            'houses' => [
                'gryffindor' => [
                    'score' => 1
                ],
                'hufflepuff' => [
                    'score' => 2
                ],
                'ravenclaw' => [
                    'score' => 3
                ],
                'slytherin' => [
                    'score' => 4
                ]
            ]
        ]);
    }
}
