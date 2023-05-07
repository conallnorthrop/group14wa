<?php
session_start();
include('db_conn.php');

$menu ="";

$show = $info = "";
if (isset($_GET['add'])) {
  $info="";
  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $items = $_SESSION['cart'];
    $cart_items = explode(",",$items);
    if (in_array($_GET['add'],$cart_items)) {
      $info = '<div class="alert alert-danger" role="alert"> Product already exists!</div>';
    }else{
      $items .= ",".$_GET['add'];
      $_SESSION['cart'] = $items;
      $info = '<div class="alert alert-success" role="alert"> Product added to Cart Successfully!</div>';   
    }  
  }else{
    $item = $_GET['add'];
    $_SESSION['cart'] = $item;
    $info = '<div class="alert alert-success" role="alert"> Product added to Cart Successfully!</div>';
  }
}

$sql = "SELECT * FROM `products` ORDER BY `idProduct`";
$stmt = $pdo->query($sql);
$row = $stmt->fetch();
if (!empty($row['idProduct'])) {
  do {
    $show .= ' <div class="col-md-4">
    <div class="card shadow h-100">
    <div class="text-center">
    <img src="images/'.$row['photo'].'" alt="image" width="100%">
    </div>
      <div class="card-body">
        <h5 class=" text-dark card-title">'.$row['name'].'</h5>
        <p class="card-text">&dollar;'.number_format($row['price'],2,'.').'</p>
        <a href="index.php?add='.$row['idProduct'].'" class="btn btn-primary btn-sm">Add to Cart</a>
      </div>
    </div>
  </div>   ';
  }while ($row = $stmt->fetch());
}else{
  $show = '<div class="alert alert-danger" role="alert">
  No Products Present!</div>';
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
    <img src="images/banner.jpg" class="img-fluid" width="100%">
  <div class="container d-flex primo py-4 justify-content-center" data-aos="fade-up">
    <div class="section-title">
      <div class="heading my-3">
        <h2>Products</h2>
        <?php echo $info; ?>
      </div>
    </div>
</div>
   <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
        <?php 
          echo $show;
        ?>
      </div>
      
   </div>
  </div>
  
   <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <footer class="py-4 mt-4 footer-dark bg-dark">
      
      <p class="text-center text-muted mb-0">© 2023 Cars Room, Inc</p>
    </footer> 
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
  </html>