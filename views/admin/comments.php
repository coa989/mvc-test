<?php
/** @var $users \app\models\User
 *  @var $comments \app\models\Comment
 *  @var $this \app\core\View
 */
$this->title = 'Comments';
?>
<div class="container">
    <h3>All Comments (<?= count($comments) ?>)</h3>
    <?php foreach ($comments as $comment): ?>
            <p>Author: <?= $users->findOne(['id' => $comment->user_id])->username ?></p>
            <h4><?= $comment->body ?></h4>
            <h2><?php if ($comment->approved): ?>
                    <a href="/admin/comments/approve?id=<?= $comment->id ?>&approved=false&post=<?= $comment->post_id?>"><button type="submit" class="btn btn-secondary">Unapprove</button></a>
                    <?php else: ?>
                    <a href="/admin/comments/approve?id=<?= $comment->id ?>&approved=true&post=<?= $comment->post_id?>"><button type="submit" class="btn btn-success">Approve</button></a>
                <?php endif; ?></h2>
            <a href="/comments/edit?id=<?= $comment->id ?>"><button class="btn btn-primary">Edit</button></a>
            <a href="/comments/delete?id=<?= $comment->id ?>"><button class="btn btn-danger">Delete</button></a>
    <?php endforeach; ?>
</div>