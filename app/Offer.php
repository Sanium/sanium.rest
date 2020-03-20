<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Offer
 *
 * @property int $id
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
 * @property string|null $tech-stack Stored as JSON
 * @property int $tech_id
 * @property string $contact
 * @property string $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Offer whereCity($value)
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
 * @mixin \Eloquent
 */
class Offer extends Model
{
    protected $guarded = [];

    public function technologies()
    {
        return $this->hasOne('App\Technologies', 'id', 'tech_id');
    }

    public function experience()
    {
        return $this->hasOne('App\Experience', 'id', 'exp_id');
    }

    public function employment()
    {
        return $this->hasOne('App\Employment', 'id', 'emp_id');
    }
}
