<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Session;
use App\Traits\AdminAuth;

use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionPolicy
{
    /* Users are only able to:
     * ---- create new unconfirmed sessions,
     * ---- see participated sessions.
     */
    use HandlesAuthorization, AdminAuth;
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user, Session $session) { return false; }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return mixed
     */
    public function view(User $user, Session $session)
    {
        return $session->users->contains($user)
        ? Response::allow()
        : Response::deny('You can\'t see other users\' sessions.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user) { return true; }

    /**
     * Determine whether the user can update the model.
     * 
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return mixed
     */
    public function update(User $user)
    { 
        return false;
       /* return $user->isAdmin() ? Response::allow()
        : Response::deny('You can\'t edit this data.');*/
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return mixed
     */
    public function delete(User $user, Session $session) { return false; }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return mixed
     */
    public function restore(User $user, Session $session) { return false; }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Session  $session
     * @return mixed
     */
    public function forceDelete(User $user, Session $session) { return false; }
}
