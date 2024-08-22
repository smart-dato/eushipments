<?php

namespace SmartDato\EuShipments\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use SmartDato\EuShipments\Enums\PrintFileType;

class PrintRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected string $airWaybillNumber,
        protected PrintFileType $printFileType = PrintFileType::label,
        protected bool $testMode = true,
    ) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/print/'.$this->airWaybillNumber;
    }

    protected function defaultQuery(): array
    {
        return [
            'testMode' => $this->testMode,
            'printFileType' => $this->printFileType->value,
        ];
    }
}
