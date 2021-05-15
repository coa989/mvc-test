<?php
$users = (new \app\models\User())->getAll();
?>

<div class="card-header py-3">
    <a href="/create"><button class="btn btn-success">Create User</button></a>
</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Username</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><a href="/show?id=<?= $user->id ?>"><?= $user->username; ?></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>