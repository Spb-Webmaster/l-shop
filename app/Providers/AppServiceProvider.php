<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());


/*        DB::whenQueryingForLongerThan( CarbonInterval::second(5), function (Connection $connection) {
               logger()->channel('telegram')
            ->debug('whenQueryingForLongerThan: ' . $connection->totalQueryDuration());
        });
        */
        DB::Listen(function ($query) {

            if($query->time > 100) {
                logger()->channel('telegram')
                    ->debug('whenQueryingForLongerThan: ' . $query->sql, $query->bindings);
            }

        });

        $kernel = app(Kernel::class);
        $kernel->whenRequestLifecycleIsLongerThan(
           CarbonInterval::second(4),
            function () {
               logger()
                   ->channel('telegram')
                   ->debug('whenRequestLifecycleIsLongerThan: ' . request()->url());
            }
        );


    }
}
