<?php
/** @var $user \app\models\User */
?>

<div class="container">
    <h5>Username: <?= $user->username ?></h5>
    <h5>Email: <?= $user->email ?></h5>
    <p>Joined: <?= $user->created_at ?></p>
</div>
