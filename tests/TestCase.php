<?php

namespace Darwinnatha\EnvManager\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Define specific services for the application.
     *
     * 
     */
    protected function getPackageProviders($app)
    {
        return [
            \Darwinnatha\EnvManager\EnvManagerServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'EnvManager' => \Darwinnatha\EnvManager\Facades\EnvManagerFacade::class,
        ];
    }
}
