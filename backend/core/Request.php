<?php


namespace app\core;


class Request
{
    public string $requestMethod;
    public string $path;

    public function __construct($method)
    {
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
        $data = [];
        $methodData = $this->requestMethod === 'post' ? $_POST : $_GET;

        foreach ($methodData as $key => $value) {
            $data[$key] = $value ?? '';
        }

        return $data;
    }
}
