<?php
session_start();;
  #title
  $page_title = "Login";
  #load db connection
  include 'include/db.php';
  #load functions
  include 'include/function.php';
  #include header
  include 'include/header.php';
  #include footer



  $error = [];
  if(array_key_exists('login', $_POST)){

    if(empty ($_POST['email'])){
      $error['email']= "Please enter Email";
    }

    if(empty ($_POST['password'])){
      $error['password']= "Please enter Password";
    }

    if(empty($error)){
      $clean=array_map('trim', $_POST);
      #insert into db
      $chk =doAdminLogin($conn, $clean);
      if($chk[0] ==true){
        $row = $chk[1];
        $row[3]=
        #set user session

        $_SESSION['admin_id']=$row;

      header("Location:admin_home.php");
      }

    }
  }

 ?>

	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register" method ="POST">
			<div><?php $display= displayErrors($error, 'email'); echo $display; ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email" value="<?php $stick= makeSticky ('email');?>">
			</div>

			<div><?php $display= displayErrors($error, 'password'); echo $display; ?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="login" value="Login">
		</form>

		<h4 class="jumpto">Have an account? <a href="login.php">login</a></h4>
  </div>

<?php   include 'include/footer.php'; ?>
