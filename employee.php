<?php
//user.php

include('database_connection.php');

if(!isset($_SESSION["type"]))
{
	header('location:login.php');
}

// if($_SESSION["type"] != 'master')
// {
// 	header("location:index.php");
// }

include('includes/header.php');


?>
		<span id="alert_action"></span>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="row">
                        	<div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                            	<h3 class="panel-title">Employee List</h3>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align="right">
                            	<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#employeeModal" class="btn btn-success btn-xs">Add</button>
                        	</div>
                        </div>
                       
                        <div class="clear:both"></div>
                   	</div>
                   	<div class="panel-body">
                   		<div class="row"><div class="col-sm-12 table-responsive">
                   			<table id="employee_data" class="table table-bordered table-striped">
                   				<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Hourly Rate</th>
										<th>Daily Rate</th>
										<th>Hours per day</th>
										<th>Passcode</th>
										<th>Edit</th>
									</tr>
								</thead>
                   			</table>
                   		</div>
                   	</div>
               	</div>
           	</div>
        </div>
        <div id="employeeModal" class="modal fade">
        	<div class="modal-dialog">
        		<form method="post" id="employee_form">
        			<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Employee</h4>
        			</div>
        			<div class="modal-body">
        				<div class="form-group">
							<label>Enter Employee Name</label>
							<input type="text" name="employee_name" id="employee_name" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Enter Employee Passcode</label>
							<input type="text" name="employee_passcode" id="employee_passcode" class="form-control" required value="<?php echo $num = substr(str_shuffle("0123456789"), -4);?>" />
						</div>
						<div class="form-group">
							<label>Enter Employee Hourly Rate</label>
							<input type="number" name="employee_hrrate" id="employee_hrrate" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Enter Employee Daily Rate</label>
							<input type="number" name="employee_dlyrate" id="employee_dlyrate" class="form-control" required />
						</div>
						<div class="form-group">
							<label>Enter Employee Hours per Day</label>
							<input type="number" name="employee_hrperday" id="employee_hrperday" class="form-control" required />
						</div>
        			</div>
        			<div class="modal-footer">
        				<input type="hidden" name="employee_id" id="employee_id" />
        				<input type="hidden" name="btn_action" id="btn_action" value="Add" />
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
