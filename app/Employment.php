<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    protected $guarded = [];
}
