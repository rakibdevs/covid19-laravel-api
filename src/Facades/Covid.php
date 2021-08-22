<?php

namespace RakibDevs\Covid19\Facades;

use Illuminate\Support\Facades\Facade;

class Covid extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'covid';
    }
}
