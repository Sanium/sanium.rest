<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Employer extends Model
{
    use Sluggable;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Employer $employer) {
            $employer->user()->delete();
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
