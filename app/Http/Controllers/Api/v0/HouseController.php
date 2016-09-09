<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

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
        return response()->json(House::all());
    }

    protected function get_house($house) {
        if (is_numeric($house)) {
            return House::find($house);
        } else {
            return House::where('name', $house)->first();
        }
    }

    public function house($house) {
        $house = $this->get_house($house);
        if (is_null($house))
            return response()->json(['error' => 'House not found'], 404);
        return response()->json($house);
    }

    public function putHouse(Request $request, $house) {
        $house = $this->get_house($house);

        if (is_null($house))
            return response()->json(['error' => 'House not found'], 404);

        if ($request->has('action') and $request->has('amount') and is_numeric($request->input('amount'))) {
            switch ($request->input('action')) {
                case "add":
                    $house->score += (int)$request->input('amount');
                    break;

                case "remove":
                    $house->score -= (int)$request->input('amount');
                    break;

                case "set":
                    $house->score = (int)$request->input('amount');
                    break;

                default:
                    return response()->json(['error' => 'Invalid action'], 400);
            }
            $house->save();
            return response()->json($house);
        }

        return response()->json(['error' => 'Miss action or amount parameter'], 400);
    }
}
