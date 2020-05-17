<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Technology
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Technology findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Technology newModelQuery()
 * @method static Builder|Technology newQuery()
 * @method static Builder|Technology query()
 * @method static Builder|Technology whereCreatedAt($value)
 * @method static Builder|Technology whereId($value)
 * @method static Builder|Technology whereImage($value)
 * @method static Builder|Technology whereName($value)
 * @method static Builder|Technology whereSlug($value)
 * @method static Builder|Technology whereUpdatedAt($value)
 * @mixin Eloquent
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
