<?php


namespace app\models;


use app\core\Model;

class Contact extends Model
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';

    public function save()
    {
        parent::save();
        return true;
    }

    public function tableName(): string
    {
        return 'contacts';
    }

    public function attributes(): array
    {
        return ['name', 'email', 'subject', 'message'];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'subject' => [self::RULE_REQUIRED],
            'message' => [self::RULE_REQUIRED],
        ];
    }
}