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

it('can create shipment', function () {
    $connector = new SmartDato\EuShipments\EuShipmentsConnector;

    $connector->withMockClient(new \Saloon\Http\Faking\MockClient([
        \SmartDato\EuShipments\Requests\Shipment\CreateShipmentRequest::class => \Saloon\Http\Faking\MockResponse::fixture('shipment.create.success'),
    ]));

    $response = $connector->send(
        new \SmartDato\EuShipments\Requests\Shipment\CreateShipmentRequest(
            new \SmartDato\EuShipments\Data\ShipmentData(
                senderId: 1111,
                courierId: 999,
                waybillAvailableDate: now(),
                serviceName: \SmartDato\EuShipments\Enums\Service::crossborder,
                recipient: new \SmartDato\EuShipments\Data\AddressData(
                    name: 'Nikol Kubas',
                    countryIsoCode: 'PL',
                    streetName: 'Tomkowa 35A',
                    buildingNumber: '35A',
                    addressText: 'Tomkowa 35A',
                    phoneNumber: '664351156',
                    cityName: 'Tomkowa',
                    zipCode: '58-140',
                    contactPerson: 'Nikol Kubas',
                    email: 'nikol.anna.kubas@onet.pl'
                ), awb: new \SmartDato\EuShipments\Data\AirWaybillData(
                    parcels: fake()->randomDigit() + 1,
                    envelopes: 0,
                    totalWeight: fake()->randomFloat(1),
                    openPackage: false,
                    saturdayDelivery: false,
                    referenceNumber: fake()->uuid(),
                    products: 'Clothes',
                    bankRepayment: 0,
                    shipmentPayer: \SmartDato\EuShipments\Enums\Payer::sender,
                    declaredValue: 0,
                    otherRepayment: null,
                    observations: null,
                    fragile: true,
                    productsInfo: 'Clothes',
                    piecesInPack: 1
                ),
                testMode: false
            )
        )
    );

    expect($response->status())
        ->toBe(200)
        ->and($response->json())
        ->toHaveKeys(['awb', 'barcode', 'returnLabelNumber', 'packagesBarcodes'])
        ->and($response->json()['awb'])
        ->toBe('520000014358140060945092');
});

it('can get label', function () {
    $connector = new SmartDato\EuShipments\EuShipmentsConnector;

    $connector->withMockClient(new \Saloon\Http\Faking\MockClient([
        \SmartDato\EuShipments\Requests\PrintRequest::class => \Saloon\Http\Faking\MockResponse::fixture('shipment.print.success'),
    ]));

    $response = $connector->send(
        new \SmartDato\EuShipments\Requests\PrintRequest(
            '520000014358140060945092',
            testMode: false,
        )
    );

    expect($response->status())
        ->toBe(200)
        ->and($response->json())
        ->toHaveKeys(['type', 'awb_print']);
});

it('can get shipment history', function () {
    $connector = new SmartDato\EuShipments\EuShipmentsConnector;

    $connector->withMockClient(new \Saloon\Http\Faking\MockClient([
        \SmartDato\EuShipments\Requests\Shipment\ShipmentHistoryRequest::class => \Saloon\Http\Faking\MockResponse::fixture('shipment.tracking.success'),
    ]));

    $response = $connector->send(
        new \SmartDato\EuShipments\Requests\Shipment\ShipmentHistoryRequest(
            '520000014358140060945092',
            testMode: false,
        )
    );

    expect($response->status())
        ->toBe(200);
});
