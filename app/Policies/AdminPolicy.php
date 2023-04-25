<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdminPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool	// тут необычно, два объекта User появляется
    {	// в аргументах переменную $model назвали лишь потому что $user уже один раз объявили в аргументах, можно было и по другому
		// назвать вместо $model, например $my_user. Да, имя $model может немного смутить, ведь там информация о пользователе
		// dd($model);
		return $model->role === 'admin';
		// Аналог этого:
//      if ($model->role !== 'admin')
//			return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
