<?php

namespace app\models;

use app\core\Application;
use app\core\exceptions\UserExistException;

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

            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user) {
                return false;
            }

            $hashedPwd = $user['password'];
            $pwd = $data['password'];
            $email = $data['email'];

            if (password_verify($pwd, $hashedPwd)) {
                $stmt = $pdo->prepare('select * from users where email = :email and password = :password');
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':password', $hashedPwd);
                $stmt->execute();

                if ($stmt->rowCount() === 0) {
                    throw new \PDOException('No User Found');
                }

                $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                echo '<pre>';
                var_dump($user);
                echo '</pre>';

                return $user;
            }
        } catch (\Exception $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }

    public function getUsers()
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare('select * from users');

            if ($stmt->rowCount() === 0) {
                throw new \PDOException('There are zero users in db');
            }

            $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $users;
        } catch (\Exception $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }
}
