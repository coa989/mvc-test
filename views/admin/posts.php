<?php
/** @var $posts \app\models\Post
 *  @var $users \app\models\User
 * @var $this \app\core\View
 */
$this->title = 'Posts'
?>
<div class="container">
    <?php foreach ($posts as $post) :?>
        <h2>Title: <a href="/posts/show?id=<?= $post->id ?>"><?= $post->title ?></a></h2>
        <h5>Body: <?= $post->body ?></h5>
        <p>Approved: <?= $post->approved ? 'Yes' : 'No' ?></p>
        <p>Author: <a href="/users/show?id=<?= ($users->findOne(['id' => $post->user_id])->id) ?>"><?= ($users->findOne(['id' => $post->user_id]))->username ?></a></p>
        <a href="/admin/comments?id=<?= $post->id ?>"><button class="btn btn-secondary mr-3">Comments</button></a>
    <?php endforeach; ?>
</div>
<div class="container">
    <a href="/dashboard"><button class="btn btn-primary mt-5">Back</button></a>
</div>
