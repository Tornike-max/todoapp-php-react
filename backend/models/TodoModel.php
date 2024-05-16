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

    public function updateTodo($data, $id)
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare('update todos set
                                   variant = :variant, 
                                   model = :model, 
                                   year = :year,
                                   car_engine = :car_engine where todoId = :id');
            $stmt->bindValue(':variant', $data['variant']);
            $stmt->bindValue(":model", $data['model']);
            $stmt->bindValue(":year", $data['year']);
            $stmt->bindValue(":car_engine", $data['car_engine']);
            $stmt->bindValue(":id", $id);

            echo '<pre>';
            var_dump($data);
            echo '</pre>';

            $response = [];
            if ($stmt->execute()) {
                $response[] = ['message' => 'Status Code:200 ok! - Todo Updated Successfully'];
            } else {
                $response[] = ['message' => '400 Bad Request: - Something went wrong!'];
            }
            return $response;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteTodo($id)
    {
        if (!isset($id)) {
            throw new \Exception("Todo with this id:$id, does not exist");
        }

        $pdo = $this->connect();
        $stmt = $pdo->prepare('delete from todos where todoId = :id');
        $stmt->bindValue(':id', $id);

        $response = [];
        if ($stmt->execute()) {
            $response[] = ['message' => 'Status Code:200 ok! - Todo Deleted Successfully'];
        } else {
            $response[] = ['message' => '400 Bad Request: - Something went wrong!'];
        }
        echo '<pre>';
        var_dump($response);
        echo '</pre>';

        return $response;
    }
}
