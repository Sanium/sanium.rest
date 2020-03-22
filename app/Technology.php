<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 */
class Technology extends Model
{
    protected $guarded = [];
}
