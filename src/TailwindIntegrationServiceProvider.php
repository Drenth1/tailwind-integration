<?php

namespace Drenth1\TailwindIntegration;

use Illuminate\Support\ServiceProvider;
use Drenth1\TailwindIntegration\Console\IntegrateCommand;

class TailwindIntegrationServiceProvider extends ServiceProvider
{
    /**
     * Register the package services.
     * 
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the package services.
     * 
     * @return void
     */
    public function boot()
    {
        // Register artisan console commands.
        if ($this->app->runningInConsole()) {
            $this->commands([
                IntegrateCommand::class,
            ]);
        }
    }
}