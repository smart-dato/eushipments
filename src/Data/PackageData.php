<?php

namespace SmartDato\EuShipments\Data;

use SmartDato\EuShipments\Contracts\Data;

class PackageData extends Data
{
    public function __construct(
        protected ?float $width = null,
        protected ?float $height = null,
        protected ?float $length = null,
        protected ?float $weight = null,
    ) {}

    public function build(): array
    {
        return array_filter([
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'weight' => $this->weight,
        ], fn ($value) => ! is_null($value));

    }
}
