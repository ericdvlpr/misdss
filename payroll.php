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
<!-- To DO  add deduction when absent and display employee logs -->
		<span id="alert_action"></span>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
                    <div class="panel-heading">
                    	<div class="row">
                        	<div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                            	<h3 class="panel-title">Payroll List</h3>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align="right">
                            	<button type="button" name="add" id="add_button" data-toggle="modal" data-target="#payrollModal" class="btn btn-success btn-xs">Add</button>
                        	</div>
                        </div>
                       
                        <div class="clear:both"></div>
                   	</div>
                   	<div class="panel-body">
                   		<div class="row"><div class="col-sm-12 table-responsive">
                   			<table id="payroll_data" class="table table-bordered table-striped">
                   				<thead>
									<tr>
										<th>ID</th>
										<th>Employee Name</th>
										<th>Hours Worked</th>
										<th>Days Worked</th>
										<th>SSS</th>
										<th>Pag Ibig</th>
										<th>Phil Health</th>
										<!-- <th>Tax</th> -->
										<th>Net Income</th>
										<th>Month of</th>
										<th>Command</th>
										
									</tr>
								</thead>
                   			</table>
                   		</div>
                   	</div>
               	</div>
           	</div>
        </div>
        <div id="payrollModal" class="modal fade">
        	<div class="modal-dialog">
        		<form method="post" id="payroll_form">
        			<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Payroll</h4>
        			</div>
        			<div class="modal-body">
        				<div class="form-group">
							<label>Enter Employee Name</label>
							<select name="employee_id" id="employee_id" class=" form-control selectpicker" data-live-search="true" required>
								<option value="">Please Select</option>
								<?php 
									$query = '';
									$query .= "
									SELECT * FROM employee_details WHERE employee_status ='Active'";
									$statement = $connect->prepare($query);

									$statement->execute();

									$result = $statement->fetchAll();
									foreach($result as $row)
									{
										echo " <option value='".$row['employee_id']."'>".$row['employee_name']."</option>";	
									}

								 ?>
							 
							</select>
							<input type="hidden" name="employee_name" id="employee_name" />
						</div>
						<div class="form-group">
							<label>Enter Employee Hours Worked</label>
							<input type="number" name="employee_hrwk" id="employee_hrwk" class="form-control" required readonly="true" />
						</div>
						<div class="form-group">
							<label>Enter Employee Days Worked</label>
							<input type="number" name="employee_dyswk" id="employee_dyswk" class="form-control" required readonly="true" />
						</div>
						<div class="form-group">
							<label>SSS Contribution</label>
							<input type="number" name="employee_sss" id="employee_sss" class="form-control" required readonly="true" />
						</div>
						<div class="form-group">
							<label>PhilHealth Contribution</label>
							<input type="number" name="employee_phhealth" id="employee_phhealth" class="form-control" required readonly="true" />
						</div>
						<div class="form-group">
							<label>Pag Ibig Contribution</label>
							<input type="number" name="employee_pgibig" id="employee_pgibig" class="form-control" required readonly="true" />
						</div>
						<div class="form-group">
							<label>Net Income</label>
							<input type="number" name="employee_netincome" id="employee_netincome" class="form-control" required readonly="true" />
						</div>
        			</div>
        			<div class="modal-footer">
        				<input type="hidden" name="payroll_id" id="payroll_id" />
        				<input type="hidden" name="btn_action" id="btn_action" value="Addpayroll" />
        				<input type="submit" name="action" id="action" class="btn btn-info" value="Add" disabled/>
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			</div>
        		</div>
        		</form>

        	</div>
        </div>
        <div id="dtrModal" class="modal fade">
        	<div class="modal-dialog">
        		<div class="modal-content">
	        			<div class="modal-header">
	        				<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Add Payroll</h4>
	        			</div>
	        			<div class="modal-body">
		        		<table  class="table table-striped">
		        			<thead>
		        				<tr>
		        					<td>Date</td>
		        					<td>Time In</td>
		        					<td>Time Out</td>
		        				</tr>
		        			</thead>
		        			<tbody id="dtr_table"></tbody>
		        		</table>

	        		</div>
	       		 </div>
        	</div>
      </div>

<?php
include('includes/footer.php');
?>
