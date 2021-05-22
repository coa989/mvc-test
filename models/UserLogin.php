<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

/**
 * Class UserLogin
 * @package app\models
 */
class UserLogin extends Model
{
    public string $email = '';
    public string $password = '';

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'users';
    }

    /**
     * @return array|string[]
     */
    public function attributes(): array
    {
        return ['email', 'password'];
    }

    /**
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_NOT_FOUND],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    /**
     * @return bool
     */
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