<?php
/**
 * @var $this \app\core\View
 * @var $posts \app\models\Post
 * @var $users \app\models\User
 */

$this->title = 'Posts';
?>
<div class="container">
    <a href="posts/create"><button class="btn btn-success">Create Post</button></a>
    <?php foreach ($posts as $post) :
        if ($post->approved):?>
        <h2><?= $post->title ?></a></h2>
        <h5><?= $post->body ?></h5>
        <a href="/posts/show?id=<?= $post->id ?>"><button class="btn btn-secondary">Read More</button></a>
        <p><?= \Carbon\Carbon::createFromTimestamp(strtotime($post->created_at))->diffForHumans(); ?></p>
        <?php endif; ?>
   <?php endforeach; ?>
</div>