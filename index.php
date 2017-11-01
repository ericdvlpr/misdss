<?php include 'includes/header.php';?>  
<div class="container box">  
                <h3 align="center">PHP Ajax Crud using OOPS - Insert or Add Mysql Data</h3><br />  
                <button type="button" name="add" class="btn btn-success" data-toggle="collapse" data-target="#user_collapse">Add</button>  
                <br /><br />  
                <div id="user_collapse" class="collapse">  
                     <form method="post" id="user_form">  
                          <label>Enter First Name</label>  
                          <input type="text" name="first_name" id="first_name" class="form-control" />  
                          <br />  
                          <label>Enter Last Name</label>  
                          <input type="text" name="last_name" id="last_name" class="form-control" />  
                          <br />  
                          <label>Select User Image</label>  
                          <input type="file" name="user_image" id="user_image" />  
                          <br />  
                          <div align="center">  
                               <input type="hidden" name="action" id="action" />  
                               <input type="submit" name="button_action" id="button_action" class="btn btn-default" value="Insert" />  
                          </div>  
                     </form>  
                </div>  
                <br /><br />  
                <div id="user_table" class="table-responsive">  
                </div>  
           </div>  
<?php 
include 'includes/footer.php';
?>
