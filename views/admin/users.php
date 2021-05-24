<?php
/** @var $users \app\models\User */
?>
<div class="container">
    <a href="/users/create"><button class="btn btn-success">Create User</button></a>
    <ul>
        <?php foreach($users as $user): ?>
            <li>
                <a href="/users/show?id=<?= $user->id ?>"><?= $user->username; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/dashboard"><button class="btn btn-primary">Back</button></a>
</div>


