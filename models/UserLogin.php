<?php


namespace app\models;


use app\core\Application;
use app\core\Model;

class UserLogin extends Model
{
    public string $email = '';
    public string $password = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['email', 'password'];
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_NOT_FOUND],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login()
    {
        $user = $this->findOne(['email' => $this->email]);
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', self::RULE_INCORRECT);
        } else {
            Application::$app->session->set('user', $user->id);
            return true;
        }
    }

}