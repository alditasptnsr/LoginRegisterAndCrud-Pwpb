<?php
    require 'connection.php';
    // get data from database in id
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $errors = [];

        empty($name) ? array_push($errors, "Field Name is required") : '';
        empty($email) ? array_push($errors, "Field Email is required") : '';
        empty($password) ? array_push($errors, "Field Password is required") : '';
        empty($confirm_password) ? array_push($errors, "Field Confirm Password is required") : '';

        $password != $confirm_password ? array_push ($errors, "Password you typed doesn't match") : '';

        if (count($errors) == 0) {
            $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            // Checking user in database
            if ($user) {
                if ($user['email'] === $email) {
                    array_push($errors, "Email already exists");
                }
            }

            $password = md5($password);
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($conn, $query);
            $_SESSION['message'] = 'Data has been Created';
            header('location: datausers.php');
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
        <h2>Create User</h2>
        <?php global $errors;
            if ($errors) {
                foreach ($errors as $err) {
                    echo "<p class='alert alert-danger py-1'>$err</p>";
                }
            }
        ?>
        <form class="col col-sm-5 col-lg-6 col-md-7" action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" placeholder="Full Name" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" placeholder="Email Address"  class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <div class="mb-2">
                <label for="name">Confirm Password</label>
                <input class="form-control" type="password" name="confirm_password">
            </div>
            <button type="submit" name="create" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>