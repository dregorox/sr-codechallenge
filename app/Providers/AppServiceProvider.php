<?php

namespace App\Providers;

use App\Services\EvenTeamCountCalculator;
use App\Services\TeamCountCalculator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // This should usually be done on their own Provider, but I'm doing it here for simplicity
        $this->app->bind(TeamCountCalculator::class, EvenTeamCountCalculator::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
