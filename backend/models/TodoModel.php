<?php

namespace app\models;


class TodoModel extends DbModel
{
    public function addToDo($data)
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare('INSERT INTO todos (variant, model, year, car_engine) VALUES (:variant, :model, :year, :car_engine)');

            echo '<pre>';
            var_dump($data);
            echo '</pre>';

            $stmt->bindValue(":variant", $data['variant']);
            $stmt->bindValue(":model", $data['model']);
            $stmt->bindValue(":year", $data['year']);
            $stmt->bindValue(":car_engine", $data['car_engine']);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo 'Data inserted successfully!';
            } else {
                echo 'No data inserted';
            }
        } catch (\Exception $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }

    public function getTodosModel()
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare('select * from todos');
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                throw new \PDOException('There are zero todos in db');
            }

            $todos = $stmt->fetchAll(\PDO::FETCH_ASSOC);


            return $todos;
        } catch (\PDOException $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }

    public function getSingleTodo($id)
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare('select * from todos where todoId = :todoId');
            $stmt->bindValue('todoId', $id);

            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                throw new \PDOException('404 Not Found! Todo not found');
            }

            $todo = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $todo;
        } catch (\PDOException $e) {
            echo $e->getCode() . ': ' . $e->getMessage();
        }
    }
}
