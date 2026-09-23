<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\EuShipments\Data\AddressData;
use SmartDato\EuShipments\Data\AirWaybillData;
use SmartDato\EuShipments\Data\ShipmentData;
use SmartDato\EuShipments\Enums\Payer;
use SmartDato\EuShipments\Enums\Service;
use SmartDato\EuShipments\EuShipmentsConnector;
use SmartDato\EuShipments\Requests\CountriesRequest;
use SmartDato\EuShipments\Requests\PrintRequest;
use SmartDato\EuShipments\Requests\Shipment\CreateShipmentRequest;
use SmartDato\EuShipments\Requests\Shipment\ShipmentHistoryRequest;

it('can get countries form api', function () {
    $connector = new EuShipmentsConnector;

    $connector->withMockClient(new MockClient([
        CountriesRequest::class => MockResponse::fixture('countries'),
    ]));

    $response = $connector->send(
        new CountriesRequest
    );

    expect($response->status())->toBe(200);
});

it('can create shipment', function () {
    $connector = new EuShipmentsConnector;

    $connector->withMockClient(new MockClient([
        CreateShipmentRequest::class => MockResponse::fixture('shipment/create_success'),
    ]));

    $response = $connector->send(
        new CreateShipmentRequest(
            new ShipmentData(
                senderId: 1111,
                courierId: 999,
                waybillAvailableDate: now(),
                serviceName: Service::crossborder,
                recipient: new AddressData(
                    name: 'Jane Doe',
                    countryIsoCode: 'PL',
                    streetName: 'ul. Przykladowa 1',
                    buildingNumber: '35A',
                    addressText: 'ul. Przykladowa 1',
                    phoneNumber: '000000000',
                    cityName: 'Warszawa',
                    zipCode: '00-001',
                    contactPerson: 'Jane Doe',
                    email: 'jane@example.com'
                ), awb: new AirWaybillData(
                    parcels: fake()->randomDigit() + 1,
                    envelopes: 0,
                    totalWeight: fake()->randomFloat(1),
                    openPackage: false,
                    saturdayDelivery: false,
                    referenceNumber: fake()->uuid(),
                    products: 'Clothes',
                    bankRepayment: 0,
                    shipmentPayer: Payer::sender,
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
    $connector = new EuShipmentsConnector;

    $connector->withMockClient(new MockClient([
        PrintRequest::class => MockResponse::fixture('shipment/print_success'),
    ]));

    $response = $connector->send(
        new PrintRequest(
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
    $connector = new EuShipmentsConnector;

    $connector->withMockClient(new MockClient([
        ShipmentHistoryRequest::class => MockResponse::fixture('shipment/tracking_success'),
    ]));

    $response = $connector->send(
        new ShipmentHistoryRequest(
            '520000014358140060945092',
            testMode: false,
        )
    );

    expect($response->status())
        ->toBe(200);
});
