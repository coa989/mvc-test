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

}