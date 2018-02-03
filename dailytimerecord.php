<?php
//index.php
include('database_connection.php');
include('function.php');

if(!isset($_SESSION["type"]))
{
	header("location:login.php");
}

include('includes/head.php');

?>
	<br />
<div class="container">
	<div class="row">
		<div class="page-header">
			<h1 class="text-center">DAILY TIME RECORD</h1>
		</div>
  		<div class="col-xs-6 col-md-4">
  			<div class="well">
  				<form class="form-horizontal" id="dtr_form" method="POST">
  					<h3 class="page-header">Please Enter Required Data</h3>
					  <div class="form-group" method="POST" id="dtr_form">
					    <label for="inputEmail3" class="col-sm-3 control-label">Employee Name</label>
					    <div class="col-sm-9">
					      <select name="employee_name" id="employee_name" class=" form-control" data-live-search="true" required>
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
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
					    <div class="col-sm-9">
					      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
					    </div>
					  </div>
					  <div class="form-group">
					  	<label for="inputPassword3" class="col-sm-3 control-label">Status</label>
					    <div class="col-sm-9">
							<select class="form-control" name="status" id="status" required>
								<option value="">Please Select</option>
								<option value="in">In</option>
								<option value="out">Out</option>
							</select>
					    </div>
					  </div>
					  <div class="form-group">
					  			<label for="inputPassword3" class="col-sm-3 control-label">Remarks</label>
					    <div class="col-sm-9">
							<textarea class="form-control" name="remarks" id="remarks" cols="3" rows="5">
								
							</textarea>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-default">Sign in</button>
					    </div>
					  </div>

        				<input type="hidden" name="btn_action" id="btn_action" value="Add" />
					</form>
  			</div>
  		</div>
		<div class="col-xs-12 col-sm-6 col-md-8">
			<table class="table table-striped" name='dtr_data'  id='dtr_data'>
			 	<tr>
			 		<td>Employee Name</td>
			 		<td>Date</td>
			 		<td>Time</td>
			 		<td>Status</td>
			 		<td>Remarks</td>
			 	</tr>
			 	<?php 
			 		$query = '';
					$query .= "
					SELECT * FROM dtr d JOIN employee_details e USING (employee_id)";
					$statement = $connect->prepare($query);

					$statement->execute();

					$result = $statement->fetchAll();
					foreach($result as $row)
					{
						if($row['status']=='in'){
							$status = "<span class='label label-success'>IN</span>";
						}else{
							$status = "<span class='label label-danger'>OUT</span>";
						}
						if($row['status']=='out'){
							$time = $row['time_out'];
						}else{
							$time = $row['time_in'];
						}
						echo "<tr>
								<td>".$row['employee_name']."</td>
								<td>".$row['date']."</td>
								<td>".$time."</td>
								<td>".$status."</td>
								<td>".$row['remarks']."</td>
							</tr>";	
					}
			 	 ?>
			</table>
		</div>
	</div>
</div>
<?php
include("includes/footer.php");
?>