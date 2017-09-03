<?php

namespace TestIoc\Emails;

use Framework\Interfaces\EmailInterface;
use Framework\Injectables\Injector;

class HelloEmail implements EmailInterface
{
    public function send()
    {
        $email = Injector::resolve("Email");
        $email->subject("Hello");
        $email->htmlBody("How are you?");
        $email->setAddress("mihaiserban.blebea@gmail.com");
        $email->send();
    }
}
