<?php

namespace SmartDato\EuShipments\Data;

use Illuminate\Support\Carbon;
use SmartDato\EuShipments\Contracts\Data;
use SmartDato\EuShipments\Enums\Service;

class ShipmentData extends Data
{
    public function __construct(
        protected int $senderId,
        protected int $courierId,
        protected Carbon $waybillAvailableDate,
        protected Service $serviceName,
        protected AddressData $recipient,
        protected AirWaybillData $awb,

        protected ?DocumentData $document = null,
        protected ?array $packages = null,
        protected ?CustomsData $customsData = null,
        protected ?CourierRequestData $courierRequest = null,
        protected ?ReturnLabelData $returnLabel = null,
        protected bool $testMode = true,
    ) {}

    public function build(): array
    {
        return array_filter([
            'testMode' => $this->testMode,
            'senderId' => $this->senderId,
            'courierId' => $this->courierId,
            'waybillAvailableDate' => $this->waybillAvailableDate->format('Y-m-d'),
            'serviceName' => $this->serviceName->name,
            'recipient' => $this->recipient->build(),
            'awb' => $this->awb->build(),

            'document' => $this->document?->build(),
            'packages' => $this->packages
                ? array_map(fn ($package) => $package->build(), $this->packages) : null,
            'customsData' => $this->customsData?->build(),
            'courierRequest' => $this->courierRequest?->build(),
            'returnLabel' => $this->returnLabel?->build(),
        ], fn ($value) => ! is_null($value));
    }
}
