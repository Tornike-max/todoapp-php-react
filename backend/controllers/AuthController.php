<?php

namespace app\controllers;

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    }

    public function register()
    {
        $data = Application::$app->request->checkInvalidData();
        $auth = new AuthModel();
        $auth->registerUser($data);
    }

    public function getUser()
    {
        try {

            $user = new AuthModel();
            $userData = $user->getAuthUser();

            var_dump($userData);

            header('Content-Type: application/json');
            echo json_encode($userData);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public function getUsers()
    {
        try {
            $user = new AuthModel();
            if (!$user->getAuthUsers()) {
                http_response_code(404);
                throw new Exception('404 Error Message! Not Found!: There Are No User');
            }
            $userData = $user->getAuthUsers();
            header('Content-Type: application/json');

            echo json_encode($userData);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }
}
