<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements ProfileInterface
{
    use Sluggable;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Admin $admin) {
            $admin->user()->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
