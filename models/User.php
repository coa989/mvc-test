<?php

namespace app\models;

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
        echo 'saving new user';
    }
}