<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Technologies
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology whereSlug($value)
 * @property string|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technology whereImage($value)
 */
class Technology extends Model
{
    use Sluggable;

    protected $guarded = [];

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
}
