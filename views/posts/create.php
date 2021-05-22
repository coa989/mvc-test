<?php
/** @var $this \app\core\View */
$this->title = 'Create Post';
?>
<h1>Create Post</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control">
        <span class="invalid-feedback"></span>
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea type="text" name="body" class="form-control"></textarea>
        <span class="invalid-feedback"></span>
    </div>
    <input type="hidden" name="user_id" value="<?= $user = (new \app\models\User())->getId() ?>">
    <button type="submit" class="btn btn-primary mt-2">Create</button>
</form>