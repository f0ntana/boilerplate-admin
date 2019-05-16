<?php

namespace App\Bootstrap\Providers;

use App\Modules\Roles\Models\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        if (!Schema::hasTable('permissions')) {
            return;
        }

        $permissions = Permission::with('roles')->get();
        foreach ($permissions as $permission) {
            $gate->define($permission->slug, function ($user) use ($permission) {
                return $permission->roles->contains($user->role);
            });
        }
    }
}
