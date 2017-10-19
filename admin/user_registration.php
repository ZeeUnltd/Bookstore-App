<?php

  session_start();
  #Include Functon
  include 'include/function.php';
  include ('include/db.php');

  $error =[];
  if(array_key_exists('submit',$_POST)){
    if(empty($_POST['uname'])){
      $error['uname']="Enter Username";
    }

    if(empty($_POST['fname'])){
      $error['fname']="Empty Firstname";
    }

    if(empty($_POST['lname'])){
      $error['lname']="Empty Lastname";
    }



    if(empty($_POST['email'])){
      $error['email']="Enter Email";
    }
  #  if(userCheckEmail($conn, $_POST['email'])){
  #    $error['email']="Email already exist";
  #  }

    if(empty($_POST['password'])){
      $error['password']="Enter Password";
    }
    If($_POST['password'] != $_POST['cpword']){
      $error['cpword']="Password Mismatch!";
    }

    if(empty($error)){
      $clean=array_map('trim', $_POST);

      function userlogin($conn, $input){
    $hash= password_hash($_POST['password'], PASSWORD_BCRYPT);
    #insert
    $stmt=$conn->prepare("INSERT INTO users(user_id,username,firstname,lastname,email,hash) VALUES(NULL,:us,:fn,:ln,:em,:h)");
    $data=[':us'=>$input['uname'],
           ':fn'=>$input['fname'],
           ':ln'=>$input['lname'],
           ':em'=>$input['email'],
           ':h'=>$hash];
           $stmt-> execute($data);
  }

      userlogin($conn, $clean);
      echo "<center>Successfully Registerd!</center>";
      header("Location:user_registeration.php?msg=Successfully Resistered");

    }
  }

 ?>

 <!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="public/style/styles.css">
    <title>Registration</title>
</head>
<body id="registration">
  <!-- DO NOT TAMPER WITH CLASS NAMES! -->

  <!-- top bar starts here -->
  <div class="top-bar">
    <div class="top-nav">
      <a href="index.html"><h3 class="brand"><span>B</span>rain<span>F</span>ood</h3></a>
      <ul class="top-nav-list">
        <li class="top-nav-listItem Home"><a href="index.html">Home</a></li>
        <li class="top-nav-listItem catalogue"><a href="catalogue.html">Catalogue</a></li>
        <li class="top-nav-listItem login"><a href="login.html">Login</a></li>
        <li class="top-nav-listItem register"><a href="registration.html">Register</a></li>
        <li class="top-nav-listItem cart">
          <div class="cart-item-indicator">
            <p>12</p>
          </div>
          <a href="cart.html">Cart</a>
        </li>
      </ul>
      <form class="search-brainfood">
        <input type="text" class="text-field" placeholder="Search all books">
      </form>
    </div>
  </div>
  <!-- main content starts here -->
  <div class="main">
    <div class="registration-form">
      <form class="def-modal-form" method="post" action="">
        <div class="cancel-icon close-form"></div>
        <label for="registration-from" class="header"><h3>User Registration</h3></label>
        <input type="text" class="text-field first-name" placeholder="Firstname" name="fname">
        <input type="text" class="text-field last-name" placeholder="Lastname" name="lname">
        <input type="email" class="text-field email" placeholder="Email" name="email">
        <input type="text" class="text-field username" placeholder="Username" name="uname">
        <input type="password" class="text-field password" placeholder="Password" name="password">
        <input type="password" class="text-field confirm-password" placeholder="Confirm Password" name="cpword">
        <input type="submit" class="def-button" value="Register" name="submit">
        <p class="login-option">Have an account already? Login</p>
      </form>
    </div>
  </div>
  <!-- footer starts here-->
  <div class="footer">
    <p class="copyright">&copy; copyright 2016</p>
  </div>
</body>
</html>
