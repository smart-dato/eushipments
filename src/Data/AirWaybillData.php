<?php

namespace SmartDato\EuShipments\Data;

use SmartDato\EuShipments\Contracts\Data;
use SmartDato\EuShipments\Enums\Payer;
use SmartDato\EuShipments\Enums\ShipmentType;

class AirWaybillData extends Data
{
    public function __construct(

        protected int $parcels,
        protected int $envelopes,
        protected float $totalWeight,
        protected bool $openPackage,
        protected bool $saturdayDelivery,
        protected string $referenceNumber,
        protected string $products,

        protected float $bankRepayment = 0.0,
        protected Payer $shipmentPayer = Payer::sender,
        protected ?ShipmentType $shipmentType = null,
        protected ?int $pallets = null,
        protected ?float $declaredValue = null,
        protected ?string $otherRepayment = null,
        protected ?string $observations = null,
        protected ?bool $fragile = null,
        protected ?string $productsInfo = null,
        protected ?int $piecesInPack = null,
    ) {
        //
    }

    public function build(): array
    {
        return array_filter([
            'shipmentType' => $this->shipmentType,
            'parcels' => $this->parcels,
            'envelopes' => $this->envelopes,
            'pallets' => $this->pallets,
            'totalWeight' => $this->totalWeight,
            'declaredValue' => $this->declaredValue,
            'bankRepayment' => $this->bankRepayment,
            'shipmentPayer' => $this->shipmentPayer->name,
            'otherRepayment' => $this->otherRepayment,
            'observations' => $this->observations,
            'openPackage' => $this->openPackage,
            'saturdayDelivery' => $this->saturdayDelivery,
            'referenceNumber' => $this->referenceNumber,
            'products' => $this->products,
            'fragile' => $this->fragile,
            'productsInfo' => $this->productsInfo,
            'piecesInPack' => $this->piecesInPack,
        ], fn ($value) => ! is_null($value));
    }
}
