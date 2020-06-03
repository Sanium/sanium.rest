<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * App\JobOfferResponse
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $offer_id
 * @property string $name
 * @property string $email
 * @property string $links
 * @property string $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Offer $offer
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\JobOfferResponse whereUserId($value)
 * @mixin \Eloquent
 */
class JobOfferResponse extends Model
{
    protected $guarded = [];

    public function user(): ?BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function setFile(Request $request): void
    {
        if ($request->has('file') && null !== $request->file('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $this->file = $request->file('file')->storeAs("jor-files/$this->id", $filename, 'public');
            $this->save();
        }
    }

    public function getFile(): string
    {
        return Storage::disk('public')->url($this->file);
    }
}
