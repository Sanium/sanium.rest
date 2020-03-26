<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Currency
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Currency whereSlug($value)
 */
class Currency extends Model
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
