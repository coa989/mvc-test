<?php
/**
 * @var $this \app\core\View
 * @var $posts \app\models\Post
 * @var $users \app\models\User
 */
$this->title = 'Homepage';
?>
<div class="container">
    <a href="posts/create"><button class="btn btn-success">Create Post</button></a>
    <?php foreach ($posts as $post) :
        if ($post->approved):?>
        <h2><?= $post->title ?></h2>
        <h5><?= $post->body ?></h5>
            <p>Author: <a href="/profile?id=<?= ($users->findOne(['id' => $post->user_id])->id) ?>"><?= ($users->findOne(['id' => $post->user_id]))->username ?></a></p>
        <?php endif;
    endforeach; ?>
</div>