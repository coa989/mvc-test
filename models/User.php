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
        } elseif (parent::findOne(['email' => $this->email])) {
            $this->errors['email'] = 'Email address already used';
        }

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
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        parent::save();

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