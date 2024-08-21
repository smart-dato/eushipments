<?php

it('can get countries form api', function () {
    $connector = new SmartDato\EuShipments\EuShipmentsConnector;

    $connector->withMockClient(new \Saloon\Http\Faking\MockClient([
        \SmartDato\EuShipments\Requests\CountriesRequest::class => \Saloon\Http\Faking\MockResponse::fixture('countries'),
    ]));

    $response = $connector->send(
        new \SmartDato\EuShipments\Requests\CountriesRequest
    );

    expect($response->status())->toBe(200);
});
