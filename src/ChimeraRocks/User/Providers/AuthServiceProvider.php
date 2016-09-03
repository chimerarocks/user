<?php

namespace ChimeraRocks\User\Providers;

use ChimeraRocks\User\Repositories\PermissionRepositoryInterface;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /*
            $this->before(function($user, $ability)) {
                 // true acesso total
                 // false negação total
                 // null executa ability
            }
            $this->after(function($user, $ability, $result, $arguments) {
                if (!$result) {
                    abort(403, 'Acesso não autorizado');
                }
            });
        */
        if (!app()->runningInConsole()) {
            $permissionRepo = app(PermissionRepositoryInterface::class);
            $permissions = $permissionRepo->all();

            foreach ($permssions as $p) {
                $gate->define($p->name, function($user) use ($p) {
                    return $user->isAdmin() || $user->hasRole($p->roles);
                });
            }
        }


    }
}
