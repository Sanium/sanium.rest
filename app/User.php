<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Offer;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Employer|\App\Client $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\JobOfferResponse[] $jobOfferResponses
 * @property-read int|null $job_offer_responses_count
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (User $user) {
            $user->profile()->first()->delete();
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isEmployer()
    {
        return $this->roles()->get()->contains(Role::where('name', 'employer')->first());
    }

    public function isClient()
    {
        return $this->roles()->get()->contains(Role::where('name', 'client')->first());
    }

    public function isAdmin()
    {
        return $this->roles()->get()->contains(Role::where('name', 'admin')->first());
    }

    public function profile(): ?HasOne
    {
        if ($this->isAdmin()) {
            return $this->hasOne(Admin::class);
        }
        if ($this->isEmployer()) {
            return $this->hasOne(Employer::class);
        }
        if ($this->isClient()) {
            return $this->hasOne(Client::class);
        }
        return null;
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'user_id', 'id');
    }

    /**
     * @return HasMany|HasManyThrough|null
     */
    public function jobOfferResponses()
    {
        if ($this->isClient()) {
            return $this->hasMany(JobOfferResponse::class, 'user_id', 'id');
        }
        if ($this->isEmployer()) {
            return $this->hasManyThrough(JobOfferResponse::class, Offer::class);
        }
        return null;
    }

    public static function createWithRole(array $attr): ?User
    {
        if (array_key_exists('role', $attr)) {
            if (null === $attr['role']) {
                return null;
            }
            if (is_numeric($attr['role'])) {
                $role_id = $attr['role'];
                unset($attr['role']);
                $user = self::create($attr);
                $user->roles()->attach(Role::findOrFail($role_id)->first());
            } else {
                $role_name = $attr['role'];
                unset($attr['role']);
                $user = self::create($attr);
                $user->roles()->attach(Role::where('name', $role_name)->firstOrFail());
            }
        } else {
            return self::create($attr);
        }
        return $user;
    }
}
