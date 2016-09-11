<?php

namespace App\Http\Controllers\Api\v0;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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

    public function postLogin(Request $request)
    {
        if (!$request->has(['email', 'password'])) {
            return response()->json(['error' => "Missing email or password", 401]);
        }

        $user = User::where([
            ['email', '=', $request->get('email')],
        ])->first();
        if ($user && Hash::check($request->get('password'), $user->password)) {
            return response()->json(['key' => $user->api_token]);
        } else {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }
    }
}
