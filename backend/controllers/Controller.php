<?php

namespace app\controllers;

use app\core\Application;
use app\models\TodoModel;
use Exception;

class Controller
{
    public function login()
    {
        echo 'login';
    }

    public function register()
    {
        echo 'register';
    }

    public function addTodo()
    {

        $data = Application::$app->request->getData();
        error_log(print_r($data, true));
        foreach ($data as $value) {
            if (!isset($value)) {
                throw new Exception('No Data Provided!');
                return;
            }
        };



        $todo = new TodoModel();
        $todo->addToDo($data);
    }

    public function getTodo()
    {
        echo 'get';
    }
}
