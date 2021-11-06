<?php

namespace App\Library\Facades;

use Illuminate\Support\Facades\Facade;

class FlutterwaveFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'flutterwave';
    }
}