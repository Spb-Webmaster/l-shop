<?php

namespace App\Providers;

use Support\Faker\FakerImageProvider;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;

class FakerServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider($faker));
            return $faker;
        });
    }
    public function boot(): void
    {
        //
    }
}
