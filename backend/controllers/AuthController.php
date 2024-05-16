<?php

namespace app\controllers;

use app\core\Application;
use app\models\AuthModel;
use Exception;

class AuthController
{

    public function login()
    {
        $data = Application::$app->request->checkInvalidData();
        $auth = new AuthModel();
        $data = $auth->loginUser($data);

        if (!$data) {
            http_response_code(404);
            throw new Exception("404 Error Message! Not Found!: Can't login");
        }

        Application::$app->session->setSession('user', $data);

        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public function register()
    {
        $data = Application::$app->request->checkInvalidData();
        $auth = new AuthModel();
        $auth->registerUser($data);
    }
}
