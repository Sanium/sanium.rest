<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Currency;
use App\Employer;
use App\Employment;
use App\Experience;
use App\Offer;
use App\Technology;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard(Request $request)
    {
        $user_count = Employer::count();
        $offer_count = Offer::count();
        $latest_employers = Employer::latest()->take(6)->get();
        $latest_offers = Offer::latest()->take(6)->get();
        return view('admin.dashboard', [
            'user_count' => $user_count,
            'offer_count' => $offer_count,
            'latest_employers' => $latest_employers,
            'latest_offers' => $latest_offers,
        ]);
    }

    public function properties()
    {
        $exp = Experience::all();
        $emp = Employment::all();
        $cur = Currency::all();
        $tech = Technology::all();
        return view('admin.properties', [
            'experiences' => $exp,
            'employments' => $emp,
            'currencies' => $cur,
            'technologies' => $tech,
            'experiences_url' => 'admin.destroy.exp',
            'employments_url' => 'admin.destroy.emp',
            'currencies_url' => 'admin.destroy.cur',
            'technologies_url' => 'admin.destroy.tech',
        ]);
    }

    public function employers()
    {
        $employers = Employer::paginate(10);
        return view('admin.users', [
            'employers' => $employers
        ]);
    }

    public function employer(Employer $employer)
    {
        $employers = [$employer];
        return view('admin.users', [
            'employers' => $employers
        ]);
    }

    public function offers(Employer $employer)
    {
        /** @var User $user */
        $user = $employer->user()->first();
        $offers = $user->offers()->paginate(10);
        return view('admin.offers', [
            'employer' => $employer,
            'offers' => $offers,
        ]);
    }

    public function destroyEmployer(Request $request, Employer $employer)
    {
        try {
            $name = $employer->name;
            $employer->delete();
            $request->session()->flash('status', "Employer $name has been removed.");
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return back();
        }
    }

    public function destroyOffer(Request $request, Offer $offer)
    {
        try {
            $name = $offer->name;
            $offer->delete();
            $request->session()->flash('status', "Offer $name has been removed.");
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return back();
        }
    }

    public function destroyTechnology(Request $request, Technology $technology)
    {
        try {
            $name = $technology->name;
            $technology->delete();
            $request->session()->flash('status', "Technology $name has been removed.");
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return back();
        }
    }

    public function destroyExperience(Request $request, Experience $experience)
    {
        try {
            $name = $experience->name;
            $experience->delete();
            $request->session()->flash('status', "Experience $name has been removed.");
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return back();
        }
    }

    public function destroyEmployment(Request $request, Employment $employment)
    {
        try {
            $name = $employment->name;
            $employment->delete();
            $request->session()->flash('status', "Employment $name has been removed.");
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return back();
        }
    }

    public function destroyCurrency(Request $request, Currency $currency)
    {
        try {
            $name = $currency->name;
            $currency->delete();
            $request->session()->flash('status', "Currency $name has been removed.");
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return back();
        }
    }

    public function confirmEmail(Request $request, Employer $employer)
    {
        /** @var User $user */
        $user = $employer->user()->first();
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            $request->session()->flash('status', "Email has marked as verified.");
        }
        return back();
    }
}
