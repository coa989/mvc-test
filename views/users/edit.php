<?php
/** @var $user \app\models\User
 *  @var $this \app\core\View
 */
$this->title = 'Edit User';
?>
<h1>Edit User</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Role</label>
        <input type="text" name="role" class="form-control <?= $user->hasError('role') ? 'is-invalid' : '' ?>" value="<?= $users->role ?? '' ?>">
        <span class="invalid-feedback"><?= $user->getFirstError('role') ?></span>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control <?= $user->hasError('username') ? 'is-invalid' : '' ?>" value="<?= $users->username ?? '' ?>">
        <span class="invalid-feedback"><?= $user->getFirstError('username') ?></span>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control <?= $user->hasError('email') ? 'is-invalid' : '' ?>" value="<?= $users->email ?? '' ?>">
        <span class="invalid-feedback"><?= $user->getFirstError('email') ?></span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="text" name="password" class="form-control <?= $user->hasError('password') ? 'is-invalid' : '' ?>" value="<?= $users->password ?? '' ?>">
        <span class="invalid-feedback"><?= $user->getFirstError('password') ?></span>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>