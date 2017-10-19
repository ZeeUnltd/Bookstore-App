<?php

ob_start();
session_start();
  #title
  $page_title = "Admin Home";
  #load db connection
  include 'include/db.php';
  #load functions
  include 'include/function.php';


  #page_protect();

  $id=$_SESSION['admin_id'];

  $data= getRowdata($conn, $id);
  //$data['firstname']= $nm;
  //echo $data['firstname'];

  #include header
  include 'include/header.php';
  $_SESSION['active'] = true;
 ?>
  <div class="wrapper">

		<div id="stream">
    <p>
      <h2><span> Welcome <?php echo $data['firstname'] ; ?>  </span></h2>
    </p>

    <p>
      <div class="">
        You can add, edit and delete categories, products, Sellers/Suppliers from this portal.
        Please check the Instructions or just click away from the Menus to do any of these.
      </div>
    </p>

		</div>

	</div>

  <?php
  #include footer
  include 'include/footer.php';
   ?>
