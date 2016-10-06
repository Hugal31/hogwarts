<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
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

    public function getAccesses(Request $request)
    {
        $this->validate($request, [
            'offset' => 'numeric|min:0',
            'limit' => 'numeric|min:0'
        ]);

        $offset = $request->get('offset', 0);
        $limit = $request->get('limit', 20);

        $accesses = Operation::orderBy('created_at', 'desc')
            ->with(['user', 'house'])
            ->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json($accesses);
    }
}
