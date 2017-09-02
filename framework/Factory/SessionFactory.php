<?php

namespace Framework\Factory;

class SessionFactory
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function build($type = "")
    {
        if($type == "")
        {
            throw new \Exception('No session type supplied');
        } else {
            $className = $this->path . ucfirst($type) . "Session";

            if(class_exists($className))
            {
                return new $className();
            } else {
                throw new \Exception('Session class not found.');
            }
        }
    }
}
