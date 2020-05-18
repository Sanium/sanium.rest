<?php

namespace App\Policies;

use App\JobOfferResponse;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobOfferResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the job offer response.
     *
     * @param User $user
     * @param JobOfferResponse $jobOfferResponse
     * @return mixed
     */
    public function delete(User $user, JobOfferResponse $jobOfferResponse)
    {
        return $user->id === $jobOfferResponse->user_id;
    }
}
