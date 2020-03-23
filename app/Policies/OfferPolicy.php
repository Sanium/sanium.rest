<?php

namespace App\Policies;

use App\Offer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the offer.
     *
     * @param User $user
     * @param Offer $offer
     * @return mixed
     */
    public function update(User $user, Offer $offer)
    {
        return $user->id === $offer->user_id;
    }

    /**
     * Determine whether the user can delete the offer.
     *
     * @param User $user
     * @param Offer $offer
     * @return mixed
    */
     public function delete(User $user, Offer $offer)
    {
        return $user->id === $offer->user_id;
    }
}
