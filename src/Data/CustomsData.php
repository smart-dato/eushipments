<?php

namespace SmartDato\EuShipments\Data;

use SmartDato\EuShipments\Contracts\Data;

class CustomsData extends Data
{

    public function __construct(
        protected ?string $dutyPaymentInfo = null,
        protected ?float $customsValue = null
    ) {
    }

    public function build(): array
    {

        return [
            'dutyPaymentInfo' => $this->dutyPaymentInfo,
            'customsValue' => $this->customsValue,
        ];
    }
}
