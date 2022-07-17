<?php

namespace App\Policies;

use App\Models\Popup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PopupPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Popup $popup)
    {
        return $user->id === $popup->domain->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Popup $popup)
    {
        return $user->id === $popup->domain->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Popup  $popup
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Popup $popup)
    {
        return $user->id === $popup->domain->user_id;
    }
}
