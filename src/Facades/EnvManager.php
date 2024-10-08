<?php

namespace Darwinnatha\EnvManager\Facades;

use Illuminate\Support\Facades\Facade;

class EnvManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'EnvManager';
    }
}

