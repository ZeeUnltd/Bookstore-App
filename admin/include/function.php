<?php
    function page_protect(){

	if(!isset($_SESSION['email']) && !isset($_SESSION['admin_id'])) {

			header("Location:login.php");
		}else {
		  $_GET['email']= $email_id;
      $_GET['admin_id']= $admin_id;
 		}
    }

    function userCheckEmail($dbconn,$input){
      $result=false;
      $stmt=$dbconn->prepare("SELECT email FROM users WHERE email=:em");
      $stmt->bindparam(":em", $input);
      $stmt-execute();
      $count=$stmt->rowCount();
      if($count > 0){
        $result=true;
      }
        return $result;
    }


    function doesEmailExist($dbconn, $input){
      $result=false;

      $stmt = $dbconn->prepare("SELECT email FROM admin WHERE email=:em");
      $stmt->bindparam(":em", $input);
      $stmt->execute();
      $count =$stmt->rowCount();
      if($count > 0){
        $result=true;
      }
      return $result;
    }

    function displayErrors($error, $field){
      $result= "";

      if(isset($error[$field])){
        $result = '<spam class="err">'.$error[$field].'</spam>';
      }
      return $result;
    }

    function doAdminRegister($dbconn, $input){
      $hash=password_hash($input['password'], PASSWORD_BCRYPT);

      #insert data
      $stmt =$dbconn->prepare("INSERT INTO admin (firstname, lastname, email, hash) VALUES (:fn,:ln,:e,:h)");
      #bind Parameters...
      $data =[ ':fn' => $input['fname'],
                ':ln'=> $input['lname'],
                ':e'=> $input['email'],
                ':h'=> $hash];
                $stmt-> execute($data);
    }

    function dbUserRegister($dbconn,$input) {
   #hash the password
   $hash = password_hash($input['password'], PASSWORD_BCRYPT);

   #insert data
   $stmt = $dbconn->prepare("INSERT INTO users(firstName, lastName, email,username, hash) VALUES(:fn, :ln, :e,:us, :h)");
   #bind params
   $data = [
     ':fn' => $input['fname'],
     ':ln' => $input['lname'],
     ':e'  => $input['email'],
     ':us'  => $input['uname'],
     ':h'  => $hash
   ];

     $stmt->execute($data);
      $success = "Registration Successfully ";

            header("Location:registration.php?success=$success");
   }


    function addCategory($dbconn, $input){
      $stmt=$dbconn->prepare("INSERT INTO categories(category_name,upload_date) VALUES(:cn,NOW())");
      $stmt->bindParam(':cn',$input);
      #$stmt->bindParam(0, $input['cat_name']);
      $stmt->execute();
      $success= "Category Succefully Addded";
      header("Location:categories.php?success=$success");
    }

      function viewCategories($dbconn){

            $stmt = $dbconn->prepare("SELECT * FROM categories");
            $stmt->execute();
            while ($record = $stmt->fetch()) {

            echo "<tr>";
            echo "<td>".$record['category_name']."</td>";
            echo "<td>".$record['category_id']."</td>";
            echo "<td>".$record['upload_date']."</td>";
            echo "<td><a href=\"edit_category.php?id=" .$record['category_id']. "&name=" .$record['category_name']. "\">edit</a></td>";
            echo "<td><a href=\"delete_category.php?id=" .$record['category_id']."\">delete</a></td>";
            echo "</tr>";

              # code...
            }

}
    function editCategory($dbconn,$input, $post){
      $stmt=$dbconn->prepare("UPDATE categories SET category_name=:nm WHERE category_id=:cid");
      $stmt->bindParam(":nm", $input);
      $stmt->bindParam(":cid", $post);
      $stmt->execute();
      header("Location:categories.php?Succefully Edited");
    }

    function editCategory2($dbconn, $input, $id){
      $stmt= $dbconn->prepare("UPDATE categories SET (category_name=:ca) WHERE category_id=:cid");
      $data=[ ":ca"=> $input['category_name'],
              ":cid"=> $id];
    }

    function deleteCategory($dbconn, $get){

        $stmt= $dbconn->prepare("DELETE FROM categories WHERE category_id=:cid");
        $stmt->bindParam(":cid", $get);
        $stmt->execute();

        header('Location:categories.php?msg=Category_deleted_successfully');


    }


    function getCategoryById($dbconn, $cid){
      $stmt =$dbconn->prepare("SELECT category_name FROM categories WHERE category_id=:cid");
      $stmt->bindParam(":cid, $cid");
      $stmt->execute();
      $row=$stmt->fetch(PDO::FETCH_BOTH);
      return $row;
    }



    function makeSticky ($field){
      $result =[];
      if(isset($_POST[$field])){
        $result=$_POST[$field];
        echo $result;
      }
    }unset ($result);

    function doAdminLogin($dbconn, $input){
      $result =[];

      $stmt =$dbconn->prepare("SELECT * FROM admin WHERE email=:e");
      $stmt->bindParam(":e",$input['email']);
      $stmt->execute();
      $row=$stmt->fetch(PDO::FETCH_ASSOC);
      #print_r($row);exit();
      #get Number of rows returned
      $count=$stmt->rowCount();
      if($count != 1 || !password_verify($input['password'],$row['hash'])){
        $result[]=false;
        #
        #Another way!
        #if($stmt->rowCount() != 1 || !password_verify($input['password'],$row['hash'])){
        #  $result[]=false;

    echo '<span class="err">Bad Credentials, Please check and re-try </span>';


      } else {
        $result[] = true;
        $result[] =$row['admin_id'];
      }
      return $result;
    }


  function redirect($loc){
      header("Location:$loc");}






    function switchPages(){};

    function fileupload($fileArray, $imageName){
      #generate random number to AppendIterator
      $rnd =rand(0000000000, 9999999999);

      #Strip Filenamefor spaces
      $strip_name =str_replace(" ", "_", $fileArray[$imageName]['name']);

      $filename =$rnd.$strip_name;
      $destination ='uploads/'.$filename;

      if(!move_uploaded_file($fileArray[$imageName]['tmp_name'], $destination)){
          return [false, $destination];
      }
      return [true, $destination];
    }

/*    function addproduct($dbconn, $input, $destin){
      $stmt=$dbconn->prepare("INSERT INTO book VALUE(NULL, :bt, :au, :id, :bpr, :yr, :is, :fi, :flag)");
      #bind Parameters
      $data=[
        ":bt" => $input['btitle'],
        ":au" => $input['bauthor'],
        ":id" => $input['category'],
        ":bpr"=> $input['bprice'],
        ":yr"=> $input['year'],
        ":is"=> $input['isbn'],
        ":fi"=> $destin,
        ":flag"=> $input['flag'],
      ];
      $stmt->execute($data);
    }*/

    function addProducts($dbconn,$post){
    $stmt=$dbconn->prepare("INSERT INTO book(book_id,title,author,category_id,price,year,ISBN,filepath,flag) VALUES(NULL,:title,:author,:cat_id,:price,:year,:IS,:im,:fl)");
            $stmt->bindParam(":title",  $post['title']);
            $stmt->bindParam(":author", $post['author']);
            $stmt->bindParam(":cat_id", $post['category']);
            $stmt->bindParam(":price",  $post['price']);
            $stmt->bindParam(":year",   $post['year']);
            $stmt->bindParam(":IS",     $post['isbn']);
            $stmt->bindParam(":im",     $post['dest']);
            $stmt->bindParam(":fl",     $post['flag']);

            $stmt->execute();

            $success = "Product Successfully Added";

            header("Location:products.php?success=Product_Added$success&name=1");
    }

function uploadFiles($input, $name, $upDIR){
      $result = [];

   		#generate random number to append
    	$rnd = rand(0000000000, 9999999999);

    	#strip filename for spaces
    	$strip_name = str_replace(" ","_", $input[$name]['name']);

    	$filename = $rnd.$strip_name;
    	$destination = $upDIR.$filename;

    	if(!move_uploaded_file($input[$name]['tmp_name'], $destination)) {
        $result[] = false;
    	} else {
        $result[] = true;
        $result[] = $destination;
      }

      return $result;
	}

    function getcatbyid($dbconn, $cid){
      $stmt =$dbconn->query("SELECT category_name FROM categories WHERE category_id = $cid");
      while($chk = $stmt->fetch()){
        $name = $chk['category_name'];
      }

      return $name;
    }

      function getCategory($dbconn){

    $stmt =$dbconn->prepare("SELECT * FROM categories");
    $stmt->execute();
    while ($record = $stmt->fetch()){
    $cat_id = $record['category_id'];
    $cat_name = $record['category_name'];
    $result .= "<option value='$cat_id'>$cat_name</option>";
     }
     return $result;
    }
     function getRowdata($dbconn, $input){

       $stmt=$dbconn->prepare("SELECT * FROM admin WHERE admin_id=:id");
       $stmt->bindParam(":id", $input);
       $stmt->execute();
       $row=$stmt->fetch(PDO::FETCH_ASSOC);
       return $row;
     }
     // getEditRowdata to be merged with getRowdata later, whem i'm free
     function getEditRowdata($dbconn, $input){

       $stmt=$dbconn->prepare("SELECT * FROM book WHERE book_id=:id");
       $stmt->bindParam(":id", $input);
       $stmt->execute();
       $row=$stmt->fetch(PDO::FETCH_ASSOC);
       return $row;
     }


     function editProducts($dbconn, $input, $dest){
       $input['book_id']= $id;
       $dest= $input['filepath'];
       $stmt= $dbconn->prepare("UPDATE  book SET
                         title =  ':t',
                         author =  ':au',
                         category_id =  ':cat',
                         price =  ':p',
                         year =  'y',
                         ISBN =  ':i',
                         filepath = ':fp',
                         flag =  ':fl' WHERE book_id = $id");
       $data=[  ':t' =>   $input['title'],
                ':au'=>   $input['author'],
                ':cat'=>  $input['category'],
                ':p'=>    $input['price'],
                ':y'=>    $input['year'],
                ':i'=>    $input['isbn'],
                ':fp'=>   $input['dest'],
                ':fl'=>   $input['flag']];

        $stmt->execute($data);
        header("Location:products.php?msg= Successfully Edited");
     }

     function viewProducts($dbconn){
            $result =[];
           $stmt = $dbconn->prepare("SELECT * FROM book");
           $stmt->execute();
           while ($record = $stmt->fetch()) {

             $result=$record['book_id'];
           echo "<tr>";
           echo "<td>".$record['book_id']."</td>";
           echo "<td>".$record['title']."</td>";
           echo "<td>".$record['author']."</td>";
           echo "<td>".$record['price']."</td>";
           echo "<td>".$record['year']."</td>";
           echo "<td>".$record['ISBN']."</td>";
           echo "<td>".$record['flag']."</td>";
           echo "<td><a href=\"edit_product.php?id=" .$result. "&name=" .$record['title']. "\">edit</a></td>";
           echo "<td><a href=\"delete_category.php?id=" .$record['category_id']."\">delete</a></td>";
           echo "</tr>";

             //$result =$_GET['book_id'];
           }return $result;

}
 function getProductByID($dbconn, $id){
   $stmt=$dbconn->prepare("SELECT filepath FROM book WHERE book_id =$id");
   $stmt->bindparam($id);
   $stmt->fetch(PDO::FETCH_ASSOC);
   $row=$stmt->execute();
   return $row;

 }




 ?>
