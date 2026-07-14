<?php

include("connection.php");

if (isset($_POST['register'])) {

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password != $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {

        $check = mysqli_query($conn, "SELECT * FROM login_users WHERE email='$email'");

        if (mysqli_num_rows($check) > 0) {

            echo "<script>alert('Email already exists!');</script>";

        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $insert = mysqli_query($conn, "INSERT INTO login_users(fullname,email,password)
            VALUES('$fullname','$email','$hash')");

            if ($insert) {

                echo "<script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Account Created Successfully',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'login.php';
                        });
                    });
                    </script>";

            } else {

                echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                    </script>";

            }

        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(140deg, #a29bfe, #5c4ae7, #7965fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .25);
        }

        .card-header {
            background: #6c5ce7;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .btn-primary {
            background: #6c5ce7;
            border: none;
        }

        .btn-primary:hover {
            background: #5b4bd4;
        }

        .form-control {
            border-radius: 8px;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card">

                    <div class="card-header">

                        <h3>Create Account</h3>

                    </div>

                    <div class="card-body">

                        <form method="post">

                            <div class="mb-3">
                                <label>Full Name</label>
                                <input type="text" name="fullname" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>

                            <button class="btn btn-primary w-100" name="register">
                                Create Account
                            </button>

                            <div class="text-center mt-3">

                                Already have an account?

                                <a href="login.php">Login</a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>