<?php

namespace SmartDato\EuShipments\Data;

use SmartDato\EuShipments\Contracts\Data;

class AddressData extends Data
{

    public function __construct(
        protected string $name,
        protected string $countryIsoCode,
        protected string $streetName,
        protected string $buildingNumber,
        protected string $addressText,
        protected string $phoneNumber,

        protected ?string $cityId = null,
        protected ?string $cityName = null,

        protected ?string $zipCode = null,
        protected ?string $region = null,
        protected ?string $contactPerson = null,
        protected ?string $email = null,
    ) {
    }

    public function build(): array
    {
        return array_filter([
            'name' => $this->name,
            'cityId' => $this->cityId,
            'countryIsoCode' => $this->countryIsoCode,
            'cityName' => $this->cityName,
            'zipCode' => $this->zipCode,
            'region' => $this->region,
            'streetName' => $this->streetName,
            'buildingNumber' => $this->buildingNumber,
            'addressText' => $this->addressText,
            'contactPerson' => $this->contactPerson,
            'phoneNumber' => $this->phoneNumber,
            'email' => $this->email,
        ], fn($value) => !is_null($value));
    }
}
