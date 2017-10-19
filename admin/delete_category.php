<?php

    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }


    $page_title= 'Edit Category';
    session_start();
    #include 'style/styles.php'
    include 'include/db.php';
    include 'include/footer.php';
    include 'include/function.php';

    $action_tab = [];

 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title><?php echo $page_title; ?></title>
   	<link rel="stylesheet" type="text/css" href="style/styles.css">
   </head>
   <body>
   	<section>
   		<div class="mast">
   			<h1>T<span>SSB</span></h1>

          <nav>
            <ul class="clearfix">
              <li><a href="#" class="selected">Categories</a></li>
              <li><a href="categories.php" class="">Add Categories</a></li>
              <li><a href="admin_logout.php" class="">Logout</a></li>
          </ul>
        </nav>
        </div>
            </section>
            <div class="wrapper">
              <div id="stream">
            <br>
            <form id="register" class="" method="post">
            <fieldset onfocus="" style="align-items: center;"><legend> <h1 id="register-label">Delete Category</h1></legend> <center>



              <br>

              <p> Are you Sure you want to delete?
                 <input type="submit" name="yes" value="YES" placeholder="  Category Name"><input type="submit" name="no" value="NO">

              </p>
              <br>
              <?php


              $cat_err = [];
              if(array_key_exists('yes', $_POST)){
                  deleteCategory($conn, $id);
                }elseif(array_key_exists('no', $_POST)) {
                  header('Location:categories.php?msg=category_has_been_edited');
                }

              ?>

            </form></center>
            </fieldset>












</body>
</html>
