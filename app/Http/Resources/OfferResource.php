<?php

namespace App\Http\Resources;

use App\Currency;
use App\User;
use App\Employment;
use App\Experience;
use App\Technologies;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $experience = Experience::find($this->exp_id);
        if (null !== $experience) { $experience = $experience->name; }

        $employment = Employment::find($this->emp_id);
        if (null !== $employment) { $employment = $employment->name; }

        $currency = Currency::find($this->currency_id);
        if (null !== $currency) { $currency = $currency->name; }

        $technologie = Technologies::find($this->tech_id);
        if (null !== $technologie) { $technologie = $technologie->name; }

        $employer = User::findOrFail($this->user_id)->profile()->first();
        $employer = new EmployerResource($employer);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'disclaimer' => $this->disclaimer,
            'experience' => $experience,
            'employment' => $employment,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'currency' => $currency,
            'city' => $this->city,
            'street' => $this->street,
            'remote' => $this->remote,
            'tech_stack' => json_decode($this->tech_stack),
            'technologie' => $technologie,
            'contact' => $this->contact,
            'expires_at' => $this->expires_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'employer' => $employer
        ];
    }
}
