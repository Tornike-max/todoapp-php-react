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

        if (!$todos->getTodosModel()) {
            http_response_code(404);
            throw new Exception('404 Error Message! Not Found!: There Are No Todos');
        }

        $data = $todos->getTodosModel();
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function gettodo()
    {
        $id = Application::$app->request->getRequestId();
        $todo = new TodoModel();
        $data = $todo->getSingleTodo($id) ?? 0;

        if ($data === 0) {
            http_response_code(404);
            throw new Exception('404 Error Message! Not Found!: There Are No Todos');
        }

        echo '<pre>';
        var_dump($data);
        echo '</pre>';

        return $data;
    }
}
