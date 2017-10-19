<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="style/styles.css">
</head>
<body>
	<section>
		<div class="mast">
			<h1>Zee<span>Unltd</span></h1>
			<?php

				if(isset($_SESSION['active'])){
					echo <<<EOT
					<nav>
					<ul class="clearfix">
						<li><a href="admin_home.php" class="selected">Home</a></li>
						<li><a href="categories.php">Categories</a></li>
						<li><a href="products.php">Products</a></li>
						<li><a href="category.php">Orders</a></li>
						<li><a href="category.php">Sellers/Suppliers</a></li>
						<li><a href="admin_logout.php">Logout</a></li>
					</ul>
					</nav>






EOT;
		} elseif (!isset($_SESSION)) {
		$_SESSION['active'] = false;
		} ?>
			 </div>
			 </section>
