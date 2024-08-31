<?php

class Request {
    private $method;
    private $uri;
    private $parameters = [];

    public function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];

        if ($this->method === 'POST') {
            $this->parameters = $_POST;
        } elseif ($this->method === 'GET') {
            $this->parameters = $_GET;
        }
    }

    public function getMethod() {
        return $this->method;
    }

    public function getUri() {
        return $this->uri;
    }

    public function input($key = null, $default = null) {
        if ($key === null) {
            return $this->parameters;
        }
        return $this->parameters[$key] ?? $default;
    }

    public function all() {
        return $this->parameters;
    }
}