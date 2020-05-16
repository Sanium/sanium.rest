<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Employment
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Employment findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Employment newModelQuery()
 * @method static Builder|Employment newQuery()
 * @method static Builder|Employment query()
 * @method static Builder|Employment whereCreatedAt($value)
 * @method static Builder|Employment whereId($value)
 * @method static Builder|Employment whereName($value)
 * @method static Builder|Employment whereSlug($value)
 * @method static Builder|Employment whereUpdatedAt($value)
 * @mixin Eloquent
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
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }
}
