<?php

namespace App\Policies;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SuratPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRole('admin')){
            return true;
        }

        return $user->hasPermissionTo('read surat');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Surat $surat): bool
    {
        if ($user->hasRole('admin')){
            return true;
        }

        return $user->hasPermissionTo('read surat');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->hasRole('admin')){
            return true;
        }

        return $user->hasPermissionTo('create surat');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Surat $surat): bool
    {
        if ($user->hasRole('admin')){
            return true;
        }

        return $user->hasPermissionTo('update surat');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Surat $surat): bool
    {
        if ($user->hasRole('admin')){
            return true;
        }

        return $user->hasPermissionTo('delete surat');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Surat $surat): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Surat $surat): bool
    {
        return false;
    }
}