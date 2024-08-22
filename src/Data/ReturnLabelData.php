<?php

namespace SmartDato\EuShipments\Data;

use SmartDato\EuShipments\Contracts\Data;

class ReturnLabelData extends Data
{
    public function __construct(
        protected int $ndaysValid = 0,
    ) {}

    public function build(): array
    {
        return [
            'ndaysValid' => $this->ndaysValid,
        ];
    }
}
