<?php

namespace SmartDato\EuShipments\Requests\Shipment;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class ShipmentHistoryRequest extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $airWaybillNumber,
        protected bool $testMode = true,
    ) {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/fulfilment/waybills-history';
    }

    protected function defaultBody(): array
    {
        return [
            'testMode' => $this->testMode,
            'awbs' => [
                [
                    'awb' => $this->airWaybillNumber,
                ]
            ],
        ];
    }
}
