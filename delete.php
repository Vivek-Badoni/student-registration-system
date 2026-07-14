<?php

include("connection.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $query = "DELETE FROM users WHERE id='$id'";
    

    if(mysqli_query($conn, $query))
    {
        header("Location: data.php");
        exit();
    }
    else
    {
        echo "Data Delete Failed";
    }
}

?>