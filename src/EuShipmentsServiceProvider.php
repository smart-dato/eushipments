<?php

namespace SmartDato\EuShipments;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class EuShipmentsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('eushipments')
            ->hasConfigFile();
    }
}
