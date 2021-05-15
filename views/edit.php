<?php /** @var $user \app\models\User */?>
<h1>Edit User</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Role</label>
        <input type="text" name="role" class="form-control <?= $user->errors['role'] ? 'is-invalid' : '' ?>" value="<?= $user->role ?? '' ?>">
        <span class="invalid-feedback"><?= $user->errors['role'] ?></span>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control <?= $user->errors['username'] ? 'is-invalid' : '' ?>" value="<?= $user->username ?? '' ?>">
        <span class="invalid-feedback"><?= $user->errors['username'] ?></span>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control <?= $user->errors['email'] ? 'is-invalid' : '' ?>" value="<?= $user->email ?? '' ?>">
        <span class="invalid-feedback"><?= $user->errors['email'] ?></span>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>