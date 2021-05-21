<?php


namespace app\models;


use app\core\Application;
use app\core\Model;

class User extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'user';

    public array $errors = [];

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        parent::save();
        return true;
    }

    public function update($id)
    {
        parent::update($id);
        return true;
    }

    public function delete($id)
    {
        parent::delete($id);
        return true;
    }

    public function isAdmin()
    {
        $user = parent::findOne(['id' => Application::$app->session->get('user')]);
        return $user->role === 'admin';
    }

    public function getDisplayName()
    {
        $user = parent::findOne(['id' => Application::$app->session->get('user')]);
        return $user->username;
    }


    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password', 'role'];
    }

    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'role' => [self::RULE_REQUIRED, self::RULE_VALID_ROLE]
        ];
    }


    // TODO poboljsaj validaciju ponavlja se dosta koda

//
//    public function validateCreate()
//    {
//        if (empty($this->role)) {
//            $this->errors['role'] = 'Please enter role (user or admin)';
//        } elseif ($this->role != 'user' && $this->role != 'admin') {
//            $this->errors['role'] = 'Please enter valid role (user od admin)';
//        }
//
//        if (empty($this->username)) {
//            $this->errors['username'] = 'Please enter username';
//        }
//
//        if (empty($this->email)) {
//            $this->errors['email'] = 'Please enter email';
//        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
//            $this->errors['email'] = 'Please use valid email address';
//        } elseif (parent::findOne(['email' => $this->email])) {
//            $this->errors['email'] = 'Email address already used';
//        }
//
//        if (empty($this->password)) {
//            $this->errors['password'] = 'Please enter password';
//        } elseif (strlen($this->password) < 8) {
//            $this->errors['password'] = 'Password must be minimum 8 characters long';
//        }
//
//        if (empty($this->errors)) {
//            return true;
//        }
//
//        return false;
//    }
//
//    public function validateUpdate()
//    {
//        if (empty($this->role)) {
//            $this->errors['role'] = 'Please enter role (user or admin)';
//        } elseif ($this->role != 'user' && $this->role != 'admin') {
//            $this->errors['role'] = 'Please enter valid role (user od admin)';
//        }
//
//        if (empty($this->username)) {
//            $this->errors['username'] = 'Please enter username';
//        }
//
//        if (empty($this->email)) {
//            $this->errors['email'] = 'Please enter email';
//        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
//            $this->errors['email'] = 'Please use valid email address';
//        }
//
//        if (empty($this->errors)) {
//            return true;
//        }
//
//        return false;
//    }

}