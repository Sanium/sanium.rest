<?php

namespace App;

use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role
 * @property mixed $role_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Offer[] $offers
 * @property-read int|null $offers_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
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
        'name', 'email', 'password', 'role',
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
        return Role::ROLE_ADMIN === $this->role;
    }

    public function isEmployer(): bool
    {
        return Role::ROLE_EMPLOYER === $this->role;
    }

    public function isClient(): bool
    {
        return Role::ROLE_CLIENT === $this->role;
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

    public function getRoleNameAttribute($value): string
    {
        return Role::getName($this->role);
    }

    public function setRoleNameAttribute(string $value): void
    {
        $this->attributes['role'] = Role::byName($value);
    }
}
