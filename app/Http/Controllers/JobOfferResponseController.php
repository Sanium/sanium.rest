<?php

namespace App\Http\Controllers;

use App\JobOfferResponse;
use App\Offer;
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
        $attr = $this->validator($request->all())->validate();

        /** @var JobOfferResponse $jor */
        $jor = $offer->jobOfferResponses()->create($attr);
        $jor->setFile($request);
        $jor->notifyEmployer();
        $request->session()->flash('status', __('Mail has been send.'));
        return back();
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
