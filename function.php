<?php
//function.php

function fill_category_list($connect)
{
	$query = "
	SELECT * FROM category 
	WHERE category_status = 'active' 
	ORDER BY category_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["category_id"].'">'.$row["category_name"].'</option>';
	}
	return $output;
}

function fill_employee_list($connect)
{
	$query = "SELECT * FROM employee_details 
	WHERE employee_status = 'active' 
	AND employee_account = 0";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<option value="">Select Employee</option>';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["employee_id"].'">'.$row["employee_name"].'</option>';
	}
	return $output;
}
function fill_brand_list($connect, $category_id)
{
	$query = "SELECT * FROM brand 
	WHERE brand_status = 'active' 
	AND category_id = '".$category_id."'
	ORDER BY brand_name ASC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<option value="">Select Brand</option>';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["brand_id"].'">'.$row["brand_name"].'</option>';
	}
	return $output;
}

function get_user_name($connect, $user_id)
{
	$query = "
	SELECT user_name FROM user_details WHERE user_id = '".$user_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['user_name'];
	}
}

function fill_product_list($connect)
{
	$query = "
	SELECT * FROM product 
	WHERE product_status = 'active' 
	ORDER BY product_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["product_id"].'">'.$row["product_name"].'</option>';
	}
	return $output;
}

function fetch_product_details($product_id, $connect)
{
	$query = "
	SELECT * FROM product 
	WHERE product_id = '".$product_id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['product_name'] = $row["product_name"];
		$output['quantity'] = $row["product_quantity"];
		$output['price'] = $row['product_base_price'];
		$output['tax'] = $row['product_tax'];
	}
	return $output;
}

function available_product_quantity($connect, $product_id)
{
	$product_data = fetch_product_details($product_id, $connect);
	$query = "
	SELECT 	inventory_order_product.quantity FROM inventory_order_product 
	INNER JOIN inventory_order ON inventory_order.inventory_order_id = inventory_order_product.inventory_order_id
	WHERE inventory_order_product.product_id = '".$product_id."' AND
	inventory_order.inventory_order_status = 'active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = 0;
	foreach($result as $row)
	{
		$total = $total + $row['quantity'];
	}
	$available_quantity = intval($product_data['quantity']) - intval($total);
	if($available_quantity == 0)
	{
		$update_query = "
		UPDATE product SET 
		product_status = 'inactive' 
		WHERE product_id = '".$product_id."'
		";
		$statement = $connect->prepare($update_query);
		$statement->execute();
	}
	return $available_quantity;
}

function count_total_user($connect)
{
	$query = "
	SELECT * FROM user_details WHERE user_status='active'";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_category($connect)
{
	$query = "
	SELECT * FROM category WHERE category_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_brand($connect)
{
	$query = "
	SELECT * FROM brand WHERE brand_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_product($connect)
{
	$query = "
	SELECT * FROM product WHERE product_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}
function count_total_payroll($connect)
{
	$query = "
	SELECT * FROM payroll
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_employee($connect)
{
	$query = "
	SELECT * FROM employee_details WHERE employee_status='active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order 
	WHERE inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return 'Php '.number_format($row['total_order_value']);
	}
}

function count_total_cash_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order 
	WHERE payment_status = 'cash' 
	AND inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value']);
	}
}

function count_total_credit_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order WHERE payment_status = 'credit' AND inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function get_user_wise_total_order($connect)
{
	$query = '
	SELECT sum(inventory_order.inventory_order_total) as order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "cash" THEN inventory_order.inventory_order_total ELSE 0 END) AS cash_order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "credit" THEN inventory_order.inventory_order_total ELSE 0 END) AS credit_order_total, 
	user_details.user_name 
	FROM inventory_order 
	INNER JOIN user_details ON user_details.user_id = inventory_order.user_id 
	WHERE inventory_order.inventory_order_status = "active" GROUP BY inventory_order.user_id
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>User Name</th>
				<th>Total Order Value</th>
				<th>Total Cash Order</th>
				<th>Total Credit Order</th>
			</tr>
	';

	$total_order = 0;
	$total_cash_order = 0;
	$total_credit_order = 0;
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row['user_name'].'</td>
			<td align="right">$ '.$row["order_total"].'</td>
			<td align="right">$ '.$row["cash_order_total"].'</td>
			<td align="right">$ '.$row["credit_order_total"].'</td>
		</tr>
		';

		$total_order = $total_order + $row["order_total"];
		$total_cash_order = $total_cash_order + $row["cash_order_total"];
		$total_credit_order = $total_credit_order + $row["credit_order_total"];
	}
	$output .= '
	<tr>
		<td align="right"><b>Total</b></td>
		<td align="right"><b>Php '.$total_order.'</b></td>
		<td align="right"><b>Php '.$total_cash_order.'</b></td>
		<td align="right"><b>Php '.$total_credit_order.'</b></td>
	</tr></table></div>
	';
	return $output;
}
function get_total_payroll($connect)
{
	$query = '
	SELECT *
	FROM payroll LEFT JOIN employee_details USING (employee_id)
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Employee ID</th>
				<th>Employee Name</th>
				<th>Position</th>
				<th>Hours Worked</th>
				<th>Days Worked</th>
				<th>SSS</th>
				<th>PagIbig</th>
				<th>PhilHealth</th>
				<th>Net Income</th>
			</tr>
	';
	$total_hours_worked=0;
	$total_days_worked=0;
	$total_sss_remit=0;
	$total_pagibig_remit=0;
	$total_philhealth_remit=0;
	$total_netincome_remit=0;
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row['employee_id'].'</td>
			<td align="right"> '.$row["employee_name"].'</td>
			<td align="right"> '.$row["employee_position"].'</td>
			<td align="right"> '.$row["hrsworked"].'</td>
			<td align="right"> '.$row["daysworked"].'</td>
			<td align="right">Php '.$row["sss"].'</td>
			<td align="right">Php '.$row["pagibig"].'</td>
			<td align="right">Php '.$row["philhealth"].'</td>
			<td align="right">Php '.$row["netincome"].'</td>
		</tr>
		';

		$total_hours_worked = $total_hours_worked + $row["hrsworked"];
		$total_days_worked = $total_days_worked + $row["daysworked"];
		$total_sss_remit = $total_sss_remit + $row["sss"];
		$total_pagibig_remit = $total_pagibig_remit + $row["pagibig"];
		$total_philhealth_remit = $total_philhealth_remit + $row["philhealth"];
		$total_netincome_remit = $total_netincome_remit + $row["netincome"];
	}
	$output .= '
	<tr>
		<td align="right"><b>Total</b></td>
		<td align="right">&nbsp;</td>
		<td align="right">&nbsp;</td>
		<td align="right"><b>'.$total_hours_worked.'</b></td>
		<td align="right"><b>'.$total_days_worked.'</b></td>
		<td align="right"><b>Php'.$total_sss_remit.'</b></td>
		<td align="right"><b>Php'.$total_pagibig_remit.'</b></td>
		<td align="right"><b>Php'.$total_philhealth_remit.'</b></td>
		<td align="right"><b>Php'.$total_netincome_remit.'</b></td>
	</tr></table></div>
	';
	return $output;
}
function get_total_employee($connect)
{
	$query = '
	SELECT *
	FROM employee_details 
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>Employee ID</th>
				<th>Employee Name</th>
				<th>Hourly Rate</th>
				<th>Daily Rate</th>
				<th>Hours Per Day</th>
				<th>Position</th>
			</tr>
	';
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row['employee_id'].'</td>
			<td> '.$row["employee_name"].'</td>
			<td> '.$row["employee_hrrate"].'</td>
			<td> '.$row["employee_dlyrate"].'</td>
			<td> '.$row["employee_perday"].'</td>
			<td> '.$row["employee_position"].'</td>
		</tr>
		';
	}
	$output .= '
	</table></div>
	';
	return $output;
}
function get_total_sales($connect)
{
	$query = '
	SELECT *
	FROM inventory_order WHERE inventory_order_date BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
<tr>
				<th>Order ID</th>
				<th>Customer Name</th>
				<th>Order Date</th>
				<th>Total Order</th>
			</tr>
	';
	$total_order = 0;
	
	foreach($result as $row)
	{
		$total_order = $total_order + $row["inventory_order_total"];
		$output .= '
		<tr>
			<td>'.$row['inventory_order_id'].'</td>
			<td> '.$row["inventory_order_name"].'</td>
			<td> '.$row["inventory_order_date"].'</td>
			<td align="right">Php '.number_format($row["inventory_order_total"],2).'</td>
		</tr>
		';
	}
	$output .= '
	<tr>
		<td align="right">&nbsp;</td>
		<td align="right">&nbsp;</td>
		<td align="right"><b>Total</b></td>
		<td align="right"><b>Php'.number_format($total_order = $total_order,2).'</b></td>
	</tr></table></div>
	';
	return $output;
}
function get_total_inventory($connect)
{
	$query = '
SELECT * FROM product JOIN category USING (category_id) JOIN brand USING (brand_id) ORDER BY product_id DESC LIMIT 10 
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th width="30">Product ID</th>
				<th width="30">Product Name</th>
				<th width="30">Description</th>
			</tr>
	';
	$total_quantity = 0;
	foreach($result as $row)
	{
		$total_quantity = $total_quantity + $row["product_quantity"];
		$total_quantity = $total_quantity + $row["product_quantity"];
		$total_quantity = $total_quantity + $row["product_quantity"];
		$output .= '
		<tr>
			<td  width="30">'.$row['product_id'].'</td>
			<td  width="30"> '.$row["product_name"].'</td>
			<td  width="30"> '.$row["product_description"].'</td>
		</tr>
		';
	}
	$output .= '
		</table></div>
		';
		return $output;
	}
function get_daily_time_record($connect,$no_days) {
		$query = '
		SELECT * FROM dtr JOIN employee_details USING (employee_id)';
		$output = '
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<tr>
					<th>Employee Name</th>
					<th>Position</th>
					<th>Date</th>
					<th>Time In</th>
					<th>Time Out</th>
					<th>Hours Worked</th>
				</tr>
		';
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		
		$total_quantity = 0;
		foreach($result as $row)
		{
			$time_in = $row['time_in'];
			$time_out = $row['time_out'];
			// $daysWorked = $daysWorked + $row["date"];
			$total      = strtotime($time_out) - strtotime($time_in);
			$hours      = floor($total / 60 / 60);
			$minutes    = round(($total - ($hours * 60 * 60)) / 60);
			$hrWorked =$hours.'.'.$minutes;
			$output .= '
			<tr>
				<td>'.$row['employee_name'].'</td>
				<td>'.$row['employee_position'].'</td>
				<td> '.$row['date'].'</td>
				<td> '.$time_in.'</td>
				<td> '.$time_out.'</td>
				<td> '.$hrWorked.'</td>
			</tr>
			';
		}
		echo json_encode($output);
}	



?>