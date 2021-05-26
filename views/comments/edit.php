<?php
/**
 * @var $comments \app\models\Comment
 * @var $this \app\core\View
 */
$this->title = 'Edit Comment';
?>
<div class="container">
    <form action="" method="post">
        <textarea name="body" class="form-control"><?= $comments->body ?></textarea>
        <input type="hidden" name="user_id" value="<?= $comments->user_id ?>">
        <input type="hidden" name="post_id" value="<?= $comments->post_id ?>">
        <button type="submit" class="btn btn-primary mt-1">Update</button>
    </form>
</div>
