<?php

namespace App\Http\Resources;

use App\Currency;
use App\User;
use App\Employment;
use App\Experience;
use App\Technology;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int id
 * @property string name
 * @property string description
 * @property string disclaimer
 * @property string|null salary_from
 * @property string|null salary_to
 * @property string city
 * @property string|null street
 * @property boolean remote
 * @property string|null tech_stack
 * @property string contact
 * @property string|null website
 * @property mixed expires_at
 * @property mixed created_at
 * @property mixed updated_at
 * @property int|null exp_id
 * @property int|null emp_id
 * @property int|null currency_id
 * @property int user_id
 */
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

        $technology = Technology::find($this->tech_id);
        if (null !== $technology) { $technology = $technology->name; }

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
            'tech_stack' => json_decode($this->tech_stack, true),
            'technology' => $technology,
            'contact' => $this->contact,
            'website' => $this->website,
            'expires_at' => $this->expires_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'employer' => $employer
        ];
    }
}
