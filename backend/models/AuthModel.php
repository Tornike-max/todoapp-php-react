<?php

namespace app\models;

use app\core\Application;
use app\core\exceptions\UserExistException;
use Exception;


class AuthModel extends DbModel
{
    private $data;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function registerUser($data)
    {
        try {
            $hashedPwd = Application::$app->request->getHash();
            $pdo = $this->connect();

            $stmt = $pdo->prepare('select * from users where email = :email');
            $stmt->bindValue(':email', $data['email']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                http_response_code(409);
                throw new UserExistException();
                exit;
            }

            $stmt = $pdo->prepare('insert into users (firstname, lastname, email, password) 
                       values (:firstname, :lastname, :email, :password)');

            $stmt->bindValue(':firstname', $data['firstname']);
            $stmt->bindValue(':lastname', $data['lastname']);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':password', $hashedPwd);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 'Data inserted successfully!';
            } else {
                echo 'No data inserted';
            }

            echo '<pre>';
            var_dump($data);
            echo '</pre>';
        } catch (\Exception $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }

    public function loginUser($data)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $pdo = $this->connect();
            $stmt = $pdo->prepare('select * from users where email = :email');
            $stmt->bindValue(':email', $data['email']);

            if ($stmt->execute()) {
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            } else {
                $stmt = null;
                exit;
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                exit;
            }

            $hashedPwd = $user['password'];
            $pwd = $data['password'];

            if (password_verify($pwd, $hashedPwd)) {
                Application::$app->session->set('id', $user['users_id']);
                Application::$app->session->set('email', $user['email']);
                Application::$app->session->set('firstname', $user['firstname']);
                Application::$app->session->set('lastname', $user['lastname']);
                $stmt = $pdo->prepare('select users_id,firstname,lastname,email from users where password = :pwd');
                $stmt->bindValue(':pwd', $hashedPwd);
                $stmt->execute();
                $responseData = $stmt->fetch(\PDO::FETCH_ASSOC);
                header('Content-Type: application/json');
                echo json_encode(['message' => 'user login successfully', 'response' => $responseData]);
            } else {
                http_response_code(401);
                echo json_encode(['message' => 'Invalid credentials']);
                return;
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public function getAuthUser($userId)
    {
        try {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $pdo = $this->connect();

            if ($userId) {
                $stmt = $pdo->prepare('select users_id,email,firstname,lastname from users where users_id = :id');
                $stmt->bindValue(':id', $userId);

                $stmt->execute();
                $user = $stmt->fetch(\PDO::FETCH_ASSOC);

                if (empty($user)) {
                    http_response_code(401);
                    throw new Exception('Unauthorized!');
                }

                return $user;
            }
            return null;
        } catch (\Exception $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }

    public function getAuthUsers()
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare('select users_id,email,firstname,lastname from users');
            $stmt->execute();
            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (empty($users)) {
                throw new \PDOException('There are zero users in db');
            }

            return $users;
        } catch (\Exception $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }
}
