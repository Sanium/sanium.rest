<?php

namespace App\Http\Controllers;

use App\Mail\JobOfferResponse;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OffersApplicationController extends Controller
{
    public function store(Request $request, Offer $offer) {
        $attr = $request->validate($this->rules());
        $filename = $attr['file']->getClientOriginalName();
        $path = $attr['file']->storeAs('cv/'.$attr['email'], $filename, 'public');
        Mail::to($offer->user()->first())->send(new JobOfferResponse($attr['name'], $attr['email'], $attr['links'], asset('storage/'.$path)));
        return back()->with('status', __('Mail has been send.'));
    }

    private function rules(): array
    {
        return [
            'name' => 'string|required',
            'email' => 'email|required',
            'links' => 'string|filled',
            'file' => 'file|mimes:pdf|required'
        ];
    }
}
