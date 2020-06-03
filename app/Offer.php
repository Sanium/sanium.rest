<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Offer
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string|null $disclaimer
 * @property int|null $exp_id
 * @property int|null $emp_id
 * @property int|null $salary_from
 * @property int|null $salary_to
 * @property int|null $currency_id
 * @property string $city
 * @property string $city_slug
 * @property string $street
 * @property int $remote
 * @property string|null $tech_stack Stored as JSON
 * @property int $tech_id
 * @property string $contact
 * @property string|null $website
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property-read \App\Currency $currency
 * @property-read \App\Employment $employment
 * @property-read \App\Experience $experience
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\JobOfferResponse[] $jobOfferResponses
 * @property-read int|null $job_offer_responses_count
 * @property-read \App\Technology $technology
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereCitySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereDisclaimer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereEmpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereExpId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereRemote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereSalaryFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereSalaryTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereTechId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereTechStack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereWebsite($value)
 * @mixin \Eloquent
 */
class Offer extends Model
{
    protected $guarded = [];

    protected $dates = ['expires_at'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function (Offer $offer) {
            $offer->city_slug = Str::slug($offer->city);
            $created_at = new Carbon($offer->created_at);
            $offer->expires_at = $created_at->addDays(30);
        });

        static::updating(static function (Offer $offer) {
            $offer->city_slug = Str::slug($offer->city);
        });
    }

    public function technology(): HasOne
    {
        return $this->hasOne(Technology::class, 'id', 'tech_id');
    }

    public function experience(): HasOne
    {
        return $this->hasOne(Experience::class, 'id', 'exp_id');
    }

    public function employment(): HasOne
    {
        return $this->hasOne(Employment::class, 'id', 'emp_id');
    }

    public function currency(): HasOne
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jobOfferResponses(): HasMany
    {
        return $this->hasMany(JobOfferResponse::class, 'offer_id', 'id');
    }

    public function isExpired(): bool
    {
        return $this->expires_at < Carbon::now();
    }
}
