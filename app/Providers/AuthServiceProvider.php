<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
//use \App\Models\Session;
//use \App\Policies\Policy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        App\Models\Session::class => App\Policies\SessionPolicy::class,
        App\Models\User::class => App\Policies\UserPolicy::class,
        App\Models\Message::class => App\Policies\MessagePolicy::class
    ];
    // setting authroization classes, user roles 
    // and check if users are allowed to request
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
