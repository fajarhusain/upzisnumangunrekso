<?php

namespace App\Policies;

use App\Models\Penghimpunan;
use App\Models\User;

class PenghimpunanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {

        return $user->hasRole('penghimpun') || $user->hasRole('admin') || $user->hasRole('pengawas');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Penghimpunan $penghimpunan)
    {
        return $user->hasRole('penghimpun') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasRole('penghimpun') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->hasRole('penghimpun') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Penghimpunan $penghimpunan)
    {
        return $user->hasRole('penghimpun') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Penghimpunan $penghimpunan)
    {
        return $user->hasRole('penghimpun') || $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Penghimpunan $penghimpunan)
    {
        return $user->hasRole('penghimpun') || $user->hasRole('admin');
    }
}
