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
            <form id="register" method="post">
            <fieldset onfocus="" style="align-items: center;"><legend> <h1 id="register-label">Edit Category</h1></legend> <center>





            </h1>


              <br>

              <p>
                Enter New Category Name <input type="text" name="cat_name" value="<?php echo $_GET['name'];?>" placeholder="  Category Name">
              </p><br>
              <p>
                <input type="submit" name="edit_cat" value="Edit Category">

              </p>
              <br>
              <?php


              $cat_err = [];
              if(array_key_exists('edit_cat', $_POST)){
                if(empty($_POST['cat_name'])){
                  $cat_err = "<em>You are yet to enter a Category Name</em>";
                }


                if(empty($cat_err)) {
                  $clean= trim($_POST['cat_name']);


                  editCategory($conn, $clean, $id);

                }
              }
              ?>

            </form></center>
            </fieldset>












</body>
</html>
