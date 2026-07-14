<?php

include("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);


    $check = explode(", ", $row['check']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit User Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .card {
            border-radius: 15px;
        }
    </style>

</head>

<body>

    <div class="container mt-5">

        <div class="card shadow">

            <div class="card-header bg-warning text-center">
                <h3>Edit User Details</h3>
            </div>

            <div class="card-body">

                <form action="update.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <div class="mb-3">
                        <label><b>Name</b></label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label><b>Email</b></label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label><b>Phone</b></label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label><b>Date Of Birth</b></label>
                        <input type="date" class="form-control" name="dob" value="<?php echo $row['dob']; ?>" required>
                    </div>

                    <div class="mb-3">

                        <label><b>Current File</b></label><br>

                        <a href="uploads/<?php echo $row['file']; ?>" target="_blank">
                            <?php echo $row['file']; ?>
                        </a>

                        <input type="hidden" name="old_file" value="<?php echo $row['file']; ?>">

                        <input type="file" class="form-control mt-2" name="file">

                    </div>

                    <div class="mb-3">

                        <label><b>Qualification</b></label><br>

                        <input type="checkbox" name="check[]" value="10" <?php if (in_array("10", $check))
                            echo "checked"; ?>>
                        10th

                        <input type="checkbox" name="check[]" value="12" <?php if (in_array("12", $check))
                            echo "checked"; ?>>12th

                        <input type="checkbox" name="check[]" value="Graduation" <?php if (in_array("Graduation", $check))
                            echo "checked"; ?>>Graduation

                    </div>

                    <div class="mb-3">

                        <label><b>Gender</b></label><br>

                        <input type="radio" name="gender" value="Male" <?php if ($row['gender'] == "Male")
                            echo "checked"; ?>>
                        Male

                        <input type="radio" name="gender" value="Female" <?php if ($row['gender'] == "Female")
                            echo "checked"; ?>>
                        Female

                    </div>

                    <div class="mb-3">
                        <label><b>Message</b></label>
                        <textarea class="form-control" name="message" rows="4"required><?php echo $row['message']; ?></textarea>
                    </div>

                    <div class="text-center">

                        <button type="submit" name="update" class="btn btn-success"> Update Data</button>
                        <a href="data.php" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>