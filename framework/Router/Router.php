<?php

namespace Framework\Router;

use Framework\Sessions\PreviousPathSession;
use Framework\Router\GateKeeper;
use Framework\Router\Binder;
use Framework\Configs\Config;

class Router
{
    private $request;

    private $session;

    private $getRoutes        = array();

    private $postRoutes       = array();

    private $dinamicParams    = array();

    private $options          = array();

    private $lastRoute;

    private $lastMethod;

    private $hasDinamicParams = false;

    public function __construct(Request $request, PreviousPathSession $session, Config $config)
    {
        $this->request = $request;
        $this->session = $session;
        $this->config  = $config;
        $session->setContent($request->getTrimmedUrl());
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

    private function checkMethod($data, $key)
    {
        if($this->lastMethod == "GET")
        {
            $this->getRoutes[$this->lastRoute][$key] = $data;
        } elseif($this->lastMethod == "POST") {
            $this->postRoutes[$this->lastRoute][$key] = $data;
        }
    }

    public function as($name = "")
    {
        if($name !== "")
        {
            $this->checkMethod($name, "name");
        }
        return $this;
    }

    public function bind(array $binds = [])
    {
        if($binds !== [])
        {
            $this->checkMethod($binds, "binds");
        }
        return $this;
    }

    public function rules(array $rules = [])
    {
        if($rules !== [])
        {
            $this->checkMethod($rules, "rules");
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
                            $id = ltrim($local[$i], ':');
                            $this->dinamicParams[$i] = ["id" => $id, "param" => $incoming[$i]];
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
        $this->hasDinamicParams = true;
        $this->beforeController($this->request, $this->options);
    }

    public function callFoundInString()
    {
        $this->beforeController($this->request, $this->options);
    }

    public function beforeController(Request $request, $options)
    {
        // Call Rules and see if they are valid
        if(isset($options["rules"]))
        {
            $rules = GateKeeper::call($options["rules"]);
        }

        if(isset($rules))
        {
            if($this->hasDinamicParams == true)
            {
                //Also check if the models were not found in the database
                $models = Binder::bind($this->dinamicParams, $options["binds"]);
                return $this->callController($models);
            }
        }
        return $this->callController();
    }

    public function callController($models = "")
    {
        $result = explode("@", $this->options["controller"]);
        $class = $result[0];
        $method = $result[1];
        $class = new $class();
        //dd(gettype($models[0]));
        call_user_func_array(array($class, $method), $models);
    }
}
