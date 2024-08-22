<?php

// config for SmartDato/EuShipments
return [
    // testing : https://test-api.inout.bg/api/v1/
    // prod    : https://api1.inout.bg/api/v1/
    'base_url' => env('EUSHIPMENTS_BASE_URL', 'https://test-api.inout.bg/api/v1/'),
    'token' => env('EUSHIPMENTS_TOKEN', ''),
];
