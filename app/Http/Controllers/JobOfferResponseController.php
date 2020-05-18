<?php

namespace App\Http\Controllers;

use Exception;
use App\Offer;
use App\JobOfferResponse;
use App\Mail\JobOfferResponse as JobOfferResponseMail;
use App\Mail\JobOfferResponseCancel;
use Illuminate\Database\Query\Builder;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JobOfferResponseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('store');
        $this->middleware(['verified'])->except('store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Offer $offer
     * @return RedirectResponse|Response
     * @throws ValidationException
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
            if ($jor->isNotEmpty()) {
                $request->session()->flash('status', __('You already respond to this offer.'));
                return $request->wantsJson()
                    ? new Response(['error' => __('You already respond to this offer.')], 200)
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
        Mail::to($jor->offer->user)->queue(new JobOfferResponseMail($jor->name, $jor->email, $jor->links, $jor->getFile()));
        $request->session()->flash('status', __('Mail has been send.'));
        return $request->wantsJson()
            ? new Response(['ok' => __('Mail has been send.')], 200)
            : back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param JobOfferResponse $jobOfferResponse
     * @return RedirectResponse|Redirector
     */
    public function destroy(Request $request, JobOfferResponse $jobOfferResponse)
    {
        try {
            $this->authorize('delete', $jobOfferResponse);
            $email = $jobOfferResponse->email;
            $offer_id = $jobOfferResponse->offer->id;
            $offer_name = $jobOfferResponse->offer->name;
            $jobOfferResponse->delete();
            Mail::to($jobOfferResponse->offer->user)->queue(new JobOfferResponseCancel($offer_id, $offer_name, $email));
            $request->session()->flash('status', __('You have canceled your application for position :name.', ['name' => $offer_name]));
        } catch (Exception $e) {
            $request->session()->flash('status', $e->getMessage());
        } finally {
            return redirect(route('home'));
        }
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
