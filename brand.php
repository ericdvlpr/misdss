<?php
//brand.php
include('database_connection.php');

include('function.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

// if($_SESSION['type'] != 'master')
// {
// 	header('location:index.php');
// }

include('includes/header.php');

?>

	<span id="alert_action"></span>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-md-10">
                			<h3 class="panel-title">Brand List</h3>
                		</div>
                		<div class="col-md-2" align="right">
                			<button type="button" name="add" id="add_brand" class="btn btn-success btn-xs">Add</button>
                		</div>
                	</div>
                </div>
                <div class="panel-body">
                	<table id="brand_data" class="table table-bordered table-striped">
                		<thead>
							<tr>
								<th>ID</th>
								<th>Category</th>
								<th>Brand Name</th>
								<th>Status</th>
								<th>Edit</th>
							</tr>
						</thead>
                	</table>
                </div>
            </div>
        </div>
    </div>

    <div id="brandModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="brand_form">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Brand</h4>
    				</div>
    				<div class="modal-body">
    					<div class="form-group">
    						<select name="category_id" id="category_id" class="form-control" required>
								<option value="">Select Category</option>
								<?php echo fill_category_list($connect); ?>
							</select>
    					</div>
    					<div class="form-group">
							<label>Enter Brand Name</label>
							<input type="text" name="brand_name" id="brand_name" class="form-control" required />
						</div>
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="brand_id" id="brand_id" />
    					<input type="hidden" name="btn_action" id="btn_action" value="Addbrand" />
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>


<?php
include('includes/footer.php');
?>