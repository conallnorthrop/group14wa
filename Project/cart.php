<?php
session_start();
include('db_conn.php');

$menu = "";
$show = $info = "";
$info1 = "";
if (isset($_GET['del_item'])) {
  $del_id = $_GET['del_item'];
  if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $cart_items = explode(",", $_SESSION['cart']);
    // print_r($cart_items);
    if (array_search($del_id, $cart_items) !== false) {
      $key = array_search($del_id,$cart_items);
      unset($cart_items[$key]);
    }
    $cart_id = implode(",", $cart_items);
    $_SESSION['cart'] = $cart_id;
    $info1 = '<div class="alert alert-success" role="alert">Item removed Successfully!</div>';
  }
}
if (isset($_GET['empty_cart'])) {
  unset($_SESSION['cart']);
  $info = '<div class="alert alert-success" role="alert">Cart Emptied Successfully!</div>';
}


$show = "";
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  $cart_items = explode(",", $_SESSION['cart']);

  $i = 1;
  foreach ($cart_items as $item) {
    $sql = "SELECT * FROM `products` WHERE `idProduct`='$item'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch();
    $quantity = 1;
    $show .= '<tr>
<input type="hidden" name="price[]" value="' . $row['price'] . '">
<input type="hidden" name="idProduct[]" value="' . $row['idProduct'] . '">
<input type="hidden" name="email" value="' . $_SESSION['email'] . '">
<td><img src="images/' . $row['photo'] . '" alt="img" height="120px"></td>
<td class="mt-5">' . $row['name'] . '</td>
<td><input type="text" value="' . $row['price'] . '" disabled id="price' . $i . '" ></td>
<td><input type="number" value="' . $quantity . '" mini-value="1" id="qty' . $i . '" onchange="func_total(' . $i . ')" name="qty[]"></td>
<td colspan="2">$<span id="total' . $i . '" class="total">' . $quantity * $row['price'] . '</span></td>
<td><a class="btn btn-danger" href="cart.php?del_item=' . $row['idProduct'] . '">Remove item</a></td>
</tr>';

    $i++;
  }
} else {
  $show = '<div class="alert alert-danger" role="alert">Cart is Empty!</div>';
}
?>
<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
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
            <h2>Cart</h2>
          </div>
        </div>
        <form action="cart.php" class="cart-form" method="POST">
          <?php
          echo $info1;
          echo $info;
          ?>
          <table class="w-100 table">
            <thead>
              <tr class="table-dark">
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th colspan="2">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php echo $show; ?>
              <tr class="g-total">
                <td colspan="4" class="text-center">
                  <b> Grand Total</b>
                </td>
                <td colspan="3"><b>$<span id="g_total">50</span></b></td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="btn-cart">
                <td colspan="4" class="text-center"><a href="cart.php?empty_cart" class="btn btn-danger">Empty Cart</a>
                </td>
                <td colspan="3" class="text-center"><button class="btn btn-success" type="submit"
                    name="checkout">Checkout</button></td>
              </tr>
            </tfoot>
          </table>
        </form>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
      crossorigin="anonymous"></script>
    <footer class="py-4 mt-4 footer-dark bg-dark">
      <p class="text-center text-muted mb-0">© 2023 Cars Room, Inc</p>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
  </body>

</html>