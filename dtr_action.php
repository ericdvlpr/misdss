<?php

//brand_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = '';
					$query .= "
					SELECT * FROM employee_details WHERE employee_passcode ='".$_POST["password"]."' ";
					$statement = $connect->prepare($query);

					$statement->execute();

					$result = $statement->fetchAll();
					foreach($result as $row)
					{
						 $employee_passcode = $row['employee_passcode'];
					}
		if($_POST["password"]==$employee_passcode){

			if($_POST["status"]=='in'){
				$query = "
				INSERT INTO dtr(employee_id, password,status,time_in,date,remarks) 
				VALUES (:employee_id, :password,:status,:time_in,:date,:remarks)
				";
				$statement = $connect->prepare($query);
				$statement->execute(
					array(

						':employee_id'	=>	$_POST["employee_name"],
						':password'	=>	$_POST["password"],
						':status'	=>	$_POST["status"],
						':time_in'	=>	date('h:i:s a'),
						':date'	=>	date("Y/m/d"),
						':remarks'	=>	$_POST["remarks"]
					)
				);
				$result = $statement->fetchAll();
				if(isset($result))
				{
					echo 'Time In Successfull';
				}
			}elseif($_POST["status"]=='out'){

				$query = "
				UPDATE dtr SET time_out=:time_out,remarks=:remarks,status=:status WHERE employee_id=:employee_id AND password=:password AND date=:date
				";
				$statement = $connect->prepare($query);
				$statement->execute(
					array(

						':employee_id'	=>	$_POST["employee_name"],
						':password'	=>	$_POST["password"],
						':status'	=>	$_POST["status"],
						':time_out'	=>	date("h:i:s a"),
						':date'	=>	date("Y/m/d"),
						':remarks'	=>	$_POST["remarks"]
					)
				);
				$result = $statement->fetchAll();
				if(isset($result))
				{
					echo 'Time Out Successfull';
				}
			}
			
		}else{
				echo 'Incorrect Password';
			}			
		 
	}
	if($_POST['btn_action'] == 'fetch_employee_details')
	{
		$netIncome = '';
		 $query = "
		SELECT *,COUNT(date) FROM employee_details JOIN dtr USING (employee_id) WHERE employee_id = :employee_id
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
			$time_in = $row['time_in'];
			$time_out = $row['time_out'];
			$total      = strtotime($time_out) - strtotime($time_in);
			$hours      = floor($total / 60 / 60);
			$minutes    = round(($total - ($hours * 60 * 60)) / 60);
			$hrWorked =$hours.'.'.$minutes;
			$daysWorked = $row['COUNT(date)'];
			$hrRate = $row['employee_hrrate'];
			$dyRate = $row['employee_dlyrate'];
			$Income = $dyRate * $daysWorked;
			@$netIncome += ((int)$Income - 200);
			$netIncome += ((int)$Income - 200);
			$netIncome += ((int)$Income - 100);
			$sss = $Income - 200;
			$pagIbig = $Income - 200;
			$philHealth = $Income - 200;
			$netIncome;

			$output['employeeName'] = $row['employee_name'];
			$output['hrWorked'] = $hrWorked;
			$output['daysWorked'] = $daysWorked;
			$output['sss'] = abs($sss);
			$output['philhealth'] = abs($philHealth);
			$output['pagibig'] = abs($pagIbig);
			$output['netIncome'] = abs($netIncome);

		}
		echo json_encode($output);
	}

}

?>