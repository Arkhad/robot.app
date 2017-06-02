<?php

namespace App\Policies;

use App\User;
use App\Robot;
use Illuminate\Auth\Access\HandlesAuthorization;

class RobotPolicy
{
    use HandlesAuthorization;


    public function before(User $user, $ability) {
        if($user->isAdmin()) return true;
    }
    /**
     * Determine whether the user can view the robot.
     *
     * @param  \App\User  $user
     * @param  \App\Robot  $robot
     * @return mixed
     */
    public function view(User $user, Robot $robot)
    {
        // on s'en fou !
    }

    /**
     * Determine whether the user can create robots.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the robot.
     *
     * @param  \App\User  $user
     * @param  \App\Robot  $robot
     * @return mixed
     */
    public function update(User $user, Robot $robot)
    {
        if($user->id == $robot->user_id) return true;
    }

    /**
     * Determine whether the user can delete the robot.
     *
     * @param  \App\User  $user
     * @param  \App\Robot  $robot
     * @return mixed
     */
    public function delete(User $user, Robot $robot)
    {
        if($user->id == $robot->user_id) return true;
    }
}
