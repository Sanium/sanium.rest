<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/**
 * App\Employer
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer findSimilarSlugs($attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereUserId($value)
 * @mixin \Eloquent
 * @property int $size
 * @property string $website
 * @property string $logo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Employer whereWebsite($value)
 */
class Employer extends Model implements ProfileInterface
{
    use Sluggable;

    protected $guarded = [];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(static function (Employer $employer) {
            $all_offers = $employer->user()->first()->offers()->get();
            foreach ($all_offers as $offer) {
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

    public function getLogo()
    {
        if(is_null($this->logo)) {
            return asset('storage/defaults/user.jpg');
        }

        return asset($this->logo);
    }

    public function setLogo(Request $request): void
    {
        if ($request->has('logo')) {
            $filename = $request->file('logo')->getClientOriginalName();
            $employerUID = $this->user_id . '-' . $this->slug;
            $imagePath = '/storage/' . $request->file('logo')->storeAs('profile', "$employerUID-$filename", 'public');
            $image = Image::make(public_path($imagePath))->fit(env('AVATAR_SIZE', 300));
            unlink(substr($imagePath, 1));
            $jpg = Image::canvas(env('AVATAR_SIZE', 300), env('AVATAR_SIZE', 300), '#ffffff');
            $jpg->insert($image);
            $imagePath = 'storage/profile/' . $image->filename . '.jpg';
            $jpg->save($imagePath);
            $this->logo = '/'.$imagePath;
            $this->save();
        }
    }
}
