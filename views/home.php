<?php
/** @var $this \app\core\View */
$user = (new \app\models\User())->findOne(['id' => $_SESSION['user']]);
$this->title = 'Homepage';
?>
<h1>Welcome <?= empty($user) ? 'Guest' : $user->username ?> </h1>