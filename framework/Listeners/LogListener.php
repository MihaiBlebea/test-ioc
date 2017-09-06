<?php

namespace App\Listeners;

use Framework\Events\Subject;
use Framework\Log\Logger;
use Framework\Interfaces\ListenerInterface;

class LogListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        //Do stuff
        echo $subject->getPayload() . "<br />";
        echo $subject->getSendDate() . "<br />";
        echo $subject->getSender() . "<br />";

        //Logger::log($subject->getPayload());
    }
}
