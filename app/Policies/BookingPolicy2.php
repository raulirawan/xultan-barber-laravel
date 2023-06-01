<?php

namespace App\Policies;

use App\Booking;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Booking $booking)
    {
        return $user->id === $booking->users_id;
    }
}
