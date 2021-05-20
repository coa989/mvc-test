<?php
/** @var $user \app\models\User
 *  @var $this \app\core\View
 */
$this->title = 'Create User';
?>
<h1>Create User</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Role</label>
        <input type="text" name="role" class="form-control <?= $user->hasError('role') ? 'is-invalid' : '' ?>" value="<?= $user->role ?? '' ?>">
        <span class="invalid-feedback"><?= $user->getFirstError('role') ?></span>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control <?= $user->hasError('username') ? 'is-invalid' : '' ?>" value="<?= $user->username ?? '' ?>">
        <span class="invalid-feedback"><?= $user->getFirstError('username') ?></span>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control <?= $user->hasError('email') ? 'is-invalid' : '' ?>" value="<?= $user->email ?? '' ?>">
        <span class="invalid-feedback"><?= $user->getFirstError('email') ?></span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control <?= $user->hasError('password') ? 'is-invalid' : '' ?>">
        <span class="invalid-feedback"><?= $user->getFirstError('password') ?></span>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Create</button>
</form>