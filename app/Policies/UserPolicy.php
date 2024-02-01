<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to view any users, only admin can view it!');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $model->id ? Response::allow() : Response::deny('You are not authorized to view this user, only the owner can view it!');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $model->id ? Response::allow() : Response::deny('You are not authorized to update this user, only the owner can update it!');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $model->id ? Response::allow() : Response::deny('You are not authorized to delete this user, only the owner can delete it!');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to restore this user, only admin can restore it!');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to permanently delete this user, only admin can permanently delete it!');
    }
}
