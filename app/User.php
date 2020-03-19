<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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

        static::created(function (User $user) {
            // TODO exception: roles not found
            $user->roles()->attach(Role::where('name', 'employer')->first());
            $user->profile()->create([
                'name' => $user->name
            ]);
        });
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin()
    {
        return $this->roles()->get()->contains(Role::where('name', 'admin')->first());
    }

    public function isEmployer()
    {
        return $this->roles()->get()->contains(Role::where('name', 'employer')->first());
    }

    public function isClient()
    {
        return $this->roles()->get()->contains(Role::where('name', 'client')->first());
    }

    public function profile()
    {
        if ($this->isEmployer()) {
            return $this->hasOne(Employer::class);
        }
        else return null;
    }
}
