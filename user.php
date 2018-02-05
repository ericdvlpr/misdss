<?php
//user.php

include('database_connection.php');
include('function.php');

if(!isset($_SESSION["type"]))
{
	header('location:login.php');
}

if($_SESSION["type"] != 'master')
{
	header("location:index.php");
}

include('includes/header.php');


?>
		<span id="alert_action"></span>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="row">
                        	<div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                            	<h3 class="panel-title">User List</h3>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align="right">
                            	<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-xs">Add</button>
                        	</div>
                        </div>
                       
                        <div class="clear:both"></div>
                   	</div>
                   	<div class="panel-body">
                   		<div class="row"><div class="col-sm-12 table-responsive">
                   			<table id="user_data" class="table table-bordered table-striped">
                   				<thead>
									<tr>
										<th>ID</th>
										<th>Email</th>
                    <th>Name</th>
                    <th>Assign</th>
                    <th>Access</th>
										<th>Status</th>
										<th>Edit</th>
									</tr>
								</thead>
                   			</table>
                   		</div>
                   	</div>
               	</div>
           	</div>
        </div>
        <div id="userModal" class="modal fade">
        	<div class="modal-dialog">
              		<form method="post" id="user_form">
              			<div class="modal-content">
              			<div class="modal-header">
              				<button type="button" class="close" data-dismiss="modal">&times;</button>
      						<h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
              			</div>
              			<div class="modal-body">
                    		<div class="form-group">
            							<label>Enter User Name</label>
            							<input type="text" name="user_name" id="user_name" class="form-control" required />
            						</div>
            						<div class="form-group">
            							<label>Enter User Email</label>
            							<input type="email" name="user_email" id="user_email" class="form-control" required />
            						</div>
            						<div class="form-group">
            							<label>Enter User Password</label>
            							<input type="password" name="user_password" id="user_password" class="form-control" required />
            						</div>
                        <div class="form-group">
                          <label>Assign Employee</label>
                           <select name="user_assign" id="user_assign" class="form-control" required />
                           <?php echo fill_employee_list($connect); ?>
                            </select>
                        </div>
                        <div class="form-group">
                          <label>Enter User Access</label>
                           <select name="user_type" id="user_type" class="form-control" required />
                                  <option value="">Please Select</option>
                                  <option value="sale">Sales</option>
                                  <option value="payroll">Payroll</option>
                                  <option value="inventory">Inventory</option>
                            </select>
                        </div>
        			   </div>
        			<div class="modal-footer">
        				<input type="hidden" name="user_id" id="user_id" />
        				<input type="hidden" name="btn_action" id="btn_action" />
        				<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			</div>
        		</div>
        		</form>

        	</div>
        </div>

<?php
include('includes/footer.php');
?>
