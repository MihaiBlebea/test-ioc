<?php

namespace Framework\Router;

class Request
{
    private $payload = array();

    public function checkMethod($path)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method === 'GET')
        {
            $payload = $this->get($method);
        } elseif($method === 'POST') {
            $payload = $this->post($method);
        }

        $this->payload = $payload;

        $path = $this->trimPath($path);
        return $path;
    }

    public function get($method)
    {
        $payload = $_GET;
        return $payload;
    }

    public function post($method)
    {
        $payload = $_POST;
        if(empty($payload))
        {
            $payload = file_get_contents('php://input');
            $payload = json_decode($payload);
        }
        return $payload;
    }

    public function trimPath($path)
    {
        return explode('?', $path)[0];
    }

    public function retrive($element)
    {
        if(array_key_exists($element, $this->payload))
        {
            return $this->payload[$element];
        }
    }

    public function retriveAll()
    {
        return $this->payload;
    }
}
