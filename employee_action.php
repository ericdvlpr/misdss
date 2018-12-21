<?php

//user_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		
		$query = "
		INSERT INTO employee_details (employee_name, employee_hrrate, employee_dlyrate, employee_perday, employee_passcode,employee_position) 
		VALUES (:employee_name, :employee_hrrate, :employee_dlyrate, :employee_perday, :employee_passcode,:employee_position)
		";	
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':employee_name'		=>	$_POST["employee_name"],
				':employee_hrrate'		=>	$_POST["employee_hrrate"],
				':employee_dlyrate'		=>	$_POST["employee_dlyrate"],
				':employee_perday'		=>	$_POST["employee_hrperday"],
				':employee_passcode'	=>  $_POST["employee_passcode"],	
				':employee_position'	=>  $_POST["employee_position"]	
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'New Employee Added';
		}
	}
	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM employee_details WHERE employee_id = :employee_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':employee_id'	=>	$_POST["employee_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{

			$output['employee_name']=$row['employee_name'];
			$output['employee_hrrate']=$row['employee_hrrate'];
			$output['employee_dlyrate']=$row['employee_dlyrate'];
			$output['employee_perday']=$row['employee_perday'];
			$output['employee_passcode']=$row['employee_passcode'];
			$output['employee_position']=$row['employee_position'];

		}
		echo json_encode($output);
	}
	if($_POST['btn_action'] == 'Edit')
	{
		if($_POST['employee_id'] != '')
		{
			$query = "
			UPDATE employee_details SET 
				employee_name		=	'".$_POST["employee_name"]."',
				employee_hrrate		=	'".$_POST["employee_hrrate"]."',
				employee_dlyrate	=	'".$_POST["employee_dlyrate"]."',
				employee_perday		=	'".$_POST["employee_hrperday"]."',
				employee_passcode	=  '".$_POST["employee_passcode"]."',
				employee_position	=  '".$_POST["employee_position"]."'
				WHERE employee_id = '".$_POST["employee_id"]."'	
			";
		}
		else
		{
			$query = "
			UPDATE employee_details SET 
				employee_name		=	'".$_POST["employee_name"]."',
				employee_hrrate		=	'".$_POST["employee_hrrate"]."',
				employee_dlyrate	=	'".$_POST["employee_dlyrate"]."',
				employee_perday		=	'".$_POST["employee_hrperday"]."',
				employee_passcode	=  '".$_POST["employee_passcode"]."',
				employee_position	=  '".$_POST["employee_position"]."'
				WHERE employee_id = '".$_POST["employee_id"]."'	
			";
		}
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Employee Details Edited';
		}
	}
	if($_POST['btn_action'] == 'delete')
	{
		$status = 'Active';
		if($status == 'Active')
		{
			 $status = 'Inactive';
		}
		$query = "
		UPDATE employee_details 
		SET employee_status = :employee_status 
		WHERE employee_id = :employee_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':employee_status'	=>	$status,
				':employee_id'		=>	$_POST["employee_id"]
			)
		);	
		$result = $statement->fetchAll();	
		if(isset($result))
		{
			echo 'Employee Status change to ' . $status;
		}
	}
}

?>