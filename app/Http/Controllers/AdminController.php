<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Currency;
use App\Employer;
use App\Employment;
use App\Experience;
use App\Offer;
use App\Technology;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(Request $request)
    {
        /** TODO
         *  Map with offers
         */
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
            return redirect(route('admin.dashboard'));
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
            return redirect(route('admin.dashboard'));
        }
    }

}
