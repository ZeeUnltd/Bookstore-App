<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
	}
	ob_start();
	session_start();
	$page_title= "Edit Products";
	#load db connection

   include 'include/db.php';

   #including functions
   include 'include/function.php';
	 //$id=$_SESSION['book_id'];



  $data= getEditRowdata($conn, $id);
			//var_dump($data);

   $file_get	= $data['filepath'];
			$title	= $data['title'];
			$author	= $data['author'];
			$cat		= $data['category_id'];
			$price	= $data['price'];
			$yr			= $data['year'];
			$isbn		= $data['ISBN'];
			$flags	= $data['flag'];

			$catname = getcatbyid($conn, $id);
		  echo $catname . '<hr>';





   #header

   #include header
   #include 'includes/header.php';


    $flag = array ("top-selling", "trending");


    $erorrs = [];
		  if (array_key_exists('add', $_POST)) {
		   	  		 define("MAX_FILE_SIZE", "2097152");

#allowed extension...
					$ext = ["image/jpg","image/jpeg", "image/png"];
				if(empty($_POST['title'])){
				  	$errors['title']="Please enter a Book title";
				   }

				   if(empty($_POST['author'])){
				  	$errors['author']="Please enter Book author";
				   }

				if(empty($_POST['price'])){
				  	$errors['price']="Please enter the Book price";
				   }

				if(empty($_POST['category'])){
			  	$errors['category']="Please select the category";
				   }

				if(empty($_POST['year'])){
			  	$errors['year']="Please enter the year of publication";
				   }

				if(empty($_POST['isbn'])){
					$errors['isbn']="Please enter the ISBN";
				}

				if(empty($_POST['flag'])){
					$errors['flag']="Please enter a flag";
				}

					    #be sure a file was selected....
				if(empty($_FILES['pic']['name'])){
					$errors['pic']= "please choose a file";
				}

				#check file size...

				if($_FILES['pic']['size'] > MAX_FILE_SIZE) {
					$errors['pic'] = "file size exceeds maximum. maximum: ".MAX_FILE_SIZE;
				}

				#check extention....
				if(!in_array($_FILES['pic']['type'], $ext)) {
					$errors['pic'] = "Invalid file type";
				}

				$chk = uploadFiles($_FILES, 'pic', '../admin/uploads/');

				if($chk[0]) {
					$destination = $chk[1];
				} else {
						$errors['pic'] = "file upload failed";
					}



			 if(empty($errors)){
			   	$clean = array_map('trim', $_POST);
			   	$clean['dest'] = $destination;

	 				editProducts($conn,$clean,$destination);

		 		}

			}//if (isset($_POST['category'])){echo $_POST['category'];}
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
              <li><a href="Products.php" class="">Products</a></li>
             	<li><a href="add_product.php" class="">Add Products</a></li>
						 							<li><a href="edit_product.php" class="selected">Edit Product</a></li>
              <li><a href="admin_logout.php" class="">Logout</a></li>
           	</ul>
         	</nav>
      	</div>
      </section>

	<div class="wrapper">
		<h1 id="register-label">Edit Products</h1>
		<hr>
		<form id="register"  action ="edit_product.php" method ="POST" enctype="multipart/form-data">
		<div><div style="
    float: right;
    border: 1px solid red;
    width: 379px;
    height: 481px; background: url('<?php echo $file_get;?>')"> <img style=""src="" alt="">
				Place holdee image
		</div>
		<div>

		<label>Title</label>
			<input type="text" name="title" placeholder="title" value="<?php echo $title;?>">
		</div>
		<div>
			<label>Author</label>
				<input type="text" name="author" placeholder="author" value="<?php echo $author;?>">
		</div>
		<div>
			<label>Category</label>
			<select name="category">
				<option ><?php echo getcatbyid($conn, $cat); ?></option>

					<?php $view = getCategory($conn);   echo $view; ?>
			</select>
		</div>

		<div>
			<label>Price</label>
				<input type="text" name="price" placeholder="price" value="<?php echo $price;?>">
		</div>

		<div>
			<label>Year of Publication</label>
				<input type="text" name="year" placeholder="year" value="<?php echo $yr;?>">
		</div>
		<div>
			<label>ISBN</label>
				<input type="text" name="isbn" placeholder="ISBN" value="<?php echo $isbn;?>">
		</div>
		<div>
			<label>Upload Image</label>
				<input type="file" name="pic">

		</div>
		<div>
	    <label>Flag</label>
		    <select name= "flag">
		    	<option value=""><?php echo $flags;?></option>
		    	<?php foreach($flags as $flag){ ?>
       <option value="<?php echo $flag;?>"><?php echo $flag;?></option>
               <?php }?>
    		</select>


		</div>
			<input type="submit" name="add" value="Add product">
	</form>
	</div>

	<div class="paginated">
		<a href="#">1</a>
		<a href="#">2</a>
		<span>3</span>
		<a href="#">4</a>
	</div>
	</div>

	<?php
   #include footer

   include 'include/footer.php';

	?>
