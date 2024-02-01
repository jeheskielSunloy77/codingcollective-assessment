<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to view any transactions, only admin can view it!');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Transaction $transaction): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $transaction->user_id ? Response::allow() : Response::deny('You are not authorized to view this transaction, only the owner can view it!');
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
    public function update(User $user, Transaction $transaction): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $transaction->user_id ? Response::allow() : Response::deny('You are not authorized to update this transaction, only the owner can update it!');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transaction $transaction): Response
    {
        if ($user->role === 'admin') {
            return Response::allow();
        }
        return $user->id === $transaction->user_id ? Response::allow() : Response::deny('You are not authorized to delete this transaction, only the owner can delete it!');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transaction $transaction): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to restore this transaction, only admin can restore it!');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transaction $transaction): Response
    {
        return $user->role === 'admin' ? Response::allow() : Response::deny('You are not authorized to permanently delete this transaction, only admin can permanently delete it!');
    }
}
