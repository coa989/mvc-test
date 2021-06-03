<?php
/**
 * @var $parentComment \app\models\Comment
 * @var $comment \app\models\Comment
 * @var $this \app\core\View
 * @var $users \app\models\User
 */
$this->title = 'Edit Comment';
?>
<div class="container">
    <p><?= $users->findOne(['id' => $parentComment->user_id])->username ?></p>
    <h4><?= $parentComment->body ?></h4>
</div>
<div class="container">
    <form action="" method="post">
        <textarea name="body" class="form-control"><?= $comment->body ?></textarea>
        <input type="hidden" name="user_id" value="<?= $users->getId() ?>">
        <input type="hidden" name="post_id" value="<?= $parentComment->post_id ?>">
        <input type="hidden" name="parent_id" value="<?= $parentComment->id ?>">
        <button type="submit" class="btn btn-primary mt-1">Reply</button>
    </form>
</div>