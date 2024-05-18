<?php


namespace app\core;

error_reporting(E_ALL);
ini_set('display_errors', 1);


class Request
{
    public string $requestMethod;
    public string $path;
    public $uri;
    public string | int $requestedId;
    public string $hashedPassword;

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

    public function getHash()
    {
        $pwd = $this->getData()['password'];
        $this->hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

        if ($this->hashedPassword === false) {
            throw new \Exception("Error generating password hash");
        }

        return $this->hashedPassword;
    }

    public function checkInvalidData()
    {
        $data = $this->getData();

        foreach ($data as $value) {
            if (!isset($value)) {
                throw new \Exception('No Data Provided!');
                return;
            }
        };
        return $data;
    }


    public function getRequestId()
    {
        return (int) $this->requestedId;
    }


    public function checkAuth()
    {
        $session = Application::$app->session->getSession('user') ?? [];
        var_dump($session);
    }
}
