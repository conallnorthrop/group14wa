<?php
include('db_conn.php');
$menu = '';
$info = "";
if (isset($_POST['signup'])) {
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
    $pass = $_POST['pass'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
      $sql = "SELECT count(*) FROM `customers` WHERE `email`=?";
      $result = $pdo->prepare($sql); 
      $result->execute([$email]); 
      $number_of_rows = $result->fetchColumn(); 
      if ($number_of_rows > 0) {
        $info = '<div class="alert alert-danger" role="alert">
        Email already exist!</div>';
      } else {
        $query= "INSERT INTO `customers`(`name`,`surname`,`email`,`pass`,`city`,`address`,`telephone`) VALUES (?,?,?,?,?,?,?)";
        $check = $pdo->prepare($query)->execute([$name, $surname, $email, $pass, $city, $address, $telephone]);
        if ($check) {
          $info = '<div class="alert alert-success" role="alert">
          Regristered Succesfully!!</div>';
        } else {
          $info = '<div class="alert alert-danger" role="alert">
          An error occured please try again!!</div>';
        }	
      }
      
}
?>

<!DOCTYPE html>
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
            <h2>Sign Up</h2>
            </div>
            </div>
            <div class="container col-md-6">
	<form class="needs-validation form-horizonatal" novalidate method="POST" action="" >
    <?php echo $info; ?>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="John" required>
      </div>
	  <div class="mb-3">
        <label for="surname" class="form-label">Surname</label>
        <input name="surname" type="text" class="form-control" id="surname" placeholder="Doe" required>
      </div>
      <div class="mb-3">
        <label for="Email1" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="someone@gmail.com" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input name="pass" type="password" class="form-control" id="pass" placeholder="****" max="20" required>
      </div>
      
	  <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input name="city" type="text" class="form-control" id="city" placeholder="New York" required>
      </div>
	  <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input name="address" type="text" class="form-control" id="address" placeholder="Street 1, Ney York City" required>
      </div>
	  <div class="mb-3">
        <label for="telephone" class="form-label">Telephone</label>
        <input name="telephone" type="text" class="form-control" id="telephone" placeholder="+1 123 456 678" required>
      </div>
	  <div class="mb-3 ">
	  <a href="signin.php" class="text-dark">Already have an account? Login</a> 
	  </div>
      <button name="signup" type="submit" class="btn btn-primary">Submit</button>
    </form>
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