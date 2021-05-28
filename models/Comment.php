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
    // TODO move method to base model?
    /**
     * @return bool
     */
    public function approve()
    {
        $this->approved = filter_var($_GET['approved'], FILTER_VALIDATE_BOOL);
        parent::updateColumn(['id' => $_GET['id']], 'approved');
        return true;
    }

    /**
     * @param string $postId
     * @return int
     */
    public function countApproved(string $postId)
    {
        $comments = $this->find(['post_id' => $postId]);
        $count = 0;
        foreach ($comments as $comment) {
            if ($comment->approved) {
                $count++;
            }
        }
        return $count;
    }


}