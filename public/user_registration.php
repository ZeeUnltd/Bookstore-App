<?php
   #load db connection
   session_start();

   include 'include/db.php';
   #including functions
   include 'include/function.php';

       #title

   $page_title = "Registration";

  #include header
   #include 'includes/header.php';


?>


<?php
   $errors =[];

   if(array_key_exists('register', $_POST)){



    if(empty($_POST['fname'])){

      $errors['fname']="*Please enter your first name";
    }

    if(empty($_POST['lname'])){
      $errors['lname']="*Please enter  your lastname";
    }

    if(empty($_POST['email'])){
      $errors['email']="*Please enter your email";
    }

    if(userCheckEmail($conn, $_POST['email'])) {

      $errors['email'] = "*email already exists";
    }

    if(empty($_POST['uname'])){
      $errors['uname']= "*Please enter a username";
    }
    if(empty($_POST['password'])){
      $errors['password']= "*Please enter a password";
    }

    if(empty($_POST['pword'])){
      $errors['pword']= "*Please confirm password";
    }

    if ($_POST['pword'] != $_POST['password'])
    {
        $errors['pword'] = "*Passwords do not match.";
    }



    if(empty($errors)){


      $clean =array_map('trim',$_POST);
      userRegister($conn,$clean);
      
    }
   }

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style/styles.css">
    <title>Registration</title>
</head>
<body id="registration">
  <!-- DO NOT TAMPER WITH CLASS NAMES! -->

  <!-- top bar starts here -->
  <div class="top-bar">
    <div class="top-nav">
      <a href="index.html"><h3 class="brand"><span>B</span>rain<span>F</span>ood</h3></a>
      <ul class="top-nav-list">
        <li class="top-nav-listItem Home"><a href="index.php">Home</a></li>
        <li class="top-nav-listItem catalogue"><a href="catalogue.php">Catalogue</a></li>
        <li class="top-nav-listItem login"><a href="user_login.php">Login</a></li>
        <li class="top-nav-listItem register"><a href="user_registration.php">Register</a></li>
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

      <form class="def-modal-form"  action = "user_registration.php" method = "POST">

        <div class="cancel-icon close-form"></div>
         <?php  if(isset($_GET['success'])) { $suc_msg= $_GET['success']; echo $suc_msg;} ?>

        <label for="registration-from" class="header"><h3>User Registration</h3></label>

      <p class="form-error"> <?php
          $errmsg = displayErrors($errors, 'fname');
          echo $errmsg;
        ?></p>

        <input type="text" name="fname" class="text-field first-name" placeholder="Firstname">

       <p class="form-error"> <?php
          $errmsg = displayErrors($errors, 'lname');
          echo $errmsg;
        ?></p>

        <input type="text" name="lname"  class="text-field last-name" placeholder="Lastname">

        <p class="form-error"><?php
        echo displayErrors($errors, 'email');

        ?></p>


        <input type="email" name="email" class="text-field email" placeholder="Email">
        <p class="form-error"><?php
        echo displayErrors($errors, 'uname');

        ?></p>

        <input type="text" name ="uname" class="text-field username" placeholder="Username">

        <p class="form-error"><?php
        echo displayErrors($errors, 'password');

        ?></p>

        <input type="password" name="password" class="text-field password" placeholder="Password">

        <p class="form-error"><?php
        echo displayErrors($errors, 'pword');

        ?></p>

        <input type="password" name="pword" class="text-field confirm-password" placeholder="Confirm Password">

        <input type="submit" name="register" class="def-button" value="Register">

        <p class="login-option">Have an account already?<a href="user_login.php"> Login</p>

      </form>
    </div>
  </div>

 <?php
   #include footer

   include 'include/footer.php';

?>
