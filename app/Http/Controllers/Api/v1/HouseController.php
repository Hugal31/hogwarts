<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use App\Models\House;
use App\Models\User;
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

        if ($request->has(['action', 'amount'])
            and is_numeric($request->input('amount'))
            and (int)$request->input('amount') > 0) {

            $action = $request->input('action');
            $amount = (int)$request->input('amount');
            $house = $this->get_house($house);

            if (is_null($house))
                return response()->json(['error' => 'House not found'], 404);

            switch ($action) {
                case "add":
                    $house->score += $amount;
                    break;

                case "remove":
                    $house->score -= $amount;
                    break;

                case "set":
                    $house->score = $amount;
                    break;

                default:
                    return response()->json(['error' => 'Invalid action'], 400);
            }

            if ($house->score < 0)
                $house->score = 0;
            $house->save();

            $operation = new Operation([
                'amount' => $amount,
                'action' => $action
            ]);
            $operation->user()->associate(User::where('api_token', $request->input('key'))->first());
            $operation->house()->associate($house);
            $operation->save();

            return response()->json($house);
        }

        return response()->json(['error' => 'Miss action or amount parameter'], 400);
    }
}
