<?php

namespace App\Providers;

use App\Robot;
use App\Policies\RobotPolicy;
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
        Robot::class => RobotPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /*
        Gate::define('destroy', function($user, $robot) {
            if($user->isAdmin() || $user->id == $robot->user->id) {
                return true;
            }else{
                return false;
            }
        });
        */
    }
}
