<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Models\Access;

class AccessController extends Controller
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

    public function getAccesses()
    {
        $accesses = Access::orderBy('created_at', 'desc')->with(['user', 'house'])->limit(20)->get(); // TODO limit

        return response()->json(['accesses' => $accesses]);
    }
}
