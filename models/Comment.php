<?php


namespace app\models;


use app\core\Model;

/**
 * Class Comment
 * @package app\models
 */
class Comment extends Model
{
    public string $body = '';
    public string $user_id = '';
    public string $post_id = '';
    public bool $approved = false;

    /**
     * @return bool
     */
    public function save()
    {
        parent::save();
        return true;
    }

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'comments';
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return ['body', 'user_id', 'post_id', 'approved'];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'body' => [self::RULE_REQUIRED]
        ];
    }
}