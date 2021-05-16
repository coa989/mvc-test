<?php


namespace app\core;


abstract class Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;
    }

    public function update(int $id)
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);

        $statement = self::prepare("UPDATE $tableName SET ".implode(',', $params)." WHERE id=:id");
        $statement->bindValue(':id', $id);
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;

    }

    public function delete($id)
    {
        $tableName = $this->tableName();
        $statement = self::prepare("DELETE FROM $tableName WHERE id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        return true;
    }


    public function findOne(array $where)
    {
        $tableName = $this->tableName();
        $attributes = array_keys($where);
        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = $this->prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();

        return $statement->fetchObject();
    }

    public function getAll()
    {
        $tableName = $this->tableName();
        $statement = $this->prepare("SELECT * FROM $tableName");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }



}