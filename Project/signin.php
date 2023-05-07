<?php
session_start();
include('db_conn.php');
$menu ="";

$info ="";
if (isset($_POST['submit'] )) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $sql = "SELECT * FROM `customers` WHERE `email`='$email' AND `pass` = '$password'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch();
    if (!empty($row['email'])) {
            $_SESSION['email'] = $row['email'];
            $info  = '<div class="alert alert-success" role="alert">Logged in!</div>';
            header("refresh:1,url=index.php");        
    }else {
      $info = '<div class="alert alert-danger" role="alert">Incorrect email or password!</div>';
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Cars Room</title>
  </head>
  <body>
  <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
         
          <a class="navbar-brand d-flex align-items-center order-2" href="index.php">
          <img src="images/logo.png" alt="" height="70" class="d-inline-block me-2 align-text-top">
        </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse ms-auto order-3 flex-grow-0" id="navbarText">
            <?php include('navbar.php'); ?>
        </div>
        
        </div>
      </nav>
  </header>
  <div class="wrapper">
  <div class="container">
        <div class="section-title">
            <div class="heading my-3">
            <h2>Sign In</h2>
            </div>
            </div>
            <div id="login">
        
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                       <?php echo $info;?>
                        <form id="login-form" class="form" action="" method="post">
                            <div class="form-group mt-3">
                                <label for="email" class="text-dark">Email:</label><br>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Somone@example.com">
                            </div>
                            <div class="form-group mt-3">
                                <label for="password" class="text-dark">Password:</label><br>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="*******">
                            </div>
                            <div class="form-group mt-3 mb-2">
                                <input type="submit" name="submit" class="btn btn-primary btn-md" value="Submit">
                            </div>
                            <div id="register-link" class="text-right">
                                <p><a href="signup.php" class="text-primary">Register here</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
  
        <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <footer class="py-4 mt-4 footer-dark bg-dark">
      
      <p class="text-center text-muted mb-0">© 2023 Cars Room, Inc</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
  </html>