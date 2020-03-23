<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * App\Employment
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Employment extends Model
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
