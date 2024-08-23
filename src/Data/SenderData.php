<?php

namespace SmartDato\EuShipments\Data;

use SmartDato\EuShipments\Contracts\Data;

class SenderData extends Data
{
    public function __construct(
        protected string $name,
        protected string $phoneNumber,
        protected ?string $email = null,
    ) {}

    public function build(): array
    {
        return array_filter([
            'name' => $this->name,
            'phoneNumber' => $this->phoneNumber,
            'email' => $this->email,
        ], fn ($value) => ! is_null($value));
    }
}
