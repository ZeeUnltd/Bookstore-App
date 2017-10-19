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
      $result = false;
      $stmt= $dbconn->prepare("SELECT email FROM users WHERE email=:e");
      $data= [':e' => $input];
      $stmt->execute($data);
      $count= $stmt->rowCount();
      if($count > 0){
        $result = true;
      }
        return $result;
    }


    function doesEmailExist($dbconn, $input){
      $result=false;

      $stmt = $dbconn->prepare("SELECT email FROM admin WHERE email=:em");
      $stmt->bindParam(":em", $input);
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

    function userRegister($dbconn, $input){
      $hash= password_hash($_input['password'], PASSWORD_BCRYPT);
      #insert
      $stmt=$dbconn->prepare("INSERT INTO users(user_id,username,firstname,lastname,email,hash) VALUES(NULL,:us,:fn,:ln,:em,:h)");
      $data=[':us'=>$input['uname'],
             ':fn'=>$input['fname'],
             ':ln'=>$input['lname'],
             ':em'=>$input['email'],
             ':h'=>$hash];
             $stmt-> execute($data);
             $success ="Registration Successful";
             header("Location:user_registration.php?success=$sucess");
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
            }

}

    function displayCategories($dbconn){
      $stmt =$dbconn->prepare("SELECT category_name FROM categories");
      $stmt->execute();
      while ($record = $stmt->fetch()){
        echo "<ul class=\"category-list\">";
        echo "<a href=\"catalogue.php?".$record['category_name']."\"><li class=\"category\">".$record['category_name']."</li></a>";
        echo "</ul>";
      }
      function displayProductsImage($dbconn){
        $stmt=$dbconn->prepare("SELECT * FROM book");
        $stmt->execute();
        $result="";
        while($record=$stmt->fetch(PDO::FETCH_ASSOC)){
          $result= $result. "<li class=\"book\">
            <a href=\"#\"><div class=\"book-cover\">".$record['filepath']."</div></a>
            <div class=\"book-price\"><p>".$record['price']."</p></div>
          </li>";
        } return $result;
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


    function getCategoryById($dbconn, $id){
      $stmt =$dbconn->prepare("SELECT category_name FROM categories WHERE category_id=:cid");
      $stmt->bindParam(":cid, $id");
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
        $result[] =$row;
      }
      return $result;
    }

    function doUserLogin($dbconn, $input){
      $result =[];

      $stmt =$dbconn->prepare("SELECT * FROM users WHERE email=:e");
      $stmt->bindParam(":e", $input);
      $stmt->execute($stmt);
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


      $errors['email']="Bad Credentials, Please check and re-try";

      } else {
        $result[] = true;
        $result[] =$row;
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

    function displaySingleProductDetail(){



    $stmt=$dbconn->prepare("INSERT INTO book(book_id,title,author,category_id,price,year,ISBN,filepath,flag) VALUES(NULL,:title,:author,:cat_id,:price,:year,:IS,:im,:fl)");

            $stmt->bindParam(":title",$post['title']);
            $stmt->bindParam(":author",$post['author']);
            $stmt->bindParam(":year",$post['year']);
            $stmt->bindParam(":IS",$post['isbn']);
            $stmt->bindParam(":im",$post['dest']);
            $stmt->bindParam(":cat_id",$post['category']);
            $stmt->bindParam(":price",$post['price']);
             $stmt->bindParam(":fl",$post['flag']);

            $stmt->execute();

             $success = "Product Successfully Added";

             header("Location:admin_home.php?success=Product Added$success");

}

function uploadFiles($input, $name, $upDIR){
      $result = [];

   		#generate random number to append
    	$rnd = rand(0000000000, 9999999999);

    	#strip filename for spaces
    	$strip_name = str_replace("","_", $input[$name]['name']);

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






    /*function fetchCategories($resultSet){
    $resultSet= [];
    $resultSet=$conn->prepare("SELECT * FROM category_name");
    $resultSet->excecute();
    $row=$resultSet->fetch(PDO::FETCH_ASSOC);
                    echo "<select>";
                    foreach ($row as $key => $value) {
                      echo '<option value="'.$key.'">'.$value.'</option>';

                    }
                    echo "</select>";
                  };*/

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

    function trending($dbconn){
      $stmt=$dbconn->prepare("SELECT * FROM book WHERE flag= 'trending'");
      $stmt->execute();
      $result= "";
      while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $result = $result .

       "<li class='book'>".
            "<a href='bookpreview.php?book_id=".$row['book_id']."'>".
              "<div class='book-cover' style=\"background: url('" . $row['filepath'] . "');".
                        "background-size: cover; background-position: center; background-repeat: no-repeat;\">".
              "</div>".
            "</a>".
          "<div class='book-price'><p>$" . $row['price'] ."</p></div>".
        "</li>";
      }
     return $result;
    }

    function bestSellingBook($dbconn){
      $stmt=$dbconn->prepare("SELECT * FROM book WHERE flag = 'top-selling'"); $stmt->execute();
      $result= "";
      while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $result = $result .

       "<li class='book'>".
            "<a href='bookpreview.php?book_id=".$row['book_id']."'>".
              "<div class='book-cover' style=\"background: url('" . $row['filepath'] . "');".
                        "background-size: cover; background-position: center; background-repeat: no-repeat;\">".
              "</div>".
            "</a>".
          "<div class='book-price'><p>$" . $row['price'] ."</p></div>".
        "</li>";
      }
     return $result;
    }






 ?>
