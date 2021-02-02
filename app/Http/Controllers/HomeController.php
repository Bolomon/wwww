<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Favorit;
use Illuminate\Http\Request;

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
    public function index()
    {
        // var_dump(Auth::id());
        // die();
        return view('home',['favorit'=>Favorit::where('user_id',Auth::id())->get()]);
    }
}
