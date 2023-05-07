<?php

if (isset($_SESSION['email'])) {
    $menu = '
  <li class="nav-item">
    <a class="nav-link" href="logout.php">Logout</a>
  </li>';
  }else{
      $menu = '<li class="nav-item">
      <a class="nav-link" href="signin.php">Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="signup.php">Register</a>
    </li>';
    }
?>

<ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link"href="index.php">Home</a>
              </li>
                        <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
              </li>
<?php echo $menu ?>
            </ul>