<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Client;
use App\Employer;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

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
     * @return Renderable|RedirectResponse|Redirector|Response
     */
    public function welcome()
    {
        /** @var User $user */
        $user = auth()->user();
        if (null === $user) {
            return view('welcome', [
                'showForm' => true,
            ]);
        }

        return view('welcome', [
            'showForm' => !$user->isClient(),
        ]);
    }

        /**
     * Show the application dashboard.
     *
     * @return Renderable|RedirectResponse|Redirector
     */
    public function index()
    {
        /** @var User $user */
        $user = auth()->user();
        if (null === $user) {
            return redirect(route('welcome'));
        }

        /** @var HasOne $profile */
        $profile_handle = $user->profile();
        if (null === $profile_handle) {
            return redirect(route('welcome'));
        }

        /** @var Employer|Client|Admin $profile */
        $profile = $profile_handle->first();


        if ($user->isEmployer()) {
            $offers = $user->offers()->paginate(4);
            return view('profile.employer.dashboard', [
                'offers' => $offers,
                'employer' => $profile,
            ]);
        }
        if ($user->isClient()) {
            return view('profile.client.dashboard', [
                'client' => $profile,
            ]);
        }
        if ($user->isAdmin()) {
            return redirect(route('admin.dashboard'));
        }
        return redirect(route('welcome'));
    }
}
