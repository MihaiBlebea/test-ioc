<?php

return [
    "components" => [

        "Config"    => "Framework\Injectables\ConfigComponent",
        "Template"  => "Framework\Injectables\TemplateComponent",
        "Whoops"    => "Framework\Injectables\WhoopsComponent",
        "Login"     => "Framework\Injectables\LoginComponent",
        "Connector" => "Framework\Injectables\ConnectorComponent",
        "Email"     => "Framework\Injectables\EmailComponent",

        "House"     => "TestIoc\Components\HouseComponent",
        "Router"    => "Framework\Injectables\RouterComponent"

    ],

    "facades" => [

        "LoginC" => "Framework\Facades\LoginFacade",

    ]
];
