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


    public function validateRegister()
    {
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

    public function validateLogin()
    {
        $user = parent::findOne(['email' => $this->email]);

        if (!$user) {
            $this->errors['email'] = 'User not found';
        }

        if (!password_verify($this->password, $user->password)) {
            $this->errors['password'] = 'Password incorrect';
        }

        if (empty($this->errors)) {
            return $this->login($user);
        }

        return false;
    }


    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        parent::save();

        return true;

    }


    public function login($user)
    {
        session_start();

        $_SESSION['user'] = $user->id;

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