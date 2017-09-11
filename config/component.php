<?php

return [
    "components" => [

        "Config"    => "Framework\Injectables\ConfigComponent",
        "PreviousPathSession" => "Framework\Injectables\PreviousPathSessionComponent",
        "Request"   => "Framework\Injectables\RequestComponent",
        "Template"  => "Framework\Injectables\TemplateComponent",
        "Whoops"    => "Framework\Injectables\WhoopsComponent",
        "Login"     => "Framework\Injectables\LoginComponent",
        "Connector" => "Framework\Injectables\ConnectorComponent",
        "Email"     => "Framework\Injectables\EmailComponent",

        "House"     => "TestIoc\Components\HouseComponent",
        "Router"    => "Framework\Injectables\RouterComponent"

    ],

    "alias" => [

        "Request"  => Framework\Router\Request::class,
        "Router"   => Framework\Router\Router::class,
        "Template" => Framework\Templates\TemplateEngine::class,

    ]
];
