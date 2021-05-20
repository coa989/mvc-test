<?php


namespace app\core;


abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_NOT_FOUND = 'not found';
    public const RULE_MIN = 'min';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_INCORRECT = 'incorrect';
    public const RULE_VALID_ROLE = 'role';

    public array $errors = [];

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function rules(): array;

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    // TODO iskomentarisi metodu
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


    protected function addError($attribute, $rule, $params = [])
    {

        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    protected function errorMessages()
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

    public function hasError($attribute)
    {
        return !empty($this->errors[$attribute]);
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0];
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