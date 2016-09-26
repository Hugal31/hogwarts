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
        return response()->json(House::orderBy('score', 'desc')->get());
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

        $this->validate($request, [
            'action' => 'in:add,remove,set|required',
            'amount' => 'numeric|required',
        ]);

        $action = $request->input('action');
        $amount = (int)$request->input('amount');
        $house = $this->get_house($house);

        if (is_null($house))
            return response()->json(['error' => 'House not found'], 404);

        // Skip operation if it is add or remove 0
        if ($action == 'set' or $amount != 0) {

            switch ($action) {
                case "add":
                    $house->score += $amount;
                    break;

                case "remove":
                    $amount = min($amount, $house->score);
                    $house->score -= $amount;
                    break;

                case "set":
                    $house->score = $amount;
                    break;
            }

            $house->save();

            // Create the operation
            $operation = new Operation([
                'amount' => $amount,
                'action' => $action
            ]);
            if ($request->get('reason'))
                $operation->reason = $request->get('reason');
            $operation->user()->associate(User::where('api_token', $request->input('key'))->first());
            $operation->house()->associate($house);
            $operation->save();
        }

        return response()->json($house);
    }
}
