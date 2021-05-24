<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

/**
 * Class User
 * @package app\models
 */
class User extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'user';

    public array $errors = [];

    /**
     * @return bool
     */
    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        parent::save();
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function update($id)
    {
        parent::update($id);
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        parent::delete($id);
        return true;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        $user = $this->findOne(['id' => Application::$app->session->get('user')]);
        return $user->role === 'admin';
    }

    /**
     * @param $id
     * @return bool
     */
    public function isOwner($id): bool
    {
        $user = $this->findOne(['id' => Application::$app->session->get('user')]);
        return $user->id === $id;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        $user = $this->findOne(['id' => Application::$app->session->get('user')]);
        return $user->username;
    }

    public function getId()
    {
        $user = $this->findOne(['id' => Application::$app->session->get('user')]);
        return $user->id;
    }


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
        return ['username', 'email', 'password', 'role'];
    }

    /**
     * @return array|array[]
     */
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