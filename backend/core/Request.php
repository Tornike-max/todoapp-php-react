<?php


namespace app\core;


class Request
{
    public string $requestMethod;
    public string $path;
    public $uri;
    public string | int $requestedId;

    public function __construct($method, $uri)
    {
        $this->uri = $uri;
        $parts = explode('=', $this->uri);
        $this->requestedId = end($parts);

        if ($method === 'post') {
            $this->requestMethod = 'post';
        }

        if ($method === 'get') {
            $this->requestMethod = 'get';
        }
    }

    public function getMethod(): string
    {
        return $this->requestMethod;
    }

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function getData()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Error decoding JSON: " . json_last_error_msg());
        }

        return $data;
    }


    public function getRequestId()
    {
        return (int) $this->requestedId;
    }
}
