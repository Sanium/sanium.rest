<?php

namespace App;

use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|JobOfferResponse[] $jobOfferResponses
 * @property-read int|null $job_offer_responses_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Offer[] $offers
 * @property-read int|null $offers_count
 * @property-read Admin|Employer|Client|null $profile
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
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

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(static function (User $user) {
            if (null !== $user->profile()) {
                $user->profile()->delete();
            }
        });
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

    public function isAdmin(): bool
    {
        return $this->roles()->get()->contains(Role::where('name', 'admin')->first());
    }

    public function isEmployer(): bool
    {
        return $this->roles()->get()->contains(Role::where('name', 'employer')->first());
    }

    public function isClient(): bool
    {
        return $this->roles()->get()->contains(Role::where('name', 'client')->first());
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
}
