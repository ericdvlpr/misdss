<?php
//index.php
include('database_connection.php');
include('function.php');

if(!isset($_SESSION["type"]))
{
	header("location:login.php");
}

include('includes/header.php');

?>
	<br />
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 >REPORT</h3></div>
				 <div class="panel-body">
					<form class="form-inline" id="reportForm">
						<div class="form-group">
							<label class="col-sm-5">Report Type: </label>
							<div class="col-sm-7">
								<select class="form-control" id='reportType'>
									<option value="">PLEASE SELECT</option>
									<option value="inventory">Inventory</option>
									<option value="sales">Sales</option>
									<option value="payroll">Payroll</option>
									<option value="employee">Employee</option>
								</select>
							</div>
						</div>
					</form>
					<div class="btn-group pull-right" id="print"  style="display: none ;">
                        <button class="btn btn-default" id="print" onclick="printContent('div1')"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> PRINT</button>
			        </div>
			        <br />
					<div class="col-md-12" id="employee" style="display: none ;">
						<div class="panel panel-default" id="div1">
							<div class="panel-heading">
								<strong>TOTAL NUMBER EMPLOYEE</strong>

							</div>
							<div class="panel-body" align="center">
								<?php echo get_total_employee($connect); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="sales" style="display:none;">
						<div class="panel panel-default" id="div1">
							<div class="panel-heading">
								<strong>TOTAL SALES</strong>

							</div>
							<div class="panel-body" align="center">
								<?php echo get_total_sales($connect); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="inventory" style="display: none;">
						<div class="panel panel-default" id="div1">
							<div class="panel-heading">
								<strong>TOTAL INVENTORY</strong>

							</div>
							<div class="panel-body" align="center">
								<?php echo get_total_inventory($connect); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="payroll" style="display: none;">
						<div class="panel panel-default" id="div1">
							<div class="panel-heading">
								<strong>TOTAL PAYROLL</strong>

							</div>
							<div class="panel-body" align="center">
								<?php echo get_total_payroll($connect); ?>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		

<?php
include("includes/footer.php");
?>