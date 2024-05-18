<?php

namespace app\models;

use app\core\Application;
use app\core\exceptions\UserExistException;
use Exception;


class AuthModel extends DbModel
{
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
            $pdo = $this->connect();
            $stmt = $pdo->prepare('select password from users where email = :email');
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
            $email = $data['email'];
            $_SESSION['id'] = $data['users_id'];


            if (!password_verify($pwd, $hashedPwd)) {
                http_response_code(401);
                echo json_encode(['message' => 'Invalid credentials']);
                return;
            }

            $stmt = $pdo->prepare('select users_id,email,firstname,lastname from users where email = :email');
            $stmt->bindValue(':email', $email);

            if ($stmt->execute()) {
                $result = $stmt->fetch(\PDO::FETCH_ASSOC);
                $_SESSION['id'] = $result['users_id'];

                header('Content-Type: application/json');
                echo json_encode(['message' => 'User successfully logged in']);
            } else {
                $stmt = null;
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public function getAuthUser()
    {
        try {
            $id = $_SESSION['id'] || 8;
            $pdo = $this->connect();

            $stmt = $pdo->prepare('select users_id,email,firstname,lastname from users where users_id = :id');

            $stmt->bindValue(':id', $id);

            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);


            if (empty($user)) {
                http_response_code(401);
                throw new Exception('Unauthorized!');
            }
            return $user;
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
