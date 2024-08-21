<?php

namespace SmartDato\EuShipments;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Http\Auth\TokenAuthenticator;

class EuShipmentsConnector extends Connector
{
    use AcceptsJson;

    public function __construct(
        protected readonly ?string $url = null,
        protected readonly ?string $token = null,
    ) {
    }

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return $this->url ?? config('eushipments.base_url');
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator(
            token: $this->token ?? config('eushipments.token'),
        );
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [];
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
