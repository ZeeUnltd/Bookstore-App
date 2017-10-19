<?php

    $page_title= 'Products';
    session_start();
    #include 'style/styles.php'
    include 'include/db.php';
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
   			<h1>Zee<span>Unltd</span></h1>

          <nav>
            <ul class="clearfix">
              <li><a href="#" class="selected">Products</a></li>
              <li><a href="add_product.php" class="">Add Products</a></li>
              <li><a href="edit_product.php" class="">Edit Products</a></li>
              <li><a href="admin_logout.php" class="">Logout</a></li>
          </ul>
        </nav>
        </div>
            </section>
            <div class="wrapper">
              <div id="stream">
            <br>
            <form id="register" class="" method="post">
            Add New Category

            <input type="text" name="cat_name" value="" placeholder="  Category Name"value=""><input type="submit" name="add_cat" value="Add">
            <?php

            $cat_err = [];
            if(array_key_exists('add_cat', $_POST)){
              if(empty($_POST['cat_name'])){
                $cat_err = "<em>You are yet to enter a Category Name</em>";
              }else {
                $clean= trim($_POST['cat_name']);
                #include 'include/function.php';

                addCategory($conn, $clean);
              }
            }
            ?>

          </form>

      <br>
      <p><h2>View Products</h2></p>
      <table id="tab">
        <thead>
          <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Author</th>
            <th>Price</th>
            <th>Year</th>
            <th>ISBN</th>
            <th>Flag</th>
            <th>Edit</th>
            <th>Delete</th>

          </tr>
        </thead>
        <tbody>
          <?php
          #include 'include/db.php';
					viewProducts($conn);
					?>
        </tbody>
      </table>
    </div>

    <div class="paginated">
      <a href="#">1</a>
      <a href="#">2</a>
      <span>3</span>
      <a href="#">4</a>
    </div>
  </div>


<?php
    include 'include/footer.php';
 ?>
</body>
</html>
