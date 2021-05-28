<?php
/** @var $post \app\models\Post
 *  @var $users \app\models\User
 *  @var $this \app\core\View
 *  @var $comments \app\models\Comment // comments for this post
 *  @var $comment \app\models\Comment // object Comment
 *  @var $likes \app\models\Like
 */
$this->title = 'Posts';
?>
<div class="container">
    <h1><?= $post->title ?></h1>
    <h3> <?= $post->body ?></h3>
    <p>Author: <?= $users->findOne(['id' => $post->user_id])->username ?></p>
    <p>Created: <?= $post->created_at ?></p>
    <?php if (!$likes->findOne(['post_id' => "$post->id",'user_id' => $users->getId()])): ?>
        <form action="/likes/create" method="post">
            <input type="hidden" name="post_id" value="<?= $post->id ?>">
            <input type="hidden" name="user_id" value="<?= $users->getId() ?>">
            <button class="btn btn-primary" type="submit">Like</button>
            <p><?= $likes->count($post->id) ?></p>
        </form>
    <?php else: ?>
        <form action="/likes/delete" method="post">
            <input type="hidden" name="post_id" value="<?= $post->id ?>">
            <input type="hidden" name="user_id" value="<?= $users->getId() ?>">
            <button class="btn btn-danger" type="submit">Unlike</button>
            <p><?= $likes->count($post->id) ?></p>
        </form>
    <?php endif; ?>
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
            <textarea placeholder="Type Your Comment Here" name="body" class="form-control <?= $comment->hasError('body') ? 'is-invalid' : '' ?>"></textarea>
            <span class="invalid-feedback"><?= $comment->getFirstError('body') ?></span>
            <input type="hidden" name="user_id" value="<?= $users->getId() ?>">
            <input type="hidden" name="post_id" value="<?= $post->id ?>">
        </div>
        <button class="btn btn-primary mt-2" type="submit">Post Comment</button>
    </form>
</div>
<div class="container">
    <h3>All Comments (<?= $comment->countApproved($post->id) ?>)</h3>
    <?php foreach ($comments as $comment): ?>
        <?php if ($comment->approved): ?>
            <div class="card">
                <p><?= $users->findOne(['id' => $comment->user_id])->username ?></p>
                <h4><?= $comment->body ?></h4>
                <?php if ($users->isOwner($comment->user_id)): ?>
                <div class="container">
                    <a href="/comments/edit?id=<?= $comment->id ?>"><button class="btn btn-primary">Edit</button></a>
                    <a href="/comments/delete?id=<?= $comment->id ?>"><button class="btn btn-danger">Delete</button></a>
                </div>
                <?php endif; ?>
            </div>
        <?php endif;
    endforeach; ?>
</div>
