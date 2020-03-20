<?php

namespace App\Policies;

use App\Employer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the employer.
     *
     * @param User $user
     * @param Employer $employer
     * @return mixed
     */
    public function update(User $user, Employer $employer)
    {
        return $user->id === $employer->user_id;
    }

    /**
     * Determine whether the user can delete the employer.
     *
     * @param User $user
     * @param Employer $employer
     * @return mixed
     */
    public function delete(User $user, Employer $employer)
    {
        return $user->id === $employer->user_id;
    }

    /**
     * Determine whether the user can restore the employer.
     *
     * @param User $user
     * @param Employer $employer
     * @return mixed
     */
    public function restore(User $user, Employer $employer)
    {
        return $user->id === $employer->user_id;
    }

    /**
     * Determine whether the user can permanently delete the employer.
     *
     * @param User $user
     * @param Employer $employer
     * @return mixed
     */
    public function forceDelete(User $user, Employer $employer)
    {
        return $user->id === $employer->user_id;
    }
}
