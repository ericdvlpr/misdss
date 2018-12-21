<?php
//brand_action.php

include('database_connection.php');
include('function.php');

$con = mysqli_connect("localhost","root","123456","db_misdss");
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
					if($_POST['status']=='in'){
						 $query = "SELECT * FROM dtr WHERE password ='".$_POST["password"]."' AND date = CURDATE() ";
					}elseif($_POST['status']=='out'){
						 $query = "";
					}
					
					$statement = $connect->prepare($query);
					$statement->execute();
					$error_rows = $statement->rowCount();
					if(isset($_POST["password"])){
							if($error_rows==1){
								echo 'NO';
								return false;
							}
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
										':time_in'	=>	date('g:i a'),
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
										':time_out'	=>	date("g:i a"),
										':date'	=>	date("Y/m/d"),
										':remarks'	=>	$_POST["remarks"]
									)
								);
								$result = $statement->fetchAll();
								if(isset($result))
								{
								 	echo 'Time Out Successfull';
								}
							}else{
								echo 'Incorrect Password';
							}
						
						}	
	}
	if($_POST['btn_action'] == 'fetch_employee_details')
	{
		$netIncome = '';
		$GrossIncome = '';
		$hoursLates=0;
		$output= array();
		 $query = "
		SELECT *, MONTH(date), COUNT(date) as daysPresent FROM employee_details JOIN dtr USING (employee_id) WHERE employee_id = '".$_POST["employee_id"]."'
		";
		
		// $statement = $connect->prepare($query);
		// $statement->execute(
		// 	array(
		// 		':employee_id'	=>	$_POST["employee_id"]
		// 	)
		// );
		// $result = $statement->fetchAll();
		//  $query2 = "
		// SELECT MONTH(date) FROM dtr JOIN employee_details USING (employee_id) WHERE time_in > '8:00' AND employee_id = :employee_id AND date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() GROUP BY employee_id
		// ";
		// $statement = $connect->prepare($query2);
		// $statement->execute(
		// 	array(
		// 		':employee_id'	=>	$_POST["employee_id"]
		// 	)
		// );
		// echo $numoflate = $statement->rowCount();
		$result = mysqli_query($con, $query);
		$standTimeIn="8:00 am";
		//foreach($result as $row)
		while($row = mysqli_fetch_array($result)) {
			
			$time_in = $row['time_in'];
			$time_out = $row['time_out'];
		    $total      = abs(strtotime($time_in) - strtotime($time_out));
			$hours      = floor($total / 60 / 60);
			$minutes    = round(($total - ($hours * 60 * 60)) / 60);
			$hrWorked = round($hours.'.'.$minutes);
			$daysWorked = $row['daysPresent'];
			$hrRate = $row['employee_hrrate'];
			$dyRate = $row['employee_dlyrate'];
			$workingDays = 24;
			$employeeAttendance = $workingDays-$daysWorked;
			if($employeeAttendance<0){
				$employeeAttendance=0;
			}
			$absentDeduction = $dyRate * $employeeAttendance;
			$query = "SELECT * FROM dtr WHERE time_in > '8:00 am' AND employee_id ='".$_POST["employee_id"]."'  ";
			$hoursLates = mysqli_num_rows(mysqli_query($con, $query));
			if(isset($hoursLates)){
				 $hoursLates;
			 // 	 $hoursLate = abs(strtotime($time_in)-strtotime($standTimeIn));
				// $hoursLates += floor($hoursLate / (60 * 60));
				 $lateDeduction = $hrRate * $hoursLates;
				  $deduction = true;
			}
			if($hours==8){
				 $GrossIncome = $dyRate * $daysWorked;
			}elseif($hours>8){
				$othours=round($hours-8);
				 $WithOT = $hrRate * $othours * $daysWorked;
		    	$GrossIncome = $dyRate * $daysWorked + $WithOT;

			}elseif($hours<8){
				 $hourlyIncome = $hrRate * $hours;  
				 $GrossIncome = $hourlyIncome;
			}
			if(isset($deduction)){
				  $GrossIncome=$GrossIncome-$lateDeduction;
				 $netPaySSS = $GrossIncome - 200;
				 $netPayIbig =$netPaySSS - 200;
				 $netPayHealth =$netPayIbig - 200;
				 $netIncome = $netPayHealth;
			}else if($employeeAttendance<20){
				 $GrossIncome=$GrossIncome-$absentDeduction;
				 $netPaySSS = $GrossIncome - 200;
				 $netPayIbig = $netPaySSS - 200;
				 $netPayHealth =  $netPayIbig - 200;
				 $netIncome= $netPayHealth;
			}else{
				 $GrossIncome;
				 $netPaySSS = $GrossIncome - 200;
				 $netPayIbig = $netPaySSS - 200;
				 $netPayHealth =  $netPayIbig - 200;
				 $netIncome= $netPayHealth;
			}
			//compute for absent and lates

			
			//$Income = $dyRate * $daysWorked;

			//$netIncome += ((int)$GrossIncome - 200);
			// $netIncome += ((int)$GrossIncome - 200);
			// $netIncome += ((int)$GrossIncome - 100);
			// $sss = $GrossIncome - 200;
			// $pagIbig = $GrossIncome - 200;
			// $philHealth = $GrossIncome - 200;
			// echo $netIncome;
			 // abs($netIncome);

			$output['employeeName'] = $row['employee_name'];
			$output['hrWorked'] = $hrWorked;
			$output['daysWorked'] = $daysWorked;
			$output['grossincome'] = $GrossIncome;
			$output['absent'] = $employeeAttendance;
			$output['late'] = $hoursLates;
			$output['sss'] = abs(200);
			$output['philhealth'] = abs(200);
			$output['pagibig'] = abs(200);
			$output['netIncome'] = $netIncome;
		}
		echo json_encode($output);
	}

}

?>