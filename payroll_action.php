<?php

//user_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Fetch Employee Data')
	{
		
		 $query = "
		SELECT * FROM employee_details ed JOIN dtr USING (employee_id) WHERE employee_id = :employee_id
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
			$hrrate=$row['employee_hrrate'];
			$dlyrate=$row['employee_dlyrate'];
			$perday=$row['employee_perday'];
			$timeIn=$row['time_in'];
			$timeOut=$row['time_out'];
			$dateWorked=$row['date'];
			
		}
		// echo json_encode($output);
	}
	if($_POST['btn_action'] == 'Addpayroll')
	{
		$query = "
		INSERT INTO payroll (employee_id, employee_name, hrsworked, daysworked, sss ,pagibig,
                    philhealth, netincome, monthof) 
		VALUES (:employee_id,:employee_name,:hrsworked,:daysworked, :sss,:pagibig,:philhealth,:netincome,:monthof)
		";	
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':employee_id'		=>	$_POST["employee_id"],
				':employee_name'	=>	$_POST["employee_name"],
				':hrsworked'		=>	$_POST["employee_hrwk"],
				':daysworked'		=>	$_POST["employee_dyswk"],
				':sss'				=>	$_POST["employee_sss"],
				':pagibig'			=>  $_POST["employee_pgibig"],	
				':philhealth'		=>  $_POST["employee_phhealth"],
				':netincome'		=>  $_POST["employee_netincome"],	
				':monthof'			=>  date("F")
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'New Payroll Record Added';
		}
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
				employee_passcode	=  '".$_POST["employee_passcode"]."'
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