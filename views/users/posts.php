<?php
/**
 * @var $posts \app\models\Post
 * @var $this \app\core\View
 * @var $users \app\models\User
 */
$this->title = 'User Posts';
?>
<div class="container">
    <?php foreach ($posts as $post) :?>
        <h2>Title: <a href="/posts/show?id=<?= $post->id ?>"><?= $post->title ?></a></h2>
        <h5>Body: <?= $post->body ?></h5>
        <p>Approved: <?= $post->approved ? 'Yes' : 'No' ?></p>
        <p>Author: <a href="/users/show?id=<?= ($users->findOne(['id' => $post->user_id])->id) ?>"><?= ($users->findOne(['id' => $post->user_id]))->username ?></a></p>
    <?php endforeach; ?>
</div>

