<?php

namespace app\controllers;

use app\core\Application;
use app\models\AuthModel;

class AuthController
{

    public function login()
    {
        echo 'login';
    }

    public function register()
    {
        $data = Application::$app->request->getData();

        foreach ($data as $value) {
            if (!isset($value)) {
                throw new \Exception('No Data Provided!');
                return;
            }
        };


        $auth = new AuthModel();
        $auth->registerUser($data);
    }
}
