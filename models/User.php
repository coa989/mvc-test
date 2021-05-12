<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class User extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }


    public function validate()
    {
        $errors = [];

        if (empty($this->username)) {
            $this->errors['username'] = 'Please enter username';
        }

        if (empty($this->email)) {
            $this->errors['email'] = 'Please enter email';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Please use valid email address';
        }
        // todo implement unique email

        if (empty($this->password)) {
            $this->errors['password'] = 'Please enter password';
        } elseif (strlen($this->password) < 8) {
            $this->errors['password'] = 'Password must be minimum 8 characters long';
        }

        if (empty($this->confirmPassword)) {
            $this->errors['confirmPassword'] = 'Please repeat your password';
        } elseif ($this->password != $this->confirmPassword) {
            $this->errors['confirmPassword'] = 'Password do not match';
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;

    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);

        $statement = Application::$app->db->pdo->prepare("INSERT INTO $tableName (".implode(',', $attributes).") VALUES (".implode(',', $params).")");

        foreach ($attributes as $attribute) {

            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();

        return true;
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password'];
    }
}