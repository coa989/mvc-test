<?php
/** @var $post \app\models\Post
 *  @var $users \app\models\User
 *  @var $this \app\core\View
 *  @var $comments \app\models\Comment
 */ // TODO implement comments errors
$this->title = 'Posts'
?>
<div class="container">
    <h3><?= $post->title ?></h3>
    <h5> <?= $post->body ?></h5>
    <p>Author: <?= $users->findOne(['id' => $post->user_id])->username ?></p>
    <p>Created: <?= $post->created_at ?></p>
    <?php if ($users->isAdmin()): ?>
        <h2><?php if ($post->approved): ?>
                <a href="/posts/approve?id=<?= $post->id ?>&approved=false"><button type="submit" class="btn btn-secondary">Unapprove</button></a>
            <?php else: ?>
                <a href="/posts/approve?id=<?= $post->id ?>&approved=true"><button type="submit" class="btn btn-success">Approve</button></a>
            <?php endif;
            endif;
            ?></h2>
        <?php if ($users->isAdmin() || $post->user_id === $users->getId()): ?>
                <a href="/posts/edit?id=<?= $post->id ?>"><button class="btn btn-primary mr-3">Edit</button></a>
                <a href="/posts/delete?id=<?= $post->id ?>"><button class="btn btn-danger">Delete</button></a>
            <?php
        endif; ?>
</div
<div class="container">
    <form action="/comments/create" method="post">
        <div class="form-group">
            <hr>
            <textarea placeholder="Type Your Comment Here" type="text" name="body" class="form-control"></textarea>
            <input type="hidden" name="user_id" value="<?= $users->getId() ?>">
            <input type="hidden" name="post_id" value="<?= $post->id ?>">
        </div>
        <button class="btn btn-primary mt-2" type="submit">Post Comment</button>
    </form>
</div>
