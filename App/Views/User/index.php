<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User List</title>
</head>

<body>
    <section class="users py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php endif;
                    unset($_SESSION['success']);
                    ?>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h1 class="text-muted">User List</h1>
                                <a href="/dashboard" class="btn btn-sm btn-primary">Back</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $key => $user): ?>
                                            <tr>
                                                <th><?= ++$key ?></th>
                                                <th><?= $user['name'] ?></th>
                                                <th><?= $user['email'] ?></th>
                                                <th><span class="badge<?= $user['status'] == 1 ? ' bg-success' : ' bg-danger' ?>"><?= $user['status'] == 1 ? 'Active' : 'Inactive' ?></span></th>
                                                <th><?= date('d M, Y', strtotime($user['created_at'])) ?></th>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>