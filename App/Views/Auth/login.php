<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User Login</title>
</head>

<body>

    <?php
    // $password = "password"; // Replace with your desired password
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // echo "Hashed Password: " . $hashedPassword;
    ?>
    <section class="login py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div>
                        <ul>
                            <?php
                            $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
                            ?>

                            <?php foreach ($errors as $error): ?>
                                <li><span class="text-danger"><?= $error ?></span></li>
                            <?php endforeach; ?>

                            <?php
                            unset($_SESSION['errors']);
                            ?>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h2>Login Form</h2>
                        </div>
                        <div class="card-body">
                            <form action="/login" method="post">
                                <div class="form-group mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" placeholder="Enter email" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Enter password" class="form-control">
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