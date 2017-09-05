<?php

namespace Framework\Router;

class Router
{
    private $request;

    private $getRoutes     = array();

    private $postRoutes    = array();

    private $dinamicParams = array();

    private $options       = array();

    private $lastRoute;

    private $lastMethod;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $controller)
    {
        $this->lastMethod = "GET";
        $this->lastRoute = $path;
        $this->getRoutes[$path]["controller"] = $controller;
        return $this;
    }

    public function post($path, $controller)
    {
        $this->lastMethod = "POST";
        $this->lastRoute = $path;
        $this->postRoutes[$path]["controller"] = $controller;
        return $this;
    }

    public function as($name)
    {
        if($this->lastMethod == "GET")
        {
            $this->getRoutes[$this->lastRoute]["name"] = $name;
        } elseif($this->lastMethod == "POST") {
            $this->postRoutes[$this->lastRoute]["name"] = $name;
        }
        return $this;
    }

    public function bind(array $binds)
    {
        if($this->lastMethod == "GET")
        {
            $this->getRoutes[$this->lastRoute]["binds"] = $binds;
        } elseif($this->lastMethod == "POST") {
            $this->postRoutes[$this->lastRoute]["binds"] = $binds;
        }
        return $this;
    }

    public function rules(array $rules)
    {
        if($this->lastMethod == "GET")
        {
            $this->getRoutes[$this->lastRoute]["rules"] = $rules;
        } elseif($this->lastMethod == "POST") {
            $this->postRoutes[$this->lastRoute]["rules"] = $rules;
        }
        return $this;
    }

    public function splitRoute($route)
    {
        return explode("/", $route);
    }

    public function compare()
    {
        if($this->request->getMethod() == "GET")
        {
            $localArray = $this->getRoutes;
        } elseif ($this->request->getMethod() == "POST") {
            $localArray = $this->postRoutes;
        } else {
            throw new Exception("Error Processing Routes Method", 1);
        }

        if($this->compareArrays($localArray) !== true)
        {
            if($this->compareStrings($localArray) !== true)
            {
                $this->callNotFound();
            } else {
                $this->callFoundInString();
            }
        } else {
            $this->callFoundInArray();
        }
    }

    public function compareArrays($localArray)
    {
        foreach($localArray as $key => $options)
        {
            $local    = $this->splitRoute($key);
            $incoming = $this->request->getArray();

            if(count($local) == count($incoming))
            {
                for($i = 0; $i < count($local); $i++)
                {
                    if($local[$i] !== $incoming[$i])
                    {
                        if(strpos($local[$i], ':') !== false)
                        {
                            $j = ltrim($local[$i], ':');
                            $this->dinamicParams[$j] = $incoming[$i];
                        } else {
                            continue 2;
                        }
                    }
                }
                $this->options = $options;
                return true;
                break;
            }
        }
    }

    public function compareStrings($localArray)
    {
        foreach($localArray as $key => $options)
        {
            if($key == $this->request->getTrimmedUrl())
            {
                $this->options = $options;
                return true;
            }
        }
    }

    public function callNotFound()
    {
        dd("404");
    }

    public function callFoundInArray()
    {
        //dd("found with arrays");
        $this->callMethod($this->request, $this->options);
    }

    public function callFoundInString()
    {
        //dd("found with strings");
        $this->callMethod($this->request, $this->options);
    }

    public function callMethod(Request $request, $options)
    {
        dd($options);

         $namespace = '\InstaRouter\Controllers\\' . $route['class'];
         $class = new $namespace();

         call_user_func(array($class, $route['function']), array($route['request'], $this->dynamicParams));
    }
}
