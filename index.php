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
				<div class="col-lg-3 col-md-6" >
				    <div class="panel panel-default" >
				        <div class="panel-heading" style="background-color: #1E8BC3;color: #ffffff;">
				            <div class="row">
				                <div class="col-xs-3">
				                    <h1><span class="glyphicon glyphicon-user" style="color: #ffffff;"></span></h1>
				                </div>
				                <div class="col-xs-9 text-right">
				                    <div class="huge"><h2 style="color: #ffffff;"><?php echo count_total_user($connect); ?></h2></div>
				                    <div>USERS</div>
				                </div>
				            </div>
				        </div>
				        <a href="users">
				            <div class="panel-footer">
				                <span class="pull-left">View Details</span>
				                <span class="pull-right"><span class="glyphicon glyphicon-circle-arrow-right"></span></span>
				                <div class="clearfix"></div>
				            </div>
				        </a>
				    </div>
				</div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <h1><span class="glyphicon glyphicon-shopping-cart" style="color: #ffffff;"></span></h1>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><h2 style="color: #ffffff;"><?php echo count_total_product($connect); ?></h2></div>
                                    <div>PRODUCTS</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><span class="glyphicon glyphicon-circle-arrow-right"></span></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <h1><span class="glyphicon glyphicon-list-alt" h2 style="color: #ffffff;"></span></h1> 
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><h2 style="color: #ffffff;"><?php echo count_total_order_value($connect); ?></h2></div>
                                    <div>ORDER</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><span class="glyphicon glyphicon-circle-arrow-right"></span></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <h1><span class="glyphicon glyphicon-file" style="color: #ffffff;"></span></h1>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><h1 style="color: #ffffff;"><?php echo count_total_employee($connect); ?></h1></div>
                                    <div>EMPLOYEES</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><span class="glyphicon glyphicon-circle-arrow-right"></span></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
             <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Recent Orders
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                  <?php echo get_total_sales($connect); ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Recent Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <?php echo get_total_inventory($connect); ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->  

	<?php
	}elseif($_SESSION['type'] == 'sale')
	{
	?>
	<div class="row">
             <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                   Recent Orders
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                          <?php echo get_total_sales($connect); ?>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
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
			<!-- <div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>TOTAL ITEM IN STOCK</strong></div>
					<div class="panel-body" align="center">
						<h1><?php //echo count_total_product($connect); ?></h1>
					</div>
				</div>
			</div> -->
			<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Recent Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <?php echo get_total_inventory($connect); ?>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->  
		<?php }elseif($_SESSION['type'] == 'payroll'){ ?>
		<div class="row">
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