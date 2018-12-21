<?php
//login.php

include('database_connection.php');

if(isset($_SESSION['type']))
{
	header("location:index.php");
}

$message = '';

if(isset($_POST["login"]))
{
	$query = "
	SELECT * FROM user_details 
		WHERE user_name = :user_name
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
				'user_name'	=>	$_POST["user_email"]
			)
	);
	$count = $statement->rowCount();
	if($count > 0)
	{
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			if($row['user_status'] == 'Active')
			{
				if(password_verify($_POST["user_password"], $row["user_password"]))
				{
				
					$_SESSION['type'] = $row['user_type'];
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['user_name'] = $row['user_name'];
					header("location:index.php");
				}
				else
				{
					$message = "<label>Wrong Password</label>";
				}
			}
			else
			{
				$message = "<label>Your account is disabled, Contact Master</label>";
			}
		}
	}
	else
	{
		$message = "<label>Wrong Email Address</labe>";
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Management Information System And Decision Support</title>		
		<script src="js/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<script src="js/bootstrap.min.js"></script>
		<style type="text/css">
			body { 
				    background: url("css/images/bg_img.jpg") no-repeat fixed center;
				     background-size: 100% 100%; 
				}
		</style>
	</head>
	<body>
		<br />
		<div class="container">
			<div class="row">
				<div class="col-md-4"></div>	
				<div class="col-md-4">
					<h2 align="center" style="color:white;">Management Information System And Decision Support</h2>
					<br />
					<div class="panel panel-default"> 
						
						 <div class="panel-heading"><h2 align="center">Login</h2></div> 
						<div class="panel-body">
							<form method="post">
								<?php echo $message; ?>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="user_email" class="form-control" required />
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="user_password" class="form-control" required />
								</div>
								
								<div class="form-group">
									<input type="submit" name="login" value="Login" class="btn btn-info" />
								</div> 
							</form>
						</div>
					</div>
				</div>	
				<div class="col-md-4"></div>	
			</div>
			
		</div>
		<script src="js/general.js"></script>

	</body>
</html>