<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

    public function getUser(Request $request)
    {
        $user = User::where('api_token', $request->input('key'))->first();
        return $user->makeVisible('admin')->toJson();
    }

    public function getUsers()
    {
        return response()->json(User::all());
    }

    // Mainly for change password
    public function putUser(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);

        $user = User::where('api_token', $request->input('key'))->firstOrFail();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return response()->json($user);
    }

    public function postUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|required|unique:user',
            'password' => 'required',
            'admin' => 'boolean'
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->admin = $request->get('admin');
        $token = str_random(32);
        while (User::where('api_token', '=', $token)->count() != 0)
            $token = str_random(32);
        $user->api_token = $token;
        $user->save();

        return response()->json($user);
    }
}
