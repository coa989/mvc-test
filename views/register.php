<?php /** @var $model \app\models\User */ ?>
<h1>Register</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control <?= $model->errors['username'] ? 'is-invalid' : '' ?>" value="<?= $model->username ?? '' ?>">
        <span class="invalid-feedback"><?= $model->errors['username'] ?></span>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control <?= $model->errors['email'] ? 'is-invalid' : '' ?>" value="<?= $model->email ?? '' ?>">
        <span class="invalid-feedback"><?= $model->errors['email'] ?></span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control <?= $model->errors['password'] ? 'is-invalid' : '' ?>">
        <span class="invalid-feedback"><?= $model->errors['password'] ?></span>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control <?= $model->errors['confirmPassword'] ? 'is-invalid' : '' ?>">
        <span class="invalid-feedback"><?= $model->errors['confirmPassword'] ?></span>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Register</button>
</form>