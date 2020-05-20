<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Role
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Role extends Model
{
    protected $guarded = [];

    public const ROLE_ADMIN = 1;
    public const ROLE_EMPLOYER = 2;
    public const ROLE_CLIENT = 3;

    /**
     * @param $roleName
     * @return int
     */
    public static function byName(string $roleName): int
    {
        switch ($roleName) {
            case 'admin':
                return self::ROLE_ADMIN;
            case 'employer':
                return self::ROLE_EMPLOYER;
            case 'client':
                return self::ROLE_CLIENT;
            default:
                throw new ModelNotFoundException("Role $roleName not found.");
        }
    }
}
