<?php

//user_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "
SELECT * FROM payroll LEFT JOIN employee_details USING (employee_id)
";

// if(isset($_POST["search"]["value"]))
// {
// 	$query .= '(employee_name LIKE "%'.$_POST["search"]["value"].'%" ';
// 	$query .= 'OR employee_name LIKE "%'.$_POST["search"]["value"].'%" ';
// 	$query .= 'OR employee_name LIKE "%'.$_POST["search"]["value"].'%") ';
// }

// if(isset($_POST["order"]))
// {
// 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
// }
// else
// {
// 	$query .= 'ORDER BY employee_id DESC ';
// }

// if($_POST["length"] != -1)
// {
// 	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
// }

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
	$sub_array[] = 'Php '.number_format($row['sss']);
	$sub_array[] = 'Php '.number_format($row['pagibig']);
	$sub_array[] = 'Php '.number_format($row['philhealth']);
	$sub_array[] = 'Php '.number_format($row['netincome']);
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