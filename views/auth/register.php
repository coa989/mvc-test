<?php
use app\core\Application;

if (!Application::$app->session->isGuest()) {
    Application::$app->response->redirect('/');
}
/** @var $model \app\models\UserRegister
 *  @var $this \app\core\View
 */
$this->title = 'Register';
?>
<h1>Register</h1>
<form action="" method="post">
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control <?= $model->hasError('username') ? 'is-invalid' : '' ?>" value="<?= $model->username ?? '' ?>">
        <span class="invalid-feedback"><?= $model->getFirstError('username') ?></span>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control <?= $model->hasError('email') ? 'is-invalid' : '' ?>" value="<?= $model->email ?? '' ?>">
        <span class="invalid-feedback"><?= $model->getFirstError('email') ?></span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control <?= $model->hasError('password') ? 'is-invalid' : '' ?>">
        <span class="invalid-feedback"><?= $model->getFirstError('password') ?></span>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control <?= $model->hasError('confirmPassword') ? 'is-invalid' : '' ?>">
        <span class="invalid-feedback"><?= $model->getFirstError('confirmPassword') ?></span>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Register</button>
</form>