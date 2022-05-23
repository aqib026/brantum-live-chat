<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($founder_id=0)
    {
        return view('home' ,compact('founder_id'));
    }
    public function getUsers(){
        $users = User::where('id','!=',auth()->id())->get();
        $users = UserResource::collection($users);
        return response()
            ->json([ 'status' => 'success' ,  
                        'data' => $users] );
    }
}
