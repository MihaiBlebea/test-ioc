<?php

namespace Framework\Payments;

use Framework\Interfaces\PaymentInterface;
use Framework\Injectables\Injector;
use Braintree\Configuration;
use Braintree\ClientToken;
use Braintree\Transaction;
use Braintree\Customer;
use Braintree\Subscription;

class BraintreePayment implements PaymentInterface
{
    public $name = "Braintree";

    private $config;

    public function __construct()
    {
        $this->config = Injector::resolve("Config");
        $config = $this->config->getConfig("payment");

        Configuration::environment($config['Braintree']['environment']);
        Configuration::merchantId($config['Braintree']['merchantId']);
        Configuration::publicKey($config['Braintree']['publicKey']);
        Configuration::privateKey($config['Braintree']['privateKey']);
    }

    public function generateToken()
    {
        return ClientToken::generate();
    }

    public function simplePay(array $payload)
    {
        $result = Transaction::sale([
            'amount'             => $payload["price"],
            'paymentMethodNonce' => $payload["paymentNonce"],
            'options'            => ['submitForSettlement' => true],
            'customer'           => [
                'firstName' => $payload["firstName"],
                'lastName'  => $payload["lastName"],
                'phone'     => $payload["phone"],
                'email'     => $payload["email"]
            ]
        ]);

        if($result->success)
        {
            return $result->transaction->id;
        } else {
            throw new Exception("Simple payment could not be processed", 1);
        }
    }

    public function recursivePay(array $payload)
    {
        $payment_token = $this->createCustomer($payload);

        $result = Subscription::create([
            'paymentMethodToken' => $payment_token,
            'planId'             => $payload["productId"],
            'merchantAccountId'  => $this->config->getConfig("payment")['braintree']['merchantAccountId']
        ]);

        if($result->success)
        {
            return $result->subscription->transactions[0]->id;
        } else {
            throw new Exception("Recursive payment could not be processed", 1);
        }
    }

    public function createCustomer(array $payload)
    {
        $customer = Customer::create([
            'customFields'       => ['username' => $payload["username"],
                                     'plan_tag' => $payload["productId"]
                                    ],
            'firstName'          => $payload["firstName"],
            'lastName'           => $payload["lastName"],
            'phone'              => $payload["phone"],
            'email'              => $payload["email"],
            'paymentMethodNonce' => $payload["paymentNonce"]
        ]);

        if ($customer->success)
        {
            return $customer->customer->paymentMethods[0]->token;
        } else {
            $message = "";
            foreach($customer->errors->deepAll() AS $error)
            {
                $message .= $error->code . ": " . $error->message . "\n";
            }
            throw new Exception("Customer could not be created: " . $message, 1);
        }
    }
}
