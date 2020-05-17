<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * App\Client
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $slug
 * @property string $links
 * @property string $file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Client findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Client newModelQuery()
 * @method static Builder|Client newQuery()
 * @method static Builder|Client query()
 * @method static Builder|Client whereCreatedAt($value)
 * @method static Builder|Client whereFile($value)
 * @method static Builder|Client whereId($value)
 * @method static Builder|Client whereLinks($value)
 * @method static Builder|Client whereName($value)
 * @method static Builder|Client whereSlug($value)
 * @method static Builder|Client whereUpdatedAt($value)
 * @method static Builder|Client whereUserId($value)
 * @mixin Eloquent
 */
class Client extends Model implements ProfileInterface
{
    use Sluggable;

    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(static function (Client $client) {
            $client->user()->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function setFile(Request $request): void
    {
        if ($request->has('file') && null !== $request->file('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $email = $this->user->email;
            $this->file = $request->file('file')->storeAs("clients-files/$email", $filename, 'public');
            $this->save();
        }
    }

    public function getFile(): string
    {
        return Storage::disk('public')->url($this->file);
    }

    public function deleteFile(): void
    {
        Storage::disk('public')->delete($this->file);
    }
}
