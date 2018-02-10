<?php
//header.php
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Management Information System And Decision Support</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" />
			<link rel="stylesheet" href="css/datepicker.css">
	
	<link rel="stylesheet" href="css/bootstrap-select.min.css">
	<!-- <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>	 -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
		
	</head>
	<body style="background-color:#D2D7D3;">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#">
		        <p>SOLA HANDICRAFT MANAGEMENT INFORMATION SYSTEM AND DECISION SUPPORT</p>
		      </a>
		    </div>
		  </div>
	</nav>
	<hr />
	<nav class="navbar navbar-default">

		<div class="container">
			<ul class="nav navbar-nav">
			<?php
			if($_SESSION['type'] == 'master')
			{
			?>
				<li><a href="index.php"><center><span class="glyphicon glyphicon-home" aria-hidden="true"></span><br />DashBoard</center></a></li>
				<li><a href="user.php"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span><br />User</center></a></li>
				<li><a href="category.php"><center><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><br />Category</center></a></li>
				<li><a href="brand.php"><center><span class="glyphicon glyphicon-tags" aria-hidden="true"></span><br />Brand</center></a></li>
				<li><a href="product.php"><center><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><br />Product</center></a></li>
				<li><a href="payroll.php"><center><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><br />Payroll</center></a></li>
				<li><a href="employee.php"><center><span class="glyphicon glyphicon-file" aria-hidden="true"></span><br />Employee</center></a></li>
				<li><a href="order.php"><center><span class="glyphicon glyphicon-plus-sign  " aria-hidden="true"></span><br />Order</center></a></li>
				<li><a href="report.php"><center><span class="glyphicon glyphicon-folder-close  " aria-hidden="true"></span><br />Report</center></a></li>

			<?php
			}elseif($_SESSION['type'] == 'sale')
			{?>
				<li><a href="index.php"><center><span class="glyphicon glyphicon-home" aria-hidden="true"></span><br />DashBoard</center></a></li>
				<li><a href="order.php"><center><span class="glyphicon glyphicon-plus-sign  " aria-hidden="true"></span><br />Order</center></a></li>
			
			<?php
			}elseif($_SESSION['type'] == 'payroll')
			{?>
				<li><a href="index.php"><center><span class="glyphicon glyphicon-home" aria-hidden="true"></span><br />DashBoard</center></a></li>
				<li><a href="payroll.php"><center><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span><br />Payroll</center></a></li>
				<li><a href="employee.php"><center><span class="glyphicon glyphicon-file" aria-hidden="true"></span><br />Employee</center></a></li>
		
			<?php 
				}elseif($_SESSION['type'] == 'inventory')
			{?>
				<li><a href="index.php"><center><span class="glyphicon glyphicon-home" aria-hidden="true"></span><br />DashBoard</center></a></li>
				<li><a href="category.php"><center><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><br />Category</center></a></li>
				<li><a href="brand.php"><center><span class="glyphicon glyphicon-tags" aria-hidden="true"></span><br />Brand</center></a></li>
				<li><a href="product.php"><center><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span><br />Product</center></a></li>
		
			<?php } ?>
				</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span><center><span class="glyphicon glyphicon-user  " aria-hidden="true"></span><br /><?php echo $_SESSION["user_name"]; ?></center></a>
					<ul class="dropdown-menu">
						<li><a href="profile.php">Profile</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</li>
			</ul>

		</div>
			</nav>
		<div class="container" style="background-color: white;margin-top: -20px;padding-top: 15px;">
			
			