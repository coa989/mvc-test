<?php
/** @var $user \app\models\User
 *   @var $users \app\models\User
 *  @var $this \app\core\View
 */
$this->title = 'Show User';
?>
<div class="container">
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">User ID: <?= $user->id ?></h5>
            <h5 class="card-title">Role: <?= $user->role ?></h5>
            <h5 class="card-title">Username: <?= $user->username ?></h5>
            <h5 class="card-title">Email: <?= $user->email ?></h5>
            <h5 class="card-title">Password: <?= $user->password ?></h5>
            <p class="card-text">Created: <?= $user->created_at ?></p>
            <p class="card-text">Modified: <?= $user->updated_at ?></p>
            <a href="/users/posts?id=<?= $user->id ?>" class="btn btn-info  mb-2 btn-block" role="button">User Posts</></a>
            <a href="/users/edit?id=<?= $user->id ?>" class="btn btn-secondary  mb-2 btn-block" role="button">Edit</></a>
            <?php if ($users->isAdmin()): ?>
            <a href="/users/delete?id=<?= $user->id ?>" class="btn btn-danger mb-2 btn-block" role="button">Delete</></a>
            <?php endif; ?>
        </div>
    </div>
</div>