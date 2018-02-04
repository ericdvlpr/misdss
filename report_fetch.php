<?php

//user_fetch.php

include('database_connection.php');

$query = '';

$output = array();

$query .= "
SELECT * FROM dtr JOIN employee_details USING (employee_id)
";
if(isset($_POST["is_days"])) {
 $query .= "WHERE date BETWEEN CURDATE() - INTERVAL ".$_POST["is_days"]." DAY AND CURDATE()";
}
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
	$time_in = $row['time_in'];
	$time_out = $row['time_out'];
	// $daysWorked = $daysWorked + $row["date"];
	$total      = strtotime($time_out) - strtotime($time_in);
	$hours      = floor($total / 60 / 60);
	$minutes    = round(($total - ($hours * 60 * 60)) / 60);
	$hrWorked =$hours.'.'.$minutes;
	$sub_array = array();
	$sub_array[] = $row["employee_name"];
	$sub_array[] = $row["date"];
	$sub_array[] = $time_in;
	$sub_array[] = $time_out;
	$sub_array[] = $hrWorked;
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
	$statement = $connect->prepare("SELECT * FROM dtr JOIN employee_details USING (employee_id) ");
	$statement->execute();
	return $statement->rowCount();
}

?>