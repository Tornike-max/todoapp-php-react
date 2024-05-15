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

        foreach ($data as $value) {
            if (!isset($value)) {
                throw new Exception('No Data Provided!');
                return;
            }
        };

        $todo = new TodoModel();
        $todo->addToDo($data);
    }

    public function getTodos()
    {
        $todos = new TodoModel();

        if (count($todos->getTodos()) === 0) {
            http_response_code(404);
            throw new Exception('404 Error Message! Not Found!: There Are No Todos');
        }

        $data = $todos->getTodos();

        echo '<pre>';
        var_dump($data);
        echo '</pre>';

        return $data;
    }

    public function getTodo()
    {
    }
}
