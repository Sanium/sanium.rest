<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Employment;
use App\Experience;
use App\Offer;
use App\Technologies;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('verified')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::all();
        dd($offers);
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
        $tech = Technologies::all();
        return view('offer.create', [
            'experiences' => $exp,
            'employments' => $emp,
            'currencies' => $cur,
            'technologies' => $tech,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate($this->rules());

        auth()->user()->offers()->create($attr);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        dd($offer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $attr = $request->validate($this->rules());

        $offer->update($attr);
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
            'expires_at' => 'date',
        ];
    }
}
