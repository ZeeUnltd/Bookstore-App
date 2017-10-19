<?php
    include 'include/db.php';
    include 'include/function.php';




 ?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style/styles.css">
    <title>Home</title>
</head>
<body id="home">
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
  <div class="main"><?php $input=9;$stmt=$conn->prepare("SELECT * FROM book WHERE book_id=:id");
  $stmt->bindParam(":id",$input);
  $stmt->execute();
  while($record=$stmt->fetch()){  ?>
    <div class="book-display">
      <div style="position: relative;
      width: 250px;
      height: 350px;
      margin-left: 121.5px;
      background: url('<?php echo $record['filepath']; ?>');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      float: left;"></div>
      <div class="info">
        <h2 class="book-title"><?php echo $record['title']; ?></h2>
        <h3 class="book-author">by <?php echo $record['author']; ?></h3>
        <h3 class="book-price"><?php echo '$'.$record['price']; ?></h3>
          <?php } ?>
        <form>
          <label for="book-amout">Amount</label>
          <input type="number" class="book-amount text-field">
          <input class="def-button add-to-cart" type="submit" name="" value="Add to cart">
        </form>
      </div>
    </div>
    <div class="trending-books horizontal-book-list">
      <h3 class="header">Trending</h3>
      <ul class="book-list">
        <?php echo trending($conn); ?>

      </ul>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
        <ul class="book-list">
          <div class="scroll-back"></div>
          <div class="scroll-front"></div>
          <?php echo bestSellingBook($conn); ?>

        </ul >
        <!--

        <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>
        <li class="book">
        <a href="#"><div class="book-cover"></div></a>
        <div class="book-price"><p>$250</p></div>
      </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$50</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$125</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$90</p></div>
        </li>-->

    </div>

  </div>
  <!-- footer starts here-->
  <div class="footer">
    <p class="copyright">&copy; copyright 2016</p>
  </div>
</body>
</html>
