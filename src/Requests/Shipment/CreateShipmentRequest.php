<?php

namespace SmartDato\EuShipments\Requests\Shipment;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\EuShipments\Data\ShipmentData;

class CreateShipmentRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected ShipmentData $data
    ) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/createAWB';
    }

    protected function defaultBody(): array
    {
        return $this->data->build();
    }
}
