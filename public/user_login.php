<?php
  include 'include/db.php';
  include 'include/function.php';

    $errors = [];

    if(array_key_exists('submit',$_POST)){

      if(empty($_POST['email'])){
        $errors = "Please Enter Your Email";
      }

      if(empty($_POST['password'])){
        $errors = "Please Enter Your Password";
      }

      if(empty($errors)){
        $clean = array_map('trim', $_POST);

      doUserLogin($conn, $_POST);

      header("Location:catalogue.php?email=$last_id&succes");
    }
    }

 ?>

 <!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style/styles.css">
    <title>Login</title>
</head>
<body id="login">
  <!-- DO NOT TAMPER WITH CLASS NAMES! -->

  <!-- top bar starts here -->
  <div class="top-bar">
    <div class="top-nav">
      <a href="index.php"><h3 class="brand"><span>B</span>rain<span>F</span>ood</h3></a>
      <ul class="top-nav-list">
        <li class="top-nav-listItem Home"><a href="index.php">Home</a></li>
        <li class="top-nav-listItem catalogue"><a href="catalogue.php">Catalogue</a></li>
        <li class="top-nav-listItem login"><a href="user_login.php">Login</a></li>
        <li class="top-nav-listItem register"><a href="user_registration.php">Register</a></li>
        <li class="top-nav-listItem cart">
          <div class="cart-item-indicator">
            <p>12</p>
          </div>
          <a href="cart.php">Cart</a>
        </li>
      </ul>
      <form class="search-brainfood">
        <input type="text" class="text-field" placeholder="Search all books">
      </form>
    </div>
  </div>
  <!-- main content starts here -->
  <div class="main">
    <div class="login-form">
      <form class="def-modal-form" method="post" action="user_login.php">
        <div class="cancel-icon close-form"></div>
        <label for="login-form" class="header"><h3>Login</h3></label>
        <input type="text" class="text-field email" placeholder="Email"name="email">
        <p class="form-error"><?php $errmsg=displayErrors($errors,'email');echo $errmsg; ?></p>
        <input type="password" class="text-field password" placeholder="Password" name="password">
        <!--clear the error and use it later just to show you how it works -->
        <p class="form-error"><?php $errmsg=displayErrors($errors,'password');echo $errmsg; ?></p>
        <input type="submit" class="def-button login" value="Login"name="submit">
      </form>
    </div>
  </div>
  <!-- footer starts here-->
  <div class="footer">
    <p class="copyright">&copy; copyright 2016</p>
  </div>
</body>
</html>
