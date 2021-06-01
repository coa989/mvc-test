<?php

namespace app\models;

use app\core\Model;

/**
 * Class Post
 * @package app\models
 */
class Post extends Model
{
    public string $title = '';
    public string $body = '';
    public string $user_id = '';
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
    public function approve()
    {
        $this->approved = filter_var($_GET['approved'], FILTER_VALIDATE_BOOL);
        parent::updateColumn(['id' => $_GET['id']], 'approved');
        return true;
    }

    public function sortByDate( $post)
    {
        dd($post);
        foreach ($post as $key => $part) {
            $sort[$key] = strtotime($part['datetime']);
        }
        array_multisort($sort, SORT_DESC, $originalArray);
    }

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'posts';
    }

    /**
     * @return array|string[]
     */
    public function attributes(): array
    {
        return ['title', 'body', 'user_id', 'approved'];
    }

    /**
     * @return array|array[]
     */
    public function rules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'body' => [self::RULE_REQUIRED]
        ];
    }


}