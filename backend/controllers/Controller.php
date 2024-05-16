<?php

namespace app\controllers;

use app\core\Application;
use app\models\TodoModel;
use Exception;

class Controller
{
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


        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function update()
    {
        $id = Application::$app->request->getRequestId();
        $data = Application::$app->request->getData();

        foreach ($data as $value) {
            if (!isset($value)) {
                throw new Exception('No Data Provided!');
                return;
            }
        };

        $todo = new TodoModel();
        $todo->updateTodo($data, $id);
    }

    public function delete()
    {
        $id = Application::$app->request->getRequestId();

        if (!isset($id)) {
            throw new Exception("Todo with this id:$id, does not exist");
        }
        $delete = new TodoModel();
        $delete->deleteTodo($id);
    }
}
