<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

/**
 * App\Employer
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $slug
 * @property string|null $size
 * @property string|null $website
 * @property string|null $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Employer findSimilarSlugs($attribute, $config, $slug)
 * @method static Builder|Employer newModelQuery()
 * @method static Builder|Employer newQuery()
 * @method static Builder|Employer query()
 * @method static Builder|Employer whereCreatedAt($value)
 * @method static Builder|Employer whereId($value)
 * @method static Builder|Employer whereLogo($value)
 * @method static Builder|Employer whereName($value)
 * @method static Builder|Employer whereSize($value)
 * @method static Builder|Employer whereSlug($value)
 * @method static Builder|Employer whereUpdatedAt($value)
 * @method static Builder|Employer whereUserId($value)
 * @method static Builder|Employer whereWebsite($value)
 * @mixin Eloquent
 */
class Employer extends Model implements ProfileInterface
{
    use Sluggable;

    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(static function (Employer $employer) {
            foreach ($employer->user->offers as $offer) {
                $offer->delete();
            }
            $employer->user()->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /** @noinspection PhpUnused */
    public function getLogo()
    {
        if (is_null($this->logo)) {
            return asset('storage/defaults/user.jpg');
        }

        return asset($this->logo);
    }

    public function setLogo(Request $request): void
    {
        if ($request->has('logo') && null !== $request->file('logo')) {
            $filename = $request->file('logo')->getClientOriginalName();
            $employerUID = $this->user_id . '-' . $this->slug;
            $imagePath = '/storage/' . $request->file('logo')->storeAs('profile', "$employerUID-$filename", 'public');
            $image = Image::make(public_path($imagePath))->fit(env('AVATAR_SIZE', 300));
            unlink(substr($imagePath, 1));
            $jpg = Image::canvas(env('AVATAR_SIZE', 300), env('AVATAR_SIZE', 300), '#ffffff');
            $jpg->insert($image);
            $imagePath = 'storage/profile/' . $image->filename . '.jpg';
            $jpg->save($imagePath);
            $this->logo = '/' . $imagePath;
            $this->save();
        }
    }
}
