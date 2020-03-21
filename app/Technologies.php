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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technologies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technologies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technologies query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technologies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technologies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technologies whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Technologies whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Technologies extends Model
{
    protected $guarded = [];
}
