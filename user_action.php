<?php

//user_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "
		INSERT INTO user_details (user_email, user_password, user_name, user_type, user_status,user_assign) 
		VALUES (:user_email, :user_password, :user_name, :user_type, :user_status,:user_assign)
		";	
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_email'		=>	$_POST["user_email"],
				':user_password'	=>	password_hash($_POST["user_password"], PASSWORD_DEFAULT),
				':user_name'		=>	$_POST["user_name"],
				':user_type'		=>	$_POST["user_type"],
				':user_assign'		=>	$_POST["user_assign"],
				':user_status'		=>	'active'
			)
		);
		$result = $statement->fetchAll();
		
		if(isset($result))
		{
			if(isset($_POST["user_assign"])){
			$query = "UPDATE employee_details SET 
				employee_account = 1 WHERE employee_id ='".$_POST["user_assign"]."' ";
			$statement = $connect->prepare($query);
			$statement->execute();
		}
			echo 'New User Added';
		}
	}
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM user_details WHERE user_id = :user_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_id'	=>	$_POST["user_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['user_email'] = $row['user_email'];
			$output['user_name'] = $row['user_name'];
			$output['user_type'] = $row['user_type'];
			$output['user_assign']	=$row["user_assign"]; 
		}
		echo json_encode($output);
	}
	if($_POST['btn_action'] == 'Edit')
	{
		if($_POST['user_password'] != '')
		{
			$query = "
			UPDATE user_details SET 
				user_name = '".$_POST["user_name"]."', 
				user_email = '".$_POST["user_email"]."',
				user_password = '".password_hash($_POST["user_password"], PASSWORD_DEFAULT)."',
				user_type	='".$_POST["user_type"]."',
				user_assign	='".$_POST["user_assign"]."' 
				WHERE user_id = '".$_POST["user_id"]."'
			";
		}
		else
		{
			$query = "
			UPDATE user_details SET 
				user_name = '".$_POST["user_name"]."', 
				user_email = '".$_POST["user_email"]."',
				user_type	='".$_POST["user_type"]."',
				user_assign	='".$_POST["user_assign"]."' 
				WHERE user_id = '".$_POST["user_id"]."'
			";
			
		}

		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		if(isset($result))
		{
			if(isset($_POST["user_assign"])){
				$query = "UPDATE employee_details SET 
					employee_account = 1 WHERE employee_id ='".$_POST["user_assign"]."' ";
				$statement = $connect->prepare($query);
				$statement->execute();
			}
			echo 'User Details Edited';
		}
	}
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Active';
		if($_POST['status'] == 'Active')
		{
			$status = 'Inactive';
		}
		$query = "
		UPDATE user_details 
		SET user_status = :user_status 
		WHERE user_id = :user_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':user_status'	=>	$status,
				':user_id'		=>	$_POST["user_id"]
			)
		);	
		$result = $statement->fetchAll();	
		if(isset($result))
		{
			echo 'User Status change to ' . $status;
		}
	}
}

?>