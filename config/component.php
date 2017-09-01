<?php

return [
    "components" => [
        "Framework\Components\CarComponent",
        "Framework\Components\HouseComponent",
    ],

    "facades" => [
        "Car" => "Framework\Interfaces\CarComponent",
    ]
];
