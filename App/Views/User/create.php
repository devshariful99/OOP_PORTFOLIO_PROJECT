<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add User</title>
</head>

<body>
    <section class="users py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div>
                        <ul>
                            <?php
                            $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
                            foreach ($errors as $error): ?>
                                <li><span class="text-danger"><?= $error ?></span></li>
                            <?php endforeach;
                            unset($_SESSION['errors']);
                            ?>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Add User</h2>
                        </div>
                        <div class="card-body">
                            <form action="/user/store" method="post">
                                <div class="form-group mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" placeholder="Enter name" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Enter email" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Enter password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" placeholder="Enter confirm password" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>