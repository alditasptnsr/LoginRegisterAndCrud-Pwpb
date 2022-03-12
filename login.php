<?php 
    require 'connection.php';

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1){
        header('location: homepage.php', true);
    }

    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $errors = [];
    
        empty($email) ? array_push($errors, "Field Email is required") : '';
        empty($password) ? array_push($errors, "Field Password is required") : '';
    
        if (count($errors) == 0) {
            $password = md5($password);
    
            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['email'] = $email;
                $_SESSION['loggedin']  = 1;
                header('location: homepage.php');
            } else {
                array_push($errors, "Username or Password is Wrong ");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background: url("https://bandungberita.com/wp-content/uploads/2021/12/50FCBB63-7184-49D2-9C9D-A015E121CB08.jpeg");
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5">LOGIN</h5>
                        <?php global $errors;
                            if ($errors) {
                                foreach ($errors as $err) {
                                    echo "<p class='alert alert-danger py-1'>$err</p>";
                                }
                            }
                        ?>
                        <form action="" method="post">
                            <div class="mb-2">
                                <label for="name">Email</label>
                                <input class="form-control" type="text" name="email" required>
                            </div>
                            <div class="mb-2">
                                <label for="name">Password</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                            <div class="pt-3 d-flex justify-content-between align-self-center">
                                <button class="btn btn-primary" type="submit" name="login">Login</button>
                                <a class="" href="register.php">Don't have an account?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>