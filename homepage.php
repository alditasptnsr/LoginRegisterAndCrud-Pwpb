<?php 
    require 'connection.php';
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: formlogin.php');
        exit;
    }
    $email = $_SESSION['email'];
    $query  = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background: url("https://wallpaperaccess.com/full/623059.jpg");
        }
    </style>
    
</head>
<body>
    <div class="container">
            <div class="col-sm-9 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
        <h1 class="pt-2">Selamat Datang <?= $data['name'] ?></h1>
        <a href="datausers.php" class="btn btn-primary">Data Users</a>
        <a href="logout.php" class="btn btn-danger my-5">Logout</a>
    </div>
    </div>
            </div>
        </div>
</body>
</html>