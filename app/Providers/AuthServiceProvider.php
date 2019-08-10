<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-baju', function($user)
        {
            if($user)
            {
                  return true;
            }
        });

        Gate::define('manage-kupon', function($user)
        {
            if($user)
            {
                  return true;
            }
        });

        Gate::define('manage-order', function($user)
        {
            if($user)
            {
                  return true;
            }
        });

        Gate::define('manage-kategori',function($user)
        {
            if($user)
            {
                  return true;
            }
        });

        Gate::define('manage-bank', function($user)
        {
            if($user)
            {
                  return true;
            }
        });
    }
}
