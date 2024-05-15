<?php


namespace app\core;

use app\models\DbModel;

class Application
{
    public Request $request;
    public Router $router;
    public static Application $app;
    public DbModel $db;

    public function __construct()
    {
        self::$app = $this;
        $this->db = new DbModel();
        $this->request = new Request(strtolower($_SERVER['REQUEST_METHOD']), $_SERVER['REQUEST_URI']);
        $this->router = new Router($this->request->getMethod(), $this->request);
    }
}
