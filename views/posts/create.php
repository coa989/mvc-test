<?php
/** @var $this \app\core\View
 *  @var $post \app\models\Post
 */
$this->title = 'Create Post';
?>
<h1>Create Post</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control <?= $post->hasError('title') ? 'is-invalid' : ''?>"
        value="<?= $post->title ?>">
        <span class="invalid-feedback"><?= $post->getFirstError('title') ?></span>
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea type="text" name="body" class="form-control <?= $post->hasError('body') ? 'is-invalid' : ''?>"><?= $post->body ?></textarea>
        <span class="invalid-feedback"><?= $post->getFirstError('body') ?></span>
    </div>
    <input type="hidden" name="user_id" value="<?= $user = (new \app\models\User())->getId() ?>">
    <button type="submit" class="btn btn-primary mt-2">Create</button>
</form>