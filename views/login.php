<?php /** @var $model \app\models\User */ ?>
<h1>Login</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control <?= $model->errors['email'] ? 'is-invalid' : '' ?>" value="<?= $model->email ?? '' ?>">
        <span class="invalid-feedback"><?= $model->errors['email'] ?></span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control <?= $model->errors['password'] ? 'is-invalid' : '' ?>" value="">
        <span class="invalid-feedback"><?= $model->errors['password'] ?></span>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>