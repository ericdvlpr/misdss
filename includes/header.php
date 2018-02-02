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
		
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
		
	</head>
	<body>
		<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a href="index.php" class="navbar-brand">SOLA HANDICRAFT MISDSS</a>
					</div>
					<ul class="nav navbar-nav">
					<?php
					if($_SESSION['type'] == 'master')
					{
					?>
						<li><a href="user.php">User</a></li>
						<li><a href="category.php">Category</a></li>
						<li><a href="brand.php">Brand</a></li>
						<li><a href="product.php">Product</a></li>
						<li><a href="payroll.php">Payroll</a></li>
						<li><a href="employee.php">Employee</a></li>
						<li><a href="order.php">Order</a></li>
						<li><a href="report.php">Report</a></li>

					<?php
					}elseif($_SESSION['type'] == 'sale')
					{?>
						<li><a href="order.php">Order</a></li>
					
					<?php
					}elseif($_SESSION['type'] == 'payroll')
					{?>
						<li><a href="payroll.php">Payroll</a></li>
						<li><a href="employee.php">Employee</a></li>
				
					<?php 
						}elseif($_SESSION['type'] == 'inventory')
					{?>
						<li><a href="category.php">Category</a></li>
						<li><a href="brand.php">Brand</a></li>
						<li><a href="product.php">Product</a></li>
				
					<?php } ?>
						</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> <?php echo $_SESSION["user_name"]; ?></a>
							<ul class="dropdown-menu">
								<li><a href="profile.php">Profile</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>

				</div>
			</nav>
		<div class="container-fluid">
			
			