<?php

namespace SmartDato\EuShipments\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SmartDato\EuShipments\EuShipments
 */
class EuShipments extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SmartDato\EuShipments\EuShipments::class;
    }
}
