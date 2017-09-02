<?php

return [
    "components" => [
        "Car" => "TestIoc\Components\CarComponent",
        "House" => "TestIoc\Components\HouseComponent",
        "Whoops" => "Framework\Injectables\WhoopsComponent",
        "Login" => "Framework\Injectables\LoginComponent",

        "Router" => "Framework\Injectables\RouterComponent"
    ],

    "facades" => [
        "Car" => "Framework\Interfaces\CarComponent",
    ]
];
