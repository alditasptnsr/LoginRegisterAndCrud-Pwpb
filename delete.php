<?php
    require 'connection.php';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($result);


    $result = mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    if ($result) {
        header('location: dataUsers.php');
        $_SESSION['message'] = 'Data has been Deleted';
    }