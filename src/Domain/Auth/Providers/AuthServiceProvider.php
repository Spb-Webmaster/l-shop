<?php

namespace Domain\Auth\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        //
    ];


    public function boot(): void
    {
        $this->registerPolicies();
    }

    public function register()
    {
        $this->app->register(
          ActionServiceProvider::class
        );

    }
}
