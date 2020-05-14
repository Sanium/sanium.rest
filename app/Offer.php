<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Offer
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $disclaimer
 * @property int|null $exp_id
 * @property int|null $emp_id
 * @property int|null $salary_from
 * @property int|null $salary_to
 * @property int|null $currency_id
 * @property string $city
 * @property string $street
 * @property int|null $remote
 * @property string|null $tech_stack Stored as JSON
 * @property int $tech_id
 * @property string $contact
 * @property string $website
 * @property string $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|\App\Offer newModelQuery()
 * @method static Builder|\App\Offer newQuery()
 * @method static Builder|\App\Offer query()
 * @method static Builder|\App\Offer whereCity($value)
 * @method static Builder|\App\Offer whereContact($value)
 * @method static Builder|\App\Offer whereCreatedAt($value)
 * @method static Builder|\App\Offer whereCurrencyId($value)
 * @method static Builder|\App\Offer whereDescription($value)
 * @method static Builder|\App\Offer whereDisclaimer($value)
 * @method static Builder|\App\Offer whereEmpId($value)
 * @method static Builder|\App\Offer whereExpId($value)
 * @method static Builder|\App\Offer whereExpiresAt($value)
 * @method static Builder|\App\Offer whereId($value)
 * @method static Builder|\App\Offer whereName($value)
 * @method static Builder|\App\Offer whereRemote($value)
 * @method static Builder|\App\Offer whereSalaryFrom($value)
 * @method static Builder|\App\Offer whereSalaryTo($value)
 * @method static Builder|\App\Offer whereStreet($value)
 * @method static Builder|\App\Offer whereTechId($value)
 * @method static Builder|\App\Offer whereTechStack($value)
 * @method static Builder|\App\Offer whereUpdatedAt($value)
 * @method static Builder|\App\Offer whereUserId($value)
 * @method static Builder|\App\Offer whereWebsite($value)
 * @mixin \Eloquent
 * @property-read \App\Currency $currency
 * @property-read \App\Employment $employment
 * @property-read \App\Experience $experience
 * @property-read \App\Technology $technology
 * @property-read \App\User $user
 * @property-read \App\Technology $technologies
 * @property string $city_slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereCitySlug($value)
 */
class Offer extends Model
{
    protected $guarded = [];

    protected $dates = ['expires_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Offer $offer) {
            $offer->city_slug = Str::slug($offer->city);
            $created_at = new Carbon($offer->created_at);
            $offer->expires_at = $created_at->addDays(30);
        });

        static::updating(function (Offer $offer) {
            $offer->city_slug = Str::slug($offer->city);
        });
    }

    public function technology()
    {
        return $this->hasOne('App\Technology', 'id', 'tech_id');
    }

    public function experience()
    {
        return $this->hasOne('App\Experience', 'id', 'exp_id');
    }

    public function employment()
    {
        return $this->hasOne('App\Employment', 'id', 'emp_id');
    }

    public function currency()
    {
        return $this->hasOne('App\Currency', 'id', 'currency_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function isExpired(): bool
    {
        return $this->expires_at < Carbon::now();
    }
}
