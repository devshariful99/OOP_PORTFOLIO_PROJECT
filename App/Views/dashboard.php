<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Dashboard</title>
</head>

<body>
    <section class="dashboard py-5 my-5">
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
                            <h1 class="text-muted">User Dashboard</h1>
                            <div class="row">
                                <div class="col-4 py-3">
                                    <a href="/user/index" class="text-decoration-none text-muted">
                                        <div class="card">
                                            <h2 class="m-0 py-5 text-center">Users</h2>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4 py-3">
                                    <a href="" class="text-decoration-none text-muted">
                                        <div class="card">
                                            <h2 class="m-0 py-5 text-center">My Profile</h2>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4 py-3">
                                    <a href="" class="text-decoration-none text-muted">
                                        <div class="card">
                                            <h2 class="m-0 py-5 text-center">Blogs</h2>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4 py-3">
                                    <a href="/logout" class="text-decoration-none text-danger">
                                        <div class="card">
                                            <h2 class="m-0 py-5 text-center">Logout</h2>
                                        </div>
                                    </a>
                                </div>
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