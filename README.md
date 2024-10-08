# EuShipments Laravel SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/smart-dato/eushipments.svg?style=flat-square)](https://packagist.org/packages/smart-dato/eushipments)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/eushipments/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/smart-dato/eushipments/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/smart-dato/eushipments/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/smart-dato/eushipments/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
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

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$connector = new SmartDato\EuShipments\EuShipmentsConnector();

$connector->withMockClient(new \Saloon\Http\Faking\MockClient([
    \SmartDato\EuShipments\Requests\Shipment\CreateShipmentRequest::class => \Saloon\Http\Faking\MockResponse::fixture('shipment.create.success'),
]));


$response = $connector->send(
    new \SmartDato\EuShipments\Requests\Shipment\CreateShipmentRequest(
        new \SmartDato\EuShipments\Data\ShipmentData(
            senderId: 1234,
            courierId: 999,
            waybillAvailableDate: now(),
            serviceName: \SmartDato\EuShipments\Enums\Service::crossborder,
            recipient: new \SmartDato\EuShipments\Data\AddressData(
                name: "Nikol Kubas",
                countryIsoCode: "PL",
                streetName: "Tomkowa 35A",
                buildingNumber: "35A",
                addressText: "Tomkowa 35A",
                phoneNumber: "664351156",
                cityName: "Tomkowa",
                zipCode: "58-140",
                contactPerson: "Nikol Kubas",
                email: "nikol.anna.kubas@onet.pl"
            ), awb: new \SmartDato\EuShipments\Data\AirWaybillData(
            parcels: 1,
            envelopes: 0,
            totalWeight: 0.7,
            openPackage: false,
            saturdayDelivery: false,
            referenceNumber: 'ex-123456789',
            products: "Clothes",
            bankRepayment: 0,
            shipmentPayer: \SmartDato\EuShipments\Enums\Payer::sender,
            declaredValue: 0,
            otherRepayment: null,
            observations: null,
            fragile: true,
            productsInfo: "Clothes",
            piecesInPack: 1
        )
    ))
);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [SmartDato](https://github.com/smart-dato)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
