<?php

//user_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "
SELECT * FROM payroll LEFT JOIN employee_details USING (employee_id) GROUP BY employee_id
";


$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach($result as $row)
{
	$status = '';
	$sub_array = array();
	$sub_array[] = $row['employee_id'];
	$sub_array[] = $row['employee_name'];
	$sub_array[] = $row['employee_position'];
	$sub_array[] = $row['hrsworked'];
	$sub_array[] = $row['daysworked'];
	$sub_array[] = 'Php '.$row['gross_income'];
	$sub_array[] = 'Php '.number_format($row['sss']);
	$sub_array[] = 'Php '.number_format($row['pagibig']);
	$sub_array[] = 'Php '.number_format($row['philhealth']);
	$sub_array[] = 'Php '.$row['netincome'];
	$sub_array[] = $row['monthof'];
	$sub_array[] ='<button class="btn btn-default viewdtr" id="'.$row["employee_id"].'">View DTR</button>';
	
	$data[] = $sub_array;
}

$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"    			=> 	$data
);
echo json_encode($output);

function get_total_all_records($connect)
{
	$statement = $connect->prepare("SELECT * FROM employee_details ");
	$statement->execute();
	return $statement->rowCount();
}

?>