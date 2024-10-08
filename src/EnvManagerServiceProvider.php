<?php

namespace Darwinnatha\EnvManager;

use Illuminate\Support\ServiceProvider;

class EnvManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Autres actions de configuration
    }

    public function register()
    {
        $this->app->singleton('EnvManager', function ($app) {
            return new EnvManager();
        });
    }
}
