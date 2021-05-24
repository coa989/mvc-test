<?php
/** @var $post \app\models\Post
 *  @var $users \app\models\User
 *  @var $this \app\core\View
 */
$this->title = 'Posts'
?>
<div class="container">
    <h2>ID: <?= $post->id ?></h2>
    <h2>Title: <?= $post->title ?></h2>
    <h2>Body: <?= $post->body ?></h2>
    <h2>Author: <?= $users->findOne(['id' => $post->user_id])->username ?></h2>
    <h2>Created: <?= $post->created_at ?></h2>
    <h2>Updated: <?= $post->updated_at ?></h2>
    <?php if ($users->isAdmin()): ?>
        <h2><?php if ($post->approved): ?>
                <a href="/posts/approve?id=<?= $post->id ?>&approved=false"><button type="submit" class="btn btn-secondary">Unapprove</button></a>
            <?php else: ?>
                <a href="/posts/approve?id=<?= $post->id ?>&approved=true"><button type="submit" class="btn btn-success">Approve</button></a>
            <?php endif; ?></h2>
    <a href="/posts/edit?id=<?= $post->id ?>"><button class="btn btn-primary mr-3">Edit</button></a>
    <a href="/posts/delete?id=<?= $post->id ?>"><button class="btn btn-danger">Delete</button></a>
    <?php endif; ?>
</div>
