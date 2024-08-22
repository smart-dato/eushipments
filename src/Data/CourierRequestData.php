<?php

namespace SmartDato\EuShipments\Data;

use Illuminate\Support\Carbon;
use SmartDato\EuShipments\Contracts\Data;

class CourierRequestData extends Data
{
    public function __construct(
        protected ?Carbon $date = null,
        protected ?string $timeFrom = null, // hh:mm
        protected ?string $timeTo = null, // hh:mm
    ) {
        //
    }

    public function build(): array
    {
        return [
            'date' => $this->date,
            'timeFrom' => $this->timeFrom,
            'timeTo' => $this->timeTo,
        ];
    }
}
