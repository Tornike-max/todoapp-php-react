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
        $user = $auth->loginUser($data);
        if ($user) {
            Application::$app->session->set('user', $user);
        }
    }

    public function register()
    {
        $data = Application::$app->request->checkInvalidData();
        $auth = new AuthModel();
        $userResponse = $auth->registerUser($data);
        header('Content-Type: application/json');
        return json_encode($userResponse);
    }

    public function getUser()
    {
        try {

            $userId = Application::$app->request->getRequestId();
            if (!$userId) {
                http_response_code(401);
                echo json_encode(['message' => 'User not authenticated']);
                return;
            }
            $user = new AuthModel();
            $data = $user->getAuthUser($userId);
            header('Content-Type: application/json');
            echo json_encode($data);
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
