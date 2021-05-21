<?php
/** @var $model \app\models\UserLogin
 *  @var $this \app\core\View
 */
$this->title = 'Login';
?>
<h1>Login</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control <?= $model->hasError('email') ? 'is-invalid' : '' ?>" value="<?= $model->email ?? '' ?>">
        <span class="invalid-feedback"><?= $model->getFirstError('email') ?></span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control <?= $model->hasError('password') ? 'is-invalid' : '' ?>" value="">
        <span class="invalid-feedback"><?= $model->getFirstError('password') ?></span>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Login</button>
</form>