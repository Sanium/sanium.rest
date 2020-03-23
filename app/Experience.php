<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Experience
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Experience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Experience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Experience query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Experience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Experience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Experience whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Experience whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Experience extends Model
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
