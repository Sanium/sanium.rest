<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Employment;
use App\Experience;
use App\Http\Resources\OfferResource;
use App\Offer;
use App\Technology;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('verified')->except(['index', 'show', 'edit']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $offers = Offer::select('*');

        $tech_slug = $request->query('tech');
        if ($tech_slug) {
            $tech = Technology::where('slug', $tech_slug)->first();
            if ($tech) {
                $offers->where('tech_id', $tech->id);
            }
        }

        $exp_slug = $request->query('exp');
        if ($exp_slug) {
            $exp = Experience::where('slug', $exp_slug)->first();
            if ($exp) {
                $offers->where('exp_id', $exp->id);
            }
        }

        $city = $request->query('city');
        if ($city) {
            $offers->where('city_slug', $city);
        }

        $salary_from = $request->query('from');
        $salary_to = $request->query('to');
        if($salary_from && $salary_to) {
            $offers->whereBetween('salary_from', [$salary_from, $salary_to])->orWhereBetween('salary_to', [$salary_from, $salary_to]);
        }

        return OfferResource::collection($offers->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $exp = Experience::all();
        $emp = Employment::all();
        $cur = Currency::all();
        $tech = Technology::all();
        return view('offer.edit', [
            'experiences' => $exp,
            'employments' => $emp,
            'currencies' => $cur,
            'technologies' => $tech,
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $attr = $request->validate($this->rules());

        $offer = auth()->user()->offers()->create($attr);

        $request->session()->flash('status', "Offer $offer->name created");

        return redirect(route('home', $offer));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return OfferResource|\Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return new OfferResource($offer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Offer $offer)
    {
        $exp = Experience::all();
        $emp = Employment::all();
        $cur = Currency::all();
        $tech = Technology::all();
        return view('offer.edit', [
            'experiences' => $exp,
            'employments' => $emp,
            'currencies' => $cur,
            'technologies' => $tech,
            'edit' => true,
            'offer' => $offer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Offer $offer)
    {
        $attr = $request->validate($this->rules());

        $offer->update($attr);

        $request->session()->flash('status', "Offer $offer->name updated");

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        //
    }

    private function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'disclaimer' => 'required',
            'exp_id' => 'nullable',
            'emp_id' => 'nullable',
            'salary_from' => 'nullable',
            'salary_to' => 'nullable',
            'currency_id' => 'nullable',
            'city' => 'required',
            'street' => 'required',
            'remote' => 'nullable',
            'tech_stack' => 'nullable',
            'tech_id' => 'required',
            'contact' => 'required',
            'webiste' => 'nullable',
            'expires_at' => 'date',
        ];
    }
}
