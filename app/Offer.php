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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $expires_at
 * @property-read Currency $currency
 * @property-read Employment $employment
 * @property-read Experience $experience
 * @property-read Collection|JobOfferResponse[] $jobOfferResponses
 * @property-read int|null $job_offer_responses_count
 * @property-read Technology $technology
 * @property-read User $user
 * @method static Builder|Offer newModelQuery()
 * @method static Builder|Offer newQuery()
 * @method static Builder|Offer query()
 * @method static Builder|Offer whereCity($value)
 * @method static Builder|Offer whereCitySlug($value)
 * @method static Builder|Offer whereContact($value)
 * @method static Builder|Offer whereCreatedAt($value)
 * @method static Builder|Offer whereCurrencyId($value)
 * @method static Builder|Offer whereDescription($value)
 * @method static Builder|Offer whereDisclaimer($value)
 * @method static Builder|Offer whereEmpId($value)
 * @method static Builder|Offer whereExpId($value)
 * @method static Builder|Offer whereExpiresAt($value)
 * @method static Builder|Offer whereId($value)
 * @method static Builder|Offer whereName($value)
 * @method static Builder|Offer whereRemote($value)
 * @method static Builder|Offer whereSalaryFrom($value)
 * @method static Builder|Offer whereSalaryTo($value)
 * @method static Builder|Offer whereStreet($value)
 * @method static Builder|Offer whereTechId($value)
 * @method static Builder|Offer whereTechStack($value)
 * @method static Builder|Offer whereUpdatedAt($value)
 * @method static Builder|Offer whereUserId($value)
 * @method static Builder|Offer whereWebsite($value)
 * @mixin Eloquent
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
