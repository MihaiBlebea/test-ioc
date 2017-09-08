<?php

namespace Framework\Listeners;

use Framework\Events\Subject;
use Framework\Log\Logger;
use Framework\Interfaces\ListenerInterface;

class LogErrorListener implements ListenerInterface
{
    public function listen(Subject $subject)
    {
        Logger::log($subject->getPayload());
    }
}
