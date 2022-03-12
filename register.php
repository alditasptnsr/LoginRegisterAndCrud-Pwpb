<?php 
    require 'connection.php';

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1){
        header('location: homepage.php', true);
    }

    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $errors = [];

        empty($name) ? array_push($errors, "Field Name is req") : '';
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
            $_SESSION['email'] = $email;
            $_SESSION['loggedin']  = 1;
            header('location: homepage.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background: url("https://smkmuh1srg.sch.id/wp-content/uploads/2021/06/1.jpeg");
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-2 p-sm-5">
                        <h5 class="card-title text-center mb-5">REGISTER</h5>
                        <?php global $errors;
                            if ($errors) {
                                foreach ($errors as $err) {
                                    echo "<p class='alert alert-danger py-1'>$err</p>";
                                }
                            }
                        ?>
                        <form action="" method="post">
                            <div class="mb-2">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                            <div class="mb-2">
                                <label for="name">Email</label>
                                <input class="form-control" type="text" name="email">
                            </div>
                            <div class="mb-2">
                                <label for="name">Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="mb-2">
                                <label for="name">Confirm Password</label>
                                <input class="form-control" type="password" name="confirm_password">
                            </div>
                            <div class="pt-3 d-flex justify-content-between align-self-center">
                                <button class="btn btn-primary" type="submit" name="register">Register</button>
                                <a class="" href="login.php">Already have an account?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>