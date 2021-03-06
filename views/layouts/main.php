<?php
use app\core\Application;
use app\models\User;

$user = new User();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title><?= $this->title ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($user->isAdmin()): ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/admin">Dashboard</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/posts">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/contact">Contact</a>
                </li>
                <?php endif ?>
            </ul>
            <?php if (Application::$app->session->isGuest()): ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/register">Register</a>
                </li>
            </ul>
            <?php else: ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/users/show?id=<?= $user->getId() ?>"><?= $user->getDisplayName() ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/logout">Logout</a>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">
    <?php if (Application::$app->session->getFlash('success')): ?>
    <div class="alert alert-success">
        <?= Application::$app->session->getFlash('success') ?>
    </div>
    <?php elseif (Application::$app->session->getFlash('failure')): ?>
        <div class="alert alert-danger">
            <?= Application::$app->session->getFlash('failure') ?>
        </div>
    <?php endif; ?>
    {{content}}
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
-->
</body>
</html>
