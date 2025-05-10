<?php

namespace Darwinnatha\EnvManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void set(string $key, string $value, string|null $envPath = null)
 * @method static void remove(string $key, string|null $envPath = null)
 * @method static void updateOrCreateEnvVariable(string $key, string $value, string|null $envPath)
 * 
 * @see \Darwinnatha\EnvManager\EnvManager
 */
class EnvManagerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'EnvManager';
    }
}