<?php

namespace App\Http\Controllers;

use App\JobOfferResponse;
use App\Offer;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class JobOfferResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Offer $offer
     * @return RedirectResponse|Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Offer $offer)
    {
        $user = Auth::user();
        if (null !== $user && $user->isClient())  {
            $user_id = $user->id;
            $offer_id = $offer->id;
            $jor = JobOfferResponse::where(static function ($query) use ($user_id, $offer_id) {
                /** @var Builder $query */
                $query->where('user_id', $user_id)->where('offer_id', $offer_id);
            })->limit(1)->get();
            if (null !== $jor) {
                $request->session()->flash('status', __('You already respond to this offer..'));
                return $request->wantsJson()
                    ? new Response(['error' => __('You already respond to this offer..')], 200)
                    : back();
            }
            $jor = $offer->jobOfferResponses()->create([
                'user_id' => $user->id,
                'name' => $user->profile->name,
                'email' => $user->email,
                'links' => $user->profile->links,
                'file' => $user->profile->file,
            ]);
        } else {
            $attr = $this->validator($request->all())->validate();
            /** @var JobOfferResponse $jor */
            $jor = $offer->jobOfferResponses()->create($attr);
            $jor->setFile($request);
        }
        $jor->notifyEmployer();
        $request->session()->flash('status', __('Mail has been send.'));
        return $request->wantsJson()
            ? new Response(['ok' =>  __('Mail has been send.')], 200)
            : back();
    }

    /**
     * Display the specified resource.
     *
     * @param JobOfferResponse $jobOfferResponse
     * @return Response
     */
    public function show(JobOfferResponse $jobOfferResponse)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param JobOfferResponse $jobOfferResponse
     * @return Response
     */
    public function destroy(JobOfferResponse $jobOfferResponse)
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191'],
            'links' => ['required', 'string'],
            'file' => ['required', 'file', 'mimetypes:application/pdf'],
        ]);
    }
}
