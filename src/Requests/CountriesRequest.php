<?php

namespace SmartDato\EuShipments\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class CountriesRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/get-countries';
    }
}
