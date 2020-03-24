<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Currency;
use App\Employment;
use App\Experience;
use App\Technology;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Resources\OfferResource;
use Illuminate\Database\Query\Builder;

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

        if ($request->has('tech')) {
            $tech = Technology::where('slug', $request->query('tech'))->first();
            if ($tech) {
                $offers->where('tech_id', $tech->id);
            }
        }

        if ($request->has('exp')) {
            $exp = Experience::where('slug', $request->query('exp'))->first();
            if ($exp) {
                $offers->where('exp_id', $exp->id);
            }
        }

        if ($request->has('city')) {
            $offers->where('city_slug', $request->query('city'));
        }

        if ($request->has('from') && $request->has('to')) {
            $salary_from = (int)$request->query('from');
            $salary_to = (int)$request->query('to');
            $offers->where(function ($query) use ($salary_from, $salary_to) {
                /** @var Builder $query */
                $query
                    ->whereBetween('salary_from', [$salary_from, $salary_to])
                    ->orWhereBetween('salary_to', [$salary_from, $salary_to]);
            });
        }

        $cities = Offer::select('city')->groupBy('city')->pluck('city')->all();
        $exps = Experience::select('name')->pluck('name')->all();
        $techs = Technology::select('name')->pluck('name')->all();
        $max_salary = Offer::selectRaw('MAX(salary_to) as max_salary')->pluck('max_salary')->first();
        $min_salary = Offer::selectRaw('MIN(salary_from) as min_salary')->pluck('min_salary')->first();

        return OfferResource::collection($offers->paginate(10))->additional([
            'filters' => [
                'cities' => $cities,
                'exp' => $exps,
                'tech' => $techs,
                'min_salary' => $min_salary,
                'max_salary' => $max_salary,
            ]
        ]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $attr = $request->validate($this->rules());

        $offer = auth()->user()->offers()->create($attr);
        $attr['remote'] = $request->has('remote') && $request->input('remote') ? true : false;

        $request->session()->flash('status', "Offer $offer->name created");

        return redirect(route('home', $offer));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Offer $offer
     * @return OfferResource|\Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return new OfferResource($offer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param \App\Offer $offer
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Request $request, Offer $offer)
    {
        try {
        $this->authorize('update', $offer);
    } catch (AuthorizationException $e) {
        $request->session()->flash('status', $e->getMessage());
        return redirect(route('home'));
    }
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Offer $offer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Offer $offer)
    {
        try {
            $this->authorize('update', $offer);
        } catch (AuthorizationException $e) {
            $request->session()->flash('status', $e->getMessage());
            return redirect(route('home'));
        }
        $attr = $request->validate($this->rules());
        $attr['remote'] = $request->has('remote') && $request->input('remote') ? true : false;

        $offer->update($attr);

        $request->session()->flash('status', "Offer $offer->name updated");

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \App\Offer $offer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Request $request, Offer $offer)
    {
        try {
            $this->authorize('delete', $offer);
            $offer_name = $offer->name;
            $offer->delete();
            $request->session()->flash('status', "Offer $offer_name has been removed.");
        } catch (\Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return redirect(route('home'));
        }
    }

    private function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'disclaimer' => 'required|string',
            'exp_id' => 'nullable',
            'emp_id' => 'nullable',
            'salary_from' => 'nullable|integer',
            'salary_to' => 'nullable|integer',
            'currency_id' => 'nullable',
            'city' => 'required|string',
            'street' => 'required|string',
            'tech_stack' => 'nullable',
            'tech_id' => 'required',
            'contact' => 'required|string',
            'website' => 'nullable|string',
            'expires_at' => 'date',
        ];
    }
}
