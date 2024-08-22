<?php

namespace SmartDato\EuShipments\Data;

use SmartDato\EuShipments\Contracts\Data;
use SmartDato\EuShipments\Enums\Format;

class DocumentData extends  Data
{

    public function __construct(
        protected string $content,
        protected Format $format = Format::pdf,
    ) {
    }

    public function build(): array
    {
        return [
            'content'=> base64_encode($this->content),
            'format'=> $this->format->name
        ];
    }
}
