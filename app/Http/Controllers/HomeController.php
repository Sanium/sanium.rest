<?php

namespace App\Http\Controllers;

use App\ProfileInterface;
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
        $this->middleware('auth')->except('welcome');
        $this->middleware('registered')->except('welcome');
    }

    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        /** @var ProfileInterface $profile */
        $profile = auth()->user()->profile()->first();
        if (auth()->user()->isEmployer()) {
            $offers = auth()->user()->offers()->paginate(4);
            return view('dashboard', [
                'offers' => $offers,
                'employer' => $profile,
            ]);
        } else {
            return redirect(route('admin.dashboard'));
        }
    }
}
