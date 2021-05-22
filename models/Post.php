<?php


namespace app\models;


use app\core\Model;

class Post extends Model
{
    public string $title = '';
    public string $body = '';
    public string $user_id = '';

    public function save()
    {
        parent::save();
        return true;
    }

    public function tableName(): string
    {
        return 'posts';
    }

    public function attributes(): array
    {
        return ['title', 'body', 'user_id'];
    }
    // TODO add rules for add post validation
    public function rules(): array
    {
        return [];
    }


}