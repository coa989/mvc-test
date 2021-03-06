<?php

namespace app\models;

use app\core\Model;

/**
 * Class UserRegister
 * @package app\models
 */
class UserRegister extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';

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
        return ['username', 'email', 'password'];
    }

    /**
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_UNIQUE],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    /**
     * @return bool
     */
    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->save();
        return true;
    }
}