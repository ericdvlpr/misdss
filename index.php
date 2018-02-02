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
<!-- To DO  Finish Design Dashboard -->
	<br />
	<div class="row">
	<?php
	if($_SESSION['type'] == 'master')
	{
	?>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>TOTAL USER</strong></div>
			<div class="panel-body" align="center">
				<h1><?php echo count_total_user($connect); ?></h1>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>TOTAL CATEGORY</strong></div>
			<div class="panel-body" align="center">
				<h1><?php echo count_total_category($connect); ?></h1>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>TOTAL BRAND</strong></div>
			<div class="panel-body" align="center">
				<h1><?php echo count_total_brand($connect); ?></h1>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>TOTAL ITEM IN STOCK</strong></div>
			<div class="panel-body" align="center">
				<h1><?php echo count_total_product($connect); ?></h1>
			</div>
		</div>
	</div>
	<?php
	}elseif($_SESSION['type'] == 'sale')
	{
	?>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>TOTAL ORDER VALUE</strong></div>
				<div class="panel-body" align="center">
					<h1>$<?php echo count_total_order_value($connect); ?></h1>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>TOTAL CASH ORDER VALUE</strong></div>
				<div class="panel-body" align="center">
					<h1>$<?php echo count_total_cash_order_value($connect); ?></h1>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>TOTAL CREDIT ORDER VALUE</strong></div>
				<div class="panel-body" align="center">
					<h1>$<?php echo count_total_credit_order_value($connect); ?></h1>
				</div>
			</div>
		</div>
		<hr />
		<?php }elseif($_SESSION['type'] == 'inventory'){ ?>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>TOTAL CATEGORY</strong></div>
					<div class="panel-body" align="center">
						<h1><?php echo count_total_category($connect); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>TOTAL BRAND</strong></div>
					<div class="panel-body" align="center">
						<h1><?php echo count_total_brand($connect); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>TOTAL ITEM IN STOCK</strong></div>
					<div class="panel-body" align="center">
						<h1><?php echo count_total_product($connect); ?></h1>
					</div>
				</div>
			</div>
		<?php }elseif($_SESSION['type'] == 'payroll'){ ?>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>TOTAL PAYROLL</strong></div>
					<div class="panel-body" align="center">
						<h1><?php echo count_total_payroll($connect); ?></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>TOTAL EMPLOYEE</strong></div>
					<div class="panel-body" align="center">
						<h1><?php echo count_total_employee($connect); ?></h1>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php
		if($_SESSION['type'] == 'master')
		{
		?>
<!-- 		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>TOTAL ORDER VALUE USER WISE</strong></div>
				<div class="panel-body" align="center">
					<?php// echo get_user_wise_total_order($connect); ?>
				</div>
			</div>
		</div> -->
		<?php
		}
		?>
	</div>

<?php
include("includes/footer.php");
?>