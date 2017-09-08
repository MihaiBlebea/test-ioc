<?php

$instance->get("ceva/:id/:id", "TestIoc\\Controllers\\IndexController@index")->as("Serban")->bind(["User", "User"])->rules([
    "LoginRule"      => "TestIoc\\Rules\\AdminRule",
    "MembershipRule" => "TestIoc\\Rules\\MembershipRule"
]);

$instance->get("select", "TestIoc\\Controllers\\IndexController@select")->as("Serban")->rules([
]);
$instance->compare();
