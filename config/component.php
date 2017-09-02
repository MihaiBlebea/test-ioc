<?php

return [
    "components" => [

        "ConfigManager" => "Framework\Injectables\ConfigManagerComponent",
        "Whoops"        => "Framework\Injectables\WhoopsComponent",
        "Login"         => "Framework\Injectables\LoginComponent",
        "Connector"     => "Framework\Injectables\ConnectorComponent",

        "House"         => "TestIoc\Components\HouseComponent",
        "Router"        => "Framework\Injectables\RouterComponent"

    ],

    "facades" => [

        "LoginC" => "Framework\Facades\LoginFacade",
        
    ]
];
