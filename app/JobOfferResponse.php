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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Offer $offer
 * @property-read User|null $user
 * @method static Builder|JobOfferResponse newModelQuery()
 * @method static Builder|JobOfferResponse newQuery()
 * @method static Builder|JobOfferResponse query()
 * @method static Builder|JobOfferResponse whereCreatedAt($value)
 * @method static Builder|JobOfferResponse whereEmail($value)
 * @method static Builder|JobOfferResponse whereFile($value)
 * @method static Builder|JobOfferResponse whereId($value)
 * @method static Builder|JobOfferResponse whereLinks($value)
 * @method static Builder|JobOfferResponse whereName($value)
 * @method static Builder|JobOfferResponse whereOfferId($value)
 * @method static Builder|JobOfferResponse whereUpdatedAt($value)
 * @method static Builder|JobOfferResponse whereUserId($value)
 * @mixin Eloquent
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
