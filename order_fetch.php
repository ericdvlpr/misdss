<?php

//order_fetch.php

include('database_connection.php');

include('function.php');

$query = '';

$output = array();

$query .= "
	SELECT * FROM inventory_order  
";



$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
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
	$sub_array[] = 'Php '.number_format($row['inventory_order_total']);
	$sub_array[] = $payment_status;
	$sub_array[] = $status;
	$sub_array[] = $row['inventory_order_date'];
	if($_SESSION['type'] == 'master')
	{
		$sub_array[] = get_user_name($connect, $row['user_id']);
	}
	$sub_array[] = '<a href="view_order.php?pdf=1&order_id='.$row["inventory_order_id"].'" class="btn btn-info btn-xs">View PDF</a>';
	$sub_array[] = '<button type="button" name="update" id="'.$row["inventory_order_id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$data[] = $sub_array;
}

function get_total_all_records($connect)
{
	$statement = $connect->prepare("SELECT * FROM inventory_order");
	$statement->execute();
	return $statement->rowCount();
}

$output = array(
	"draw"    			=> 	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"    			=> 	$data
);	

echo json_encode($output);

?>