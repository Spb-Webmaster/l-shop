<?php

namespace Domain\Auth\Providers;

// use Illuminate\Support\Facades\Gate;
use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Constract\RegisterNewUserConstract;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{

    public array $bindings = [
        RegisterNewUserConstract::class => RegisterNewUserAction::class
    ];

}
