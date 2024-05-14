<?php

namespace app\models;


class TodoModel extends DbModel
{
    public function addToDo($data)
    {
        try {
            $pdo = $this->connect();
            $stmt = $pdo->prepare('INSERT INTO todos (variant, model, year, car_engine) VALUES (:variant, :model, :year, :car_engine)');

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            };
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
}
