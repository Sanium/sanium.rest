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
        switch (strtolower($roleName)) {
            case 'admin':
            case 'administrator':
                return self::ROLE_ADMIN;
            case 'employer':
                return self::ROLE_EMPLOYER;
            case 'client':
                return self::ROLE_CLIENT;
            default:
                throw new ModelNotFoundException("Role $roleName not found.");
        }
    }

    public static function getName(int $roleId): string
    {
        switch ($roleId) {
            case self::ROLE_ADMIN:
                return 'Administrator';
            case self::ROLE_EMPLOYER:
                return 'Employer';
            case self::ROLE_CLIENT:
                return 'Client';
            default:
                throw new ModelNotFoundException("Role with id $roleId not found.");
        }
    }
}
