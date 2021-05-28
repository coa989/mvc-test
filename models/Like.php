<?php

namespace app\models;

use app\core\Model;

/**
 * Class Like
 * @package app\models
 */
class Like extends Model
{
    public string $post_id = '';
    public string $user_id = '';

    /**
     * @return bool
     */
    public function save()
    {
        parent::save();
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
     * @param $postId
     * @return int
     */
    public function count($postId)
    {
        return count($this->find(['post_id' => $postId]));
    }

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'likes';
    }

    /**
     * @return array|string[]
     */
    public function attributes(): array
    {
        return ['post_id', 'user_id'];
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}