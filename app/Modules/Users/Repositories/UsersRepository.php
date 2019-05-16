<?php

namespace App\Modules\Users\Repositories;

use App\Bootstrap\Http\Repositories\Repository;
use App\Modules\Users\Models\User;

class UsersRepository extends Repository
{

    /**
     * UsersRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \Illuminate\Support\Collection|static
     */
    public function select()
    {
        return User::with('company', 'role')->all()
            ->keyBy('id')
            ->map(function ($user) {
                return "{$user->name} - {$user->role->name} - {$user->company->name}";
            });
    }


}
