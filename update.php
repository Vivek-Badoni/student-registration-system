<?php

include("connection.php");

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $message = $_POST['message'];

    $check = isset($_POST['check']) ?  implode(", ", $_POST['check']) : "";
    $gender = $_POST['gender'];
    $old_file = $_POST['old_file'];
    if($_FILES['file']['name'] != "")
    {
        $file = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmp,"uploads/".$file);
    }
    else
    {
        $file = $old_file;
    }
    $query = "UPDATE users SET
                name='$name',
                email='$email',
                phone='$phone',
                dob='$dob',
                message='$message',
                file='$file',
                `check`='$check',
                gender='$gender'
              WHERE id='$id'";

    $result = mysqli_query($conn,$query);

    if($result)
    {
        header("Location: data.php");
        exit();
    }
    else
    {
        echo "Update Failed : ".mysqli_error($conn);
    }
}

?>