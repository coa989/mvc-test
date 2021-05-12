<?php


namespace app\core;


abstract class Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

}