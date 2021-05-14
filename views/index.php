<div class="container">
    <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">User ID: <?= $user->id ?></h5>
                    <h5 class="card-title">Role ID: <?= $user->role_id ?></h5>
                    <h5 class="card-title">Username: <?= $user->username ?></h5>
                    <h5 class="card-title">Email: <?= $user->email ?></h5>
                    <h5 class="card-title">Password: <?= $user->password ?></h5>
                    <p class="card-text">Joined: <?= $user->created_at ?></p>
                    <p class="card-text">Modified: <?= $user->updated_at ?></p>
                    <h4 class="card-text">Actions: </h4>
                    <a href="/edit" class="btn btn-secondary  mb-2 btn-block" role="button">Edit</></a>
                    <a href="/delete" class="btn btn-danger mb-2 btn-block" role="button">Delete</></a>
                </div>
    </div>
</div>