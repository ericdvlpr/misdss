<?php
//fetch.php
include('database_connection.php');

include('function.php');

$query = "
 SELECT * FROM dtr JOIN employee_details USING (employee_id)
";
$output = '';
if(isset($_POST["is_days"])) {
 $query .= "date BETWEEN CURDATE() - INTERVAL ".$_POST["is_days"]." DAY AND CURDATE() AND ";
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query);

$data = array();

while($row = mysqli_fetch_array($result)) {
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
 "draw"    => intval($_POST["draw"]),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);



?>