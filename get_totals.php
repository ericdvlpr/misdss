<?php 

include('database_connection.php');
if($_POST["btn_action"]=='order'){
	$output ="";
	if(isset($_POST["is_date_search"]) == "yes") {
		$query = "
		SELECT COUNT(inventory_order_id) as total_order FROM inventory_order 
		WHERE inventory_order_status='active' AND inventory_order_date BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."'
		";
	}else{
		$query = "
		SELECT COUNT(inventory_order_id) as total_order FROM inventory_order 
		WHERE inventory_order_status='active'
		";
	}

	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result0 = $statement->fetchAll();
	foreach($result0 as $row)
	{
		$output =$row['total_order'];
	}

	$query1 = "
	SELECT sum(inventory_order_total) as total_daily_order FROM inventory_order 
	WHERE inventory_order_status='active' AND inventory_order_date = CURDATE()";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query1);
	$statement->execute();
	$result1 = $statement->fetchAll();
	foreach($result1 as $row)
	{
		$dailytotal =' Php '.number_format($row['total_daily_order']);
	}

	if(isset($_POST["is_date_search"]) == "yes") {
		$query2 = "
		SELECT sum(inventory_order_total) as total_weekly_order FROM inventory_order 
		WHERE inventory_order_status='active' AND inventory_order_date BETWEEN '".$_POST["start_date"]."' - INTERVAL 7 DAY AND '".$_POST["end_date"]."'";
	}else{	
		$query2 = "
		SELECT sum(inventory_order_total) as total_weekly_order FROM inventory_order 
		WHERE inventory_order_status='active' AND inventory_order_date BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()";
	}
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query2);
	$statement->execute();
	$result2 = $statement->fetchAll();
	foreach($result2 as $row)
	{
		$weeklytotal =' Php '.number_format($row['total_weekly_order']);
	}

	if(isset($_POST["is_date_search"]) == "yes") {
		$query3 = "
		SELECT sum(inventory_order_total) as total_monthly_order FROM inventory_order 
		WHERE inventory_order_status='active' AND inventory_order_date BETWEEN '".$_POST["start_date"]."' - INTERVAL 30 DAY AND '".$_POST["end_date"]."'";
	}else{
		$query3 = "
		SELECT sum(inventory_order_total) as total_monthly_order FROM inventory_order 
		WHERE inventory_order_status='active' AND inventory_order_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
	}
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query3);
	$statement->execute();
	$result3 = $statement->fetchAll();
	foreach($result3 as $row)
	{
		$monthlytotal =' Php '.number_format($row['total_monthly_order']);
	}

	if(isset($_POST["is_date_search"]) == "yes") {
		$query4 = "
		SELECT sum(inventory_order_total) as total_yearly_order FROM inventory_order 
		WHERE inventory_order_status='active' AND inventory_order_date BETWEEN '".$_POST["start_date"]."' - INTERVAL 365 DAY AND '".$_POST["end_date"]."'";
	}else{
		$query4 = "
		SELECT sum(inventory_order_total) as total_yearly_order FROM inventory_order 
		WHERE inventory_order_status='active' AND inventory_order_date BETWEEN CURDATE() - INTERVAL 365 DAY AND CURDATE()";
	}
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query4);
	$statement->execute();
	$result4 = $statement->fetchAll();
	foreach($result4 as $row)
	{
		$yearlytotal =' Php '.number_format($row['total_yearly_order']);
	}
	
	$data = array(
			'totalOrder' => $output,
			'totalDailyOrder'=> $dailytotal,
			'totalWeeklyOrder'=> $weeklytotal,
			'totalMonthlyOrder'=> $monthlytotal,
			'totalYearlyOrder'=> $yearlytotal
		);
	echo json_encode($data);

}
if($_POST["btn_action"]=='payroll'){
		$total_hours=0;
		$total_days=0;
		$total_sss_remit=0;
		$total_pagibig_remit=0;
		$total_philhealth_remit=0;
		$total_netincome_remit=0;
		$total_gross=0;
$query = 'SELECT * FROM payroll LEFT JOIN employee_details USING (employee_id) GROUP BY employee_id';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{

		$total_hours = $total_hours + $row["hrsworked"];
		$total_days = $total_days + $row["daysworked"];
		$total_gross = $total_gross + $row["gross_income"];
		$total_sss_remit = $total_sss_remit + $row["sss"];
		$total_pagibig_remit = $total_pagibig_remit + $row["pagibig"];
		$total_philhealth_remit = $total_philhealth_remit + $row["philhealth"];
		$total_netincome_remit = $total_netincome_remit + $row["netincome"];
	}
		$data = array(
			'totalHourWorked' => $total_hours,
			'totalDaysWorked' => $total_days,
			'totalGrossRemit' => number_format($total_gross),
			'totalSSSRemit'=> number_format($total_sss_remit),
			'totalPAGIBIGRemit'=> number_format($total_pagibig_remit),
			'totalPHILHEALTHRemit'=> number_format($total_philhealth_remit),
			'totalNETINCOMERemit'=> number_format($total_netincome_remit)
		);
		echo json_encode($data);
}
?>