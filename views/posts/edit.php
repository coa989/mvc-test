<?php
/**
 * @var $posts \app\models\Post
 * @var $post \app\models\Post
 * @var $this \app\core\View
 */
$this->title = 'Edit Post'
?>
<h1>Edit Post</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control <?= $posts->hasError('title') ? 'is-invalid' : '' ?>" value="<?= $post->title ?>">
        <span class="invalid-feedback"><?= $posts->getFirstError('title') ?></span>
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea type="text" name="body" class="form-control <?= $posts->hasError('body') ? 'is-invalid' : '' ?>"><?= $post->body ?></textarea>
        <span class="invalid-feedback"><?= $posts->getFirstError('body') ?></span>
    </div>
    <input type="hidden" name="user_id" value="<?= $post->user_id ?>">
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>
