<?php  
 //action.php  
 include 'crud.php';  
 $object = new Database();  
 if(isset($_POST["action"]))  
 {  
      if($_POST["action"] == "Load")  
      {  
           echo $object->get_data_in_table("SELECT * FROM users ORDER BY id DESC");  
      }  
      if($_POST["action"] == "Insert")  
      {  
           $first_name = mysqli_real_escape_string($object->connect, $_POST["first_name"]);  
           $last_name = mysqli_real_escape_string($object->connect, $_POST["last_name"]);  
           $image = $object->upload_file($_FILES["user_image"]);  
           $query = "  
           INSERT INTO users  
           (first_name, last_name, image)   
           VALUES ('".$first_name."', '".$last_name."', '".$image."')  
           ";  
           $object->execute_query($query);  
           echo 'Data Inserted';  
      }  
 }  
 ?>  