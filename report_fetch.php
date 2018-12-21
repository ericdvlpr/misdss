<?php

//user_fetch.php

include('database_connection.php');



$output = array();
if($_POST["action"]=='dtr'){
  $query = "SELECT * FROM dtr JOIN employee_details USING (employee_id) GROUP BY employee_id ";
}
if($_POST["action"]=='order'){
 $query = "SELECT * FROM inventory_order JOIN inventory_order_product USING (inventory_order_id) JOIN product USING (product_id) GROUP BY inventory_order_id ";

}
if($_POST["action"]=='payroll'){
 $query = "SELECT * FROM payroll JOIN employee_details USING (employee_id) GROUP BY employee_id";

}


if($_POST["action"]=='dtr' && $_POST["is_date_search"] == "yes") {
	
	$query = ' SELECT * FROM dtr JOIN employee_details USING (employee_id) WHERE date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" GROUP BY employee_id ';
	$statement = $connect->prepare("SELECT * FROM dtr JOIN employee_details USING (employee_id) WHERE date BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."'");
	$statement->execute();
	$filtered_rows = $statement->rowCount();
}
if($_POST["action"]=='order' && $_POST["is_date_search"] == "yes") {
	
	$query .= ' WHERE inventory_order_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" ';
	$statement = $connect->prepare("SELECT * FROM inventory_order WHERE inventory_order_date BETWEEN '".$_POST["start_date"]."' AND '".$_POST["end_date"]."'");
	$statement->execute();
	$filtered_rows = $statement->rowCount();
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
if($_POST["action"]=='dtr'){
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
		$sub_array[] = ' <a class="viewdtr" data-target="#dtrModal" data-toggle="modal" id="'.$row["employee_id"].'" href="#dtrModal">'.$row["employee_name"].'</a>';
		$sub_array[] = $row["employee_position"];
		$sub_array[] = $row["date"];
		$sub_array[] = $time_in;
		$sub_array[] = $time_out;
		$sub_array[] = $hrWorked;
		$data[] = $sub_array;
	}
	function get_total_all_records($connect) {
		$statement = $connect->prepare("SELECT * FROM dtr JOIN employee_details USING (employee_id)");
		$statement->execute();
		return $statement->rowCount();
	}
}
if($_POST["action"]=='order'){
	foreach($result as $row)
	{
		$payment_status = '';

	if($row['payment_status'] == 'cash')
	{
		$payment_status = '<span class="label label-primary">Cash</span>';
	}
	else
	{
		$payment_status = '<span class="label label-warning">Credit</span>';
	}

	$status = '';
	if($row['inventory_order_status'] == 'active')
	{
		$status = '<span class="label label-success">Active</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Inactive</span>';
	}

		$sub_array = array();
		$sub_array[] = $row['inventory_order_id'];
		$sub_array[] = $row['inventory_order_name'];
		$sub_array[] = $row['product_name'];
		$sub_array[] = 'Php '.number_format($row['inventory_order_total']);
		$sub_array[] = $payment_status;
		$sub_array[] = $row['inventory_order_date'];
		$sub_array[] = $filtered_rows;
		$data[] = $sub_array;
	}
	function get_total_all_records($connect) {
		$statement = $connect->prepare("SELECT * FROM inventory_order JOIN inventory_order_product USING (inventory_order_id) JOIN product USING (product_id) ");
		$statement->execute();
		return $statement->rowCount();
	}
}
if($_POST["action"]=='payroll'){

	foreach($result as $row)
	{
		$sub_array = array();
		$sub_array[] = $row['employee_id'];
		$sub_array[] = $row["employee_name"];
		$sub_array[] = $row["employee_position"];
		$sub_array[] = $row["hrsworked"];
		$sub_array[] = $row["daysworked"];
		$sub_array[] = $row["employee_dlyrate"];
		$sub_array[] = $row["gross_income"];
		$sub_array[] = $row["absent"];
		$sub_array[] = $row["late"];
		$sub_array[] = $row["sss"];
		$sub_array[] = $row["pagibig"];
		$sub_array[] = $row["philhealth"];
		$sub_array[] = $row["netincome"];
		$data[] = $sub_array;

	}
	function get_total_all_records($connect) {
		$statement = $connect->prepare("SELECT * FROM payroll JOIN employee_details USING (employee_id)");
		$statement->execute();
		return $statement->rowCount();
	}
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"    			=> 	$data
);
echo json_encode($output);



?>