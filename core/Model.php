<?php

namespace app\core;

abstract class Model
{
    protected const RULE_REQUIRED = 'required';
    protected const RULE_EMAIL = 'email';
    protected const RULE_NOT_FOUND = 'not found';
    protected const RULE_MIN = 'min';
    protected const RULE_MATCH = 'match';
    protected const RULE_UNIQUE = 'unique';
    protected const RULE_INCORRECT = 'incorrect';
    protected const RULE_VALID_ROLE = 'role';

    private array $errors = [];

    /**
     * @return string
     */
    abstract public function tableName(): string;

    /**
     * @return array
     */
    abstract public function attributes(): array;

    /**
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @param $data
     */
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return bool
     */
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && (strlen($value) < $rule['min'])) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
                if ($ruleName === self::RULE_UNIQUE && self::findOne([$attribute => $value])) {
                    $this->addError($attribute, self::RULE_UNIQUE);
                }
                if ($ruleName === self::RULE_NOT_FOUND && empty(self::findOne([$attribute => $value]))) {
                    $this->addError($attribute, self::RULE_NOT_FOUND);
                }
                if ($ruleName === self::RULE_VALID_ROLE && ($value != 'user' && $value != 'admin')) {
                    $this->addError($attribute, self::RULE_VALID_ROLE);
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * @param $attribute
     * @param $rule
     * @param array $params
     */
    protected function addError($attribute, $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    /**
     * @return string[]
     */
    private function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email',
            self::RULE_MIN => 'Minimum length of this field must be {min}',
            self::RULE_MATCH => 'This field must be the same as the {match}',
            self::RULE_UNIQUE => 'Record with this field already exists',
            self::RULE_NOT_FOUND => 'Record not found',
            self::RULE_INCORRECT => 'Incorrect',
            self::RULE_VALID_ROLE => 'Please enter valid role'
        ];
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function hasError($attribute)
    {
        return !empty($this->errors[$attribute]);
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0];
    }

    /**
     * @return bool
     */
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

    /**
     * @param int $id
     * @return bool
     */
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

    /**
     * @param $where
     * @param $column
     * @return bool
     */
    public function updateColumn(array $where, string $column)
    {
        $tableName = $this->tableName();
        $statement = self::prepare("UPDATE $tableName SET $column=:$column WHERE id=:id");
        $statement->bindValue(":id", $where['id']);
        $statement->bindValue(":$column", $this->{$column});
        $statement->execute();

        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $tableName = $this->tableName();
        $statement = self::prepare("DELETE FROM $tableName WHERE id=:id");
        $statement->bindValue(':id', $id);
        $statement->execute();
        return true;
    }
    // TODO findOne and find make one method
    /**
     * @param array $where
     * @return mixed
     */
    public function findOne(array $where)
    {
        $tableName = $this->tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = $this->prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();

        return $statement->fetchObject();
    }

    /**
     * @param array $where
     * @return array
     */
    public function find(array $where)
    {
        $tableName = $this->tableName();
        $attributes = array_keys($where);
        $sql = implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $tableName = $this->tableName();
        $statement = $this->prepare("SELECT * FROM $tableName ORDER BY created_at DESC");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @param $sql
     * @return bool|\PDOStatement
     */
    private function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}