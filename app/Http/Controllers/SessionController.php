<?php

namespace App\Http\Controllers;

use App\Http\Resources\SessionResource;
use App\Models\Session;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class SessionController extends Controller
{
    public function create(Request $request)
    {
        // $session = Session::whereIn('user1_id', [auth()->id(), $request->founder_id])
        //     ->whereIn('user2_id', [auth()->id(), $request->founder_id])
        //     ->whereRaw('user1_id != user2_id')
        //     ->first();

        // if (is_null($session)) {
            $session = Session::create(['user1_id' => auth()->id(), 'user2_id' => $request->founder_id]);
        // }
        return $session = new SessionResource($session);
    }
}
