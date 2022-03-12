<?php
    require 'connection.php';
    // get data from database in id
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = empty($_POST['password']) ? $row['password'] : md5($_POST['password']);

        $result = mysqli_query($conn, "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$id");
        if ($result) {
            header('location: datausers.php');
            $_SESSION['message'] = 'Data has been updated';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
        body{
            background: url("https://www.euimg.com/wp-content/uploads/2022/02/white-aesthetic-wallpaper-euimg-8.jpg");
        }
    </style>
<body>
    <div class="container py-5">
        <h2>Edit Data <?= $row['name'] ?></h2>
        <form class="col col-sm-5 col-lg-6 col-md-7" action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" placeholder="Full Name" value="<?= $row['name']?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" placeholder="Email Address" value="<?= $row['email']?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>