<?php

include("connection.php");

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $message = $_POST['message'];
    $file = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];

    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    move_uploaded_file($tmp, "uploads/" . $file);

    $check = isset($_POST['check']) ? implode(", ", $_POST['check']) : "";
    $gender = $_POST['gender'];

    $query = "INSERT INTO users
    (name,email,phone,dob,message,file,`check`,gender)
    VALUES
    ('$name','$email','$phone','$dob','$message','$file','$check','$gender')";

    $insert = mysqli_query($conn, $query);

    if ($insert) {
        header("Location: data.php?success=1");
        exit();
    } else {
        die("MySQL Error : " . mysqli_error($conn));
    }
}

$users = mysqli_query($conn, "SELECT * FROM users");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: linear-gradient(135deg, #8032d4, #8544c5);
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border: none;
            border-radius: 30px;
            overflow: scroll;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .25);
        }

        .card-header {
            background: linear-gradient(180deg, #6c1dc1, #aa45ea);
            padding: 18px;
            border-radius: 40px;
            border-bottom-left-radius: 40px;
            width: 255vh;

        }

        .card-header h3 {
            margin: 0;
            font-weight: 800;
            color: #fff;

        }

        /* .table-responsive {
            overflow-x: auto;
        } */

        #hello thead th {
            background: linear-gradient(180deg, #6f42c1, #aa45ee) !important;
            color: #fff !important;
            text-align: center;
            vertical-align: middle;
        }

        /* .table tbody tr {
            transition: all .3s ease;
        } */

        .table tbody tr:hover {
            background: #f3e8ff !important;
            transform: scale(1.01);
            cursor: pointer;
            box-shadow: 0 5px 12px rgba(129, 76, 227, 0.89);
        }

        .btn {
            border-radius: 8px;
        }

        td,
        th {
            white-space: nowrap;
        }

        .btn-primary {
            background: linear-gradient(180deg, #6f42c1, #aa45ee);
            border: none;
            align-items: center;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3>User Registration Details</h3>
            </div>

            <div class="card-body">
                <?php

                if (isset($insert)) {
                    echo "<div class='alert alert-success'> Data Inserted Successfully </div>";
                }
                ?>
                <table class="table table-bordered table-hover text-center align-middle" id="hello">
                    <thead style="background:linear-gradient(180deg, #6c1dc1, #7e06ff)!important;">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>File</th>
                            <th>Qualification</th>
                            <th>Gender</th>
                            <th>Message</th>
                            <th style="width:180px;">Action</th>


                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        while ($row = mysqli_fetch_assoc($users)) {

                            ?>

                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['dob']; ?></td>


                                <td>
                                    <!-- <a href="uploads/<?// php// echo $row['file']; ?>" target="_blank">
                                        <? //php// echo $row['file']; ?>
                                    </a> -->
                                    <a href="uploads/<?php echo $row['file']; ?> "> <img src="uploads/<?php echo $row['file']; ?>" alt="file" width="70px" > </a>
                                </td>
                                <td><?php echo $row['check']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['message']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm me-2">
                                        Edit
                                    </a>

                                    <a href="delete.php?id=<?php echo $row['id']; ?>"
                                        class="btn btn-danger btn-sm delete-btn">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="text-center"><a href="logoin.php" class="btn btn-primary"> Back to Registration Form </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#hello').DataTable({
                // responsive: true,
                // scrollX: true,
                // pageLength: 10,
                // autoWidth: true,
                // ordering: true,
                // searching: true,
                // paging: true,
                // info: true
            });

        });


        // sweetalrt
        $(".delete-btn").click(function (e) {
            e.preventDefault();

            let link = $(this).attr("href");

            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this record!",
                icon: "warning",
                showCancelButton: true,
                // confirmButtonText: "Yes, Delete",
                // cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });
    </script>
</body>


</html>