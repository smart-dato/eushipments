# EuShipments Laravel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smart-dato/eushipments.svg?style=flat-square)](https://packagist.org/packages/smart-dato/eushipments)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/eushipments/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smart-dato/eushipments/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/eushipments/code-style.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smart-dato/eushipments/actions?query=workflow%3A%22Code+style%22+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/smart-dato/eushipments.svg?style=flat-square)](https://packagist.org/packages/smart-dato/eushipments)

This is our EuShipments Laravel SDK. API documentation can be found [here](https://documenter.getpostman.com/view/26992907/2s93Y2S2Q8) 

## Installation

You can install the package via composer:

```bash
composer require smart-dato/eushipments
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="eushipments-config"
```

```dotenv
EUSHIPMENTS_BASE_URL=https://test-api.inout.bg/api/v1/
EUSHIPMENTS_TOKEN=your-api-token
```

The test environment is `https://test-api.inout.bg/api/v1/`; production is `https://api1.inout.bg/api/v1/`.

## Usage

```php
use SmartDato\EuShipments\Data\AddressData;
use SmartDato\EuShipments\Data\AirWaybillData;
use SmartDato\EuShipments\Data\ShipmentData;
use SmartDato\EuShipments\Enums\Payer;
use SmartDato\EuShipments\Enums\Service;
use SmartDato\EuShipments\EuShipmentsConnector;
use SmartDato\EuShipments\Requests\Shipment\CreateShipmentRequest;

$connector = new EuShipmentsConnector();

$response = $connector->send(new CreateShipmentRequest(new ShipmentData(
    senderId: 1234,
    courierId: 999,
    waybillAvailableDate: now(),
    serviceName: Service::crossborder,
    recipient: new AddressData(
        name: 'Jane Doe',
        countryIsoCode: 'PL',
        streetName: 'ul. Przykladowa 1',
        buildingNumber: '1',
        addressText: 'ul. Przykladowa 1',
        phoneNumber: '000000000',
        cityName: 'Warszawa',
        zipCode: '00-001',
        contactPerson: 'Jane Doe',
        email: 'jane@example.com',
    ),
    awb: new AirWaybillData(
        parcels: 1,
        envelopes: 0,
        totalWeight: 0.7,
        openPackage: false,
        saturdayDelivery: false,
        referenceNumber: 'order-1001',
        products: 'Clothes',
        bankRepayment: 0,
        shipmentPayer: Payer::sender,
        declaredValue: 0,
        otherRepayment: null,
        observations: null,
        fragile: true,
        productsInfo: 'Clothes',
        piecesInPack: 1,
    ),
)));
```

`senderId` and `courierId` are the IDs from your EuShipments account.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [SmartDato](https://github.com/smart-dato)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
