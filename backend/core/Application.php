<?php

namespace app\core;

error_reporting(E_ALL);
ini_set('display_errors', 1);

use app\models\DbModel;

class Application
{
    public Request $request;
    public Router $router;
    public static Application $app;
    public DbModel $db;
    public Session $session;
    public $user;

    public function __construct()
    {
        self::$app = $this;
        $this->session = new Session();
        $this->db = new DbModel();
        $this->request = new Request(strtolower($_SERVER['REQUEST_METHOD']), $_SERVER['REQUEST_URI']);
        $this->router = new Router($this->request->getMethod(), $this->request);
    }
}
