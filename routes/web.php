<?php

$this->get("ceva/:user/:program", "TestIoc\\Controllers\\IndexController@index")
     ->as("users")
     ->bind([
         "user"    => "User",
         "program" => "Program"
     ])
     ->rules([
         "LoginRule"      => "TestIoc\\Rules\\AdminRule",
         "MembershipRule" => "TestIoc\\Rules\\MembershipRule"
     ]);

$this->group(["name" => "sexy",
              "prefix" => "Cristina",
              "rules" => ["LoginRule" => "TestIoc\\Rules\\AdminRule"]
]);

$this->get("sex", "TestIoc\\Controllers\\IndexController@select")->as("serban")->belongsTo("sexy");

$this->get("select", "TestIoc\\Controllers\\IndexController@select")->as("serban");

$this->get("smarty", "TestIoc\\Controllers\\IndexController@smarty")->as("smarty");

$this->get("payment", "TestIoc\\Controllers\\IndexController@payment")->as("pay");

$this->get("request", "TestIoc\\Controllers\\IndexController@request")->as("request");
