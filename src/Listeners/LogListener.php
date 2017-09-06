<?php

namespace TestIoc\Listeners;

use Framework\Events\Subject;
use Framework\Log\Logger;
use Framework\Interfaces\ListenerInterface;

class LogListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        //Do stuff
        dd([
            "payload"   => $subject->getPayload(),
            "send-date" => $subject->getSendDate(),
            "sender"    => $subject->getSender()
        ]);

        //Logger::log($subject->getPayload());
    }
}
