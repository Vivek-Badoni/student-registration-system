<?php
session_start();
include("connection.php");

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM login_users WHERE email='$email'");

    if (mysqli_num_rows($query) > 0) {

        $row = mysqli_fetch_assoc($query);

        if (password_verify($password, $row['password'])) {

            $_SESSION['user'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];

            header("Location: logoin.php");
            exit();

        } else {
            echo "<script>
                            Swal.fire({
                                title: 'Login Failed!',
                                text: 'Invalid Password!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                 </script>";

        }

    } else {

        echo "<script>
                    Swal.fire({
                        title: 'Login Failed!',
                        text: 'Email Not Registered!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
            </script>";

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(140deg, #a29bfe 0%, #5c4ae7 50%, #7965fc 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Segoe UI, sans-serif;
        }

        .card {
            border: none;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .25);
        }

        .card-header {
            background: #6c5ce7;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .form-control {
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #6c5ce7;
            box-shadow: 0 0 0 .2rem rgba(108, 92, 231, .25);
        }

        .btn-primary {
            background: #6c5ce7;
            border: none;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background: #5b4bd6;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-5">

                <div class="card">

                    <div class="card-header">

                        <h3>User Login</h3>

                    </div>

                    <div class="card-body">

                        <?php
                        if (isset($error)) {
                            ?>
                            <div class="alert alert-danger">
                                <?php echo $error; ?>
                            </div>
                            <?php
                        }
                        ?>

                        <form method="post">

                            <div class="mb-3">

                                <label><b>Email Address</b></label>

                                <input type="email" class="form-control" name="email" placeholder="Enter Email"
                                    required>

                            </div>

                            <div class="mb-3">

                                <label><b>Password</b></label>

                                <input type="password" class="form-control" name="password" placeholder="Enter Password"
                                    required>

                            </div>

                            <button class="btn btn-primary w-100 py-2" name="login" href="logoin.php">

                                Login

                            </button>

                            <div class="text-center mt-3">

                                Don't have an account?

                                <a href="register.php">Create Account</a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>