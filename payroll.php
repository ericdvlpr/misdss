<?php include 'includes/header.php';?>
    <div class="container-fluid">
      <div class="row">
       <?php include 'includes/sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </div>

          <h2 class="sub-header">Section title</h2>
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
      </div>
    </div>
<?php 
include 'includes/footer.php';
?>
