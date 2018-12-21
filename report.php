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
		<div class="panel panel-default">
			<div class="panel-heading"><h3 >REPORT</h3></div>
				 <div class="panel-body">
					<form class="form-inline" id="reportForm">
						<div class="form-group">
							<label class="col-sm-5">Report Type: </label>
							<div class="col-sm-7">
								<select class="form-control" id='reportType' required>
									<option value="">PLEASE SELECT</option>
									<option value="inventory">Inventory</option>
									<option value="sales">Sales</option>
									<option value="payroll">Payroll</option>
									<option value="employee">Employee</option>
									<option value="dtr">DTR</option>
								</select>
							</div>
						</div>
						<button type="button" name="submit" class="btn btn-default" id="submit">Submit</button>
					</form>
					<div class="btn-group pull-right" id="print"  style="display: none ;">

                     <button class="btn btn-default" id="print" onclick="printContent('div1')"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> PRINT</button>
			        </div>
			        <br />
					<div class="col-md-12" id="employee" style="display: none ;">
						<div class="panel panel-default employee_report">
							<div class="panel-heading">
								<strong>TOTAL NUMBER EMPLOYEE</strong>

							</div>
							<div class="panel-body" align="center">
								<?php echo get_total_employee($connect); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="sales" style="display:none;">
							<div class="row">
							     <div class="input-daterange">
							      <div class="col-md-3">
							       <input type="date" name="start_date" id="order_start_date" class="form-control" />
							      </div>
							      <div class="col-md-3">
							       <input type="date" name="end_date" id="order_end_date" class="form-control" />
							      </div>      
							     </div>
							     <div class="col-md-3">
							      <input type="button" name="search" id="search_order" value="Search" class="btn btn-info" />
							     </div>
						    </div>
						    <br />
						<div class="panel panel-default sales_report">
							<div class="panel-heading">
								<strong>TOTAL SALES</strong>

							</div>
							<div class="panel-body" align="center">
								<div class="table-responsive">
									<table id="order_report" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Order ID</th>
												<th>Customer Name</th>
												<th>Total Amount</th>
												<th>Payment Status</th>
												<th>Order Date</th>
												
											</tr>
										</thead>
										<tbody></tbody>
										<tr><td colspan="6" align="right"><b>Total Daily Sales:</b> <span id="totalDailyOrder"></span></td></tr>
										<tr><td colspan="6" align="right"><b>Total Weekly Sales: </b><span id="totalWeeklyOrder"></span></td></tr>
										<tr><td colspan="6" align="right"><b>Total Monthly Sales:</b> <span id="totalMonthlyOrder"></span></td></tr>
										<tr><td colspan="6" align="right"><b>Total Yearly Sales: </b><span id="totalYearlyOrder"></span></td></tr>
										</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="inventory" style="display: none;">
						<div class="panel panel-default inventory_report">
							<div class="panel-heading">
								<strong>TOTAL INVENTORY</strong>

							</div>
							<div class="panel-body" align="center">
								<?php echo get_total_inventory($connect); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="payroll" style="display: none;">
						<div class="panel panel-default payroll_report">
							<div class="panel-heading">
								<strong>TOTAL PAYROLL</strong>

							</div>
							<div class="panel-body" align="center">
								<!-- <?php //echo get_total_payroll($connect); ?> -->
								<div class="table-responsive">
									<table id="payroll_table" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Employee ID</th>
												<th>Employee Name</th>
												<th>Position</th>
												<th>Hours Worked per day</th>
												<th>Days Worked</th>
												<th>Daily Rate</th>
												<th>Gross Income</th>
												<th>Absences</th>
												<th>Late</th>
												<th>SSS</th>
												<th>PagIbig</th>
												<th>PhilHealth</th>
												<th>Net Income</th>
											</tr>
										</thead>
										<tbody></tbody>
										<tr><td colspan="13" align="right"><b>Total Hours Worked:</b> <span id="totalHoursWorked"></span></td></tr>
										<tr><td colspan="13" align="right"><b>Total Days Worked:</b> <span id="totalDaysWorked"></span></td></tr>
										<tr><td colspan="13" align="right"><b>Total Gross Salary:</b> <span id="totalGrossSalary"></span></td></tr>
										<tr><td colspan="13" align="right"><b>Total SSS Remittance: </b><span id="totalSSSRemit"></span></td></tr>
										<tr><td colspan="13" align="right"><b>Total Pagibig Remittance:</b> <span id="totalPAGIBIGRemit"></span></td></tr>
										<tr><td colspan="13" align="right"><b>Total PhilHealth Remittance: </b><span id="totalPHILHEALTHRemit"></span></td></tr>
										<tr><td colspan="13" align="right"><b>Total Net Income Remittance: </b><span id="totalNetIncome"></span></td></tr>
										</table>
							</div>
						</div>
					</div>
					<div class="col-md-12" id="dtr" style="display: none;">
						<div class="row">
						     <div class="input-daterange">
						      <div class="col-md-3">
						       <input type="date" name="start_date" id="dtr_start_date" class="form-control" />
						      </div>
						      <div class="col-md-3">
						       <input type="date" name="end_date" id="dtr_end_date" class="form-control" />
						      </div>      
						     </div>
						     <div class="col-md-3">
						      <input type="button" name="search" id="search_dtr" value="Search" class="btn btn-info" />
						     </div>
						    </div>
						    <br />
						<div class="panel panel-default dtr_report">
							<div class="panel-heading">
								<strong>DAILY TIME RECORD</strong>

							</div>
							<div class="panel-body"  align="center">
								<?php //echo get_daily_time_record($connect); ?>
								<div class="table-responsive">
									<table id="dtr_report_table" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Employee Name</th>
												<th>Position</th>
												<th>Date</th>
												<th>Time In</th>
												<th>Time Out</th>
												<th>Total Hours Worked</th>
											</tr>
										</thead>
										<tbody></tbody>
										
										</table>
								</div>

							</div>
						</div>
					</div>
				</div>
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
		        			<table class="table table-striped">
		        				<tr>
		        					<td>Date</td>
		        					<td>Time In</td>
		        					<td>Time Out</td>
		        				</tr>
		        				<tbody id="dtr_table"></tbody>
		        			</table>
	        		</div>
	       		 </div>
        	</div>
      </div>

<?php
include("includes/footer.php");
?>