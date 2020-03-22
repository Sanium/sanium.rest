<?php

namespace App\Http\Controllers;

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
        //$user->offers()->create(['name' => 'JS Dev ', 'description'=>'d', 'disclaimer' => 'dis', 'city'=>'c', 'street'=>'s', 'tech_id' => 1, 'contact' => 'c', 'expires_at' => ' 2020-03-27 00:40:26']);

        $offers = auth()->user()->offers()->paginate(10);
        return view('dashboard', ['offers' => $offers]);
    }
}
