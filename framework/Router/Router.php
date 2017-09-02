<?php

namespace Framework\Router;

use Framework\Router\GateKeeper;
use Framework\Router\Request;

class Router
{
    const DEFAULT_CONTROLLER = "Index";
    const DEFAULT_ACTION     = "index";

    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $request       = null;

    public function __construct(array $options = array())
    {
        if (empty($options))
        {
           $this->parseUri();
        }
        else {
            $this->goTo($options);
        }
    }

    private function goTo(array $options = array())
    {
        if (isset($options["controller"]))
        {
            $this->setController($options["controller"]);
        }
        if (isset($options["action"]))
        {
            $this->setAction($options["action"]);
        }
        if (isset($options["params"]))
        {
            $this->setParams($options["params"]);
        }
    }

    protected function parseUri()
    {
        $path = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $path = ltrim(substr($_SERVER['REQUEST_URI'], strlen($path) - 1), '/');

        $this->request = new Request;
        $path = $this->request->checkMethod($path);

        @list($controller, $action, $params) = explode("/", $path, 3);

        if (isset($controller) && $controller !== "")
        {
            $this->setController($controller);
        } else {
            $this->setController($this->controller);
        }

        if (isset($action))
        {
            $this->setAction($action);
        } else {
            $this->setAction($this->action);
        }

        if (isset($params))
        {
            $this->setParams(explode("/", $params));
        }
    }

    public function setController($controller)
    {
        if($controller !== "" || $controller !== null)
        {
            $controller = 'TestIoc\Controllers\\' . ucfirst(strtolower($controller)) . "Controller";
            if (class_exists($controller))
            {
                $this->controller = $controller;
            } else {
                $this->controller = 'TestIoc\Controllers\\' . self::DEFAULT_CONTROLLER . "Controller";
            }
        }
        return $this;
    }

    public function setAction($action)
    {
        $action = $this->isCamelCase($action);

        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action))
        {
            $action = self::DEFAULT_ACTION;
        }
        $this->action = $action;
        return $this;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    public function isCamelCase($action)
    {
        if(strpos($action, "-") == true)
        {
            $camelCaseAction = "";
            $actions = explode("-", $action);
            foreach($actions as $index => $item)
            {
                if($index < 1)
                {
                    $camelCaseAction .= $item;
                } elseif ($index > 0) {
                    $camelCaseAction .= ucfirst($item);
                }
            }
            return $camelCaseAction;
        } else {
            return $action;
        }
    }

    public function run()
    {
        GateKeeper::check($this->controller, $this->params);

        array_push($this->params, $this->request);
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }
}
