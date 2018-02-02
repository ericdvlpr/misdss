$(document).ready(function(){
    $('input:password').attr("maxlength",11);
    //Product Module
    var productdataTable = $('#product_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"product_fetch.php",
            type:"POST"
        },
        "columnDefs":[
            {
                "targets":[7, 8],
                "orderable":false,
            },
        ],
        "pageLength": 10
    });

    $('#add_product').click(function(){
        $('#productModal').modal('show');
        $('#product_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Product");
        $('#action').val("Add");
        $('#btn_action').val("Addproduct");
    });

    $('#category_id').change(function(){
        var category_id = $('#category_id').val();
        var btn_action = 'load_brand';
        $.ajax({
            url:"product_action.php",
            method:"POST",
            data:{category_id:category_id, btn_action:btn_action},
            success:function(data)
            {
                $('#brand_id').html(data);
            }
        });
    });

    $(document).on('submit', '#product_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url:"product_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                $('#product_form')[0].reset();
                $('#productModal').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                $('#action').attr('disabled', false);
                productdataTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.view', function(){
        var product_id = $(this).attr("id");
        var btn_action = 'product_details';
        $.ajax({
            url:"product_action.php",
            method:"POST",
            data:{product_id:product_id, btn_action:btn_action},
            success:function(data){
                $('#productdetailsModal').modal('show');
                $('#product_details').html(data);
            }
        })
    });

    $(document).on('click', '.update', function(){
        var product_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url:"product_action.php",
            method:"POST",
            data:{product_id:product_id, btn_action:btn_action},
            dataType:"json",
            success:function(data){
                $('#productModal').modal('show');
                $('#category_id').val(data.category_id);
                $('#brand_id').html(data.brand_select_box);
                $('#brand_id').val(data.brand_id);
                $('#product_name').val(data.product_name);
                $('#product_description').val(data.product_description);
                $('#product_quantity').val(data.product_quantity);
                $('#product_unit').val(data.product_unit);
                $('#product_base_price').val(data.product_base_price);
                $('#product_tax').val(data.product_tax);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Product");
                $('#product_id').val(product_id);
                $('#action').val("Edit");
                $('#btn_action').val("Edit");
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var product_id = $(this).attr("id");
        var status = $(this).data("status");
        var btn_action = 'delete';
        if(confirm("Are you sure you want to change status?"))
        {
            $.ajax({
                url:"product_action.php",
                method:"POST",
                data:{product_id:product_id, status:status, btn_action:btn_action},
                success:function(data){
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    productdataTable.ajax.reload();
                }
            });
        }
        else
        {
            return false;
        }
    });
    //User Module
    $('#add_button').click(function(){
        $('#user_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add User");
        $('#action').val("Add");
        $('#btn_action').val("Add");
    });

    var userdataTable = $('#user_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax":{
            url:"user_fetch.php",
            type:"POST"
        },
        "columnDefs":[
            {
                "target":[4,5],
                "orderable":false
            }
        ],
        "pageLength": 25
    });

    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled','disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url:"user_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                $('#user_form')[0].reset();
                $('#userModal').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                $('#action').attr('disabled', false);
                userdataTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.update', function(){
        var user_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url:"user_action.php",
            method:"POST",
            data:{user_id:user_id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
                $('#userModal').modal('show');
                $('#user_name').val(data.user_name);
                $('#user_email').val(data.user_email);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit User");
                $('#user_id').val(user_id);
                $('#action').val('Edit');
                $('#btn_action').val('Edit');
                $('#user_password').attr('required', false);
            }
        })
    });

    $(document).on('click', '.delete', function(){
        var user_id = $(this).attr("id");
        var status = $(this).data('status');
        var btn_action = "delete";
        if(confirm("Are you sure you want to change status?"))
        {
            $.ajax({
                url:"user_action.php",
                method:"POST",
                data:{user_id:user_id, status:status, btn_action:btn_action},
                success:function(data)
                {
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    userdataTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    });
    //Employee Module


    var employeedataTable = $('#employee_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax":{
            url:"employee_fetch.php",
            type:"POST"
        },
        "columnDefs":[
            {
                "target":[4,5],
                "orderable":false
            }
        ],
        "pageLength": 25
    });

    $(document).on('submit', '#employee_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled','disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url:"employee_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
               
                $('#employee_form')[0].reset();
                $('#employeeModal').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                $('#action').attr('disabled', false);
                employeedataTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.update', function(){
        var employee_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url:"employee_action.php",
            method:"POST",
            data:{employee_id:employee_id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
                $('#employeeModal').modal('show');
                $('#employee_name').val(data.employee_name);
                $('#employee_passcode').val(data.employee_passcode);
                $('#employee_hrrate').val(data.employee_hrrate);
                $('#employee_dlyrate').val(data.employee_dlyrate);
                $('#employee_hrperday').val(data.employee_perday);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Employee");
                $('#employee_id').val(employee_id);
                $('#action').val('Edit');
                $('#btn_action').val('Edit');
                $('#user_password').attr('required', false);
            }
        })
    });

    $(document).on('click', '.deleteEmployee', function(){
        var employee_id = $(this).attr("id");
        var status = $(this).data('status');
        var btn_action = "delete";

        if(confirm("Are you sure you want to change status?"))
        {
            $.ajax({
                url:"employee_action.php",
                method:"POST",
                data:{employee_id:employee_id, status:status, btn_action:btn_action},
                success:function(data)
                {

                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    employeedataTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    });
     //Payroll Module
    $('#add_button').click(function(){
        // $('#category_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Payroll");
        $('#action').val('Add');
        $('#btn_action').val('Add');
    });
    $('#employee_name').change(function(){
        var employee_id = $(this).val();
        var btn_action = 'Fetch Employee Data';
         $.ajax({
            url:"payroll_action.php",
            method:"POST",
            data:{employee_id:employee_id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
                // $('#employee_name').val(data.employee_name);
                alert(data);
            }
        })
    });

    $(document).on('submit','#payroll_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled','disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url:"payroll_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                $('#payroll_form')[0].reset();
                $('#payrollModal').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                $('#action').attr('disabled', false);
                payrolldataTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.update', function(){
        var payroll_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url:"payroll_action.php",
            method:"POST",
            data:{payroll_id:payroll_id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
                $('#payrollModal').modal('show');
                $('#employee_name').val(data.employee_name);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Category");
                $('#payroll_id').val(payroll_id);
                $('#action').val('Edit');
                $('#btn_action').val("Edit");
            }
        })
    });

    var payrolldataTable = $('#payroll_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"payroll_fetch.php",
            type:"POST"
        },
        "columnDefs":[
            {
                "targets":[3, 4],
                "orderable":false,
            },
        ],
        "pageLength": 25
    });
    $(document).on('click', '.delete', function(){
        var payroll_id = $(this).attr('id');
        var status = $(this).data("status");
        var btn_action = 'delete';
        if(confirm("Are you sure you want to change status?"))
        {
            $.ajax({
                url:"payroll_action.php",
                method:"POST",
                data:{category_id:category_id, status:status, btn_action:btn_action},
                success:function(data)
                {
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    payrolldataTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    });
    //Category Module
    $('#add_category').click(function(){
        $('#category_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Category");
        $('#action').val('Add');
        $('#btn_action').val('Addcategory');
    });

    $(document).on('submit','#category_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled','disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url:"category_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                $('#category_form')[0].reset();
                $('#categoryModal').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                $('#action').attr('disabled', false);
                categorydataTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.update', function(){
        var category_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url:"category_action.php",
            method:"POST",
            data:{category_id:category_id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
                $('#categoryModal').modal('show');
                $('#category_name').val(data.category_name);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Category");
                $('#category_id').val(category_id);
                $('#action').val('Edit');
                $('#btn_action').val("Edit");
            }
        })
    });

    var categorydataTable = $('#category_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"category_fetch.php",
            type:"POST"
        },
        "columnDefs":[
            {
                "targets":[3],
                "orderable":false,
            },
        ],
        "pageLength": 25
    });
    $(document).on('click', '.delete', function(){
        var category_id = $(this).attr('id');
        var status = $(this).data("status");
        var btn_action = 'delete';
        if(confirm("Are you sure you want to change status?"))
        {
            $.ajax({
                url:"category_action.php",
                method:"POST",
                data:{category_id:category_id, status:status, btn_action:btn_action},
                success:function(data)
                {
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    categorydataTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    });
    //Brand Module
    $('#add_brand').click(function(){
        $('#brandModal').modal('show');
        $('#brand_form')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Add Brand");
        $('#action').val('Add');
        $('#btn_action').val('Addbrand');
    });

    $(document).on('submit','#brand_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled','disabled');
        var form_data = $(this).serialize();
        $.ajax({
            url:"brand_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                $('#brand_form')[0].reset();
                $('#brandModal').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                $('#action').attr('disabled', false);
                branddataTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.update', function(){
        var brand_id = $(this).attr("id");
        var btn_action = 'fetch_single';
        $.ajax({
            url:'brand_action.php',
            method:"POST",
            data:{brand_id:brand_id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
                $('#brandModal').modal('show');
                $('#category_id').val(data.category_id);
                $('#brand_name').val(data.brand_name);
                $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Brand");
                $('#brand_id').val(brand_id);
                $('#action').val('Edit');
                $('#btn_action').val('Edit');
            }
        })
    });

    $(document).on('click','.delete', function(){
        var brand_id = $(this).attr("id");
        var status  = $(this).data('status');
        var btn_action = 'delete';
        if(confirm("Are you sure you want to change status?"))
        {
            $.ajax({
                url:"brand_action.php",
                method:"POST",
                data:{brand_id:brand_id, status:status, btn_action:btn_action},
                success:function(data)
                {
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    branddataTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    });


    var branddataTable = $('#brand_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"brand_fetch.php",
            type:"POST"
        },
        "columnDefs":[
            {
                "targets":[4],
                "orderable":false,
            },
        ],
        "pageLength": 10
    });
    //Order Module
    $('#inventory_order_date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    var orderdataTable = $('#order_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url:"order_fetch.php",
                type:"POST"
            },
            "columnDefs":[
                {
                    "targets":[4, 5, 6, 7],
                    "orderable":false,
                },
            ],

            "columnDefs":[
                {
                    "targets":[4, 5, 6, 7],
                    "orderable":false,
                },
            ],

            "pageLength": 10
        });

        // $('#add_order').click(function(){
        //     $('#orderModal').modal('show');
        //     $('#order_form')[0].reset();
        //     $('.modal-title').html("<i class='fa fa-plus'></i> Create Order");
        //     $('#action').val('Add');
        //     $('#btn_action').val('Addorder');
        //     $('#span_product_details').html('');
        //     add_product_row();
        // });

        // function add_product_row(count = '')
        // {
        //     var html = '';
        //     html += '<span id="row'+count+'"><div class="row">';
        //     html += '<div class="col-md-8">';
        //     html += '<select name="product_id[]" id="product_id'+count+'" class="form-control selectpicker" data-live-search="true" required>';
        //     html += "<?php echo fill_product_list($connect); ?>";
        //     html += '</select><input type="hidden" name="hidden_product_id[]" id="hidden_product_id'+count+'" />';
        //     html += '</div>';
        //     html += '<div class="col-md-3">';
        //     html += '<input type="text" name="quantity[]" class="form-control" required />';
        //     html += '</div>';
        //     html += '<div class="col-md-1">';
        //     if(count == '')
        //     {
        //         html += '<button type="button" name="add_more" id="add_more" class="btn btn-success btn-xs">+</button>';
        //     }
        //     else
        //     {
        //         html += '<button type="button" name="remove" id="'+count+'" class="btn btn-danger btn-xs remove">-</button>';
        //     }
        //     html += '</div>';
        //     html += '</div></div><br /></span>';
        //     $('#span_product_details').append(html);

        //     $('.selectpicker').selectpicker();
        // }

        // var count = 0;

        // $(document).on('click', '#add_more', function(){
        //     count = count + 1;
        //     add_product_row(count);
        // });
        // $(document).on('click', '.remove', function(){
        //     var row_no = $(this).attr("id");
        //     $('#row'+row_no).remove();
        // });

        $(document).on('submit', '#order_form', function(event){
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url:"order_action.php",
                method:"POST",
                data:form_data,
                success:function(data){
                    $('#order_form')[0].reset();
                    $('#orderModal').modal('hide');
                    $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                    $('#action').attr('disabled', false);
                    orderdataTable.ajax.reload();
                }
            });
        });

        $(document).on('click', '.update', function(){
           var inventory_order_id = $(this).attr("id");
           var btn_action = 'fetch_single';
           $.ajax({
            url:"order_action.php",
            method:"POST",
            data:{inventory_order_id:inventory_order_id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
             $('#orderModal').modal('show');
             $('#inventory_order_name').val(data.inventory_order_name);
             $('#inventory_order_date').val(data.inventory_order_date);
             $('#inventory_order_address').val(data.inventory_order_address);
             $('#span_product_details').html(data.product_details);
             $('#payment_status').val(data.payment_status);
             $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Order");
             $('#inventory_order_id').val(inventory_order_id);
             $('#action').val('Edit');
             $('#btn_action').val('Edit');
            }
           })
          });

        $(document).on('click', '.delete', function(){
            var inventory_order_id = $(this).attr("id");
            var status = $(this).data("status");
            var btn_action = "delete";
            if(confirm("Are you sure you want to change status?"))
            {
                $.ajax({
                    url:"order_action.php",
                    method:"POST",
                    data:{inventory_order_id:inventory_order_id, status:status, btn_action:btn_action},
                    success:function(data)
                    {
                        $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                        orderdataTable.ajax.reload();
                    }
                })
            }
            else
            {
                return false;
            }
        });
         //DTR Module
    $(document).on('submit','#dtr_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled','disabled');
        var form_data = $(this).serialize();

        $.ajax({
            url:"dtr_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                alert(data);
                $('#dtr_form')[0].reset();
                $('#action').attr('disabled', false);
               window.location.reload();
                
            }
        })
    });
    //Payroll Module
    $(document).on('change','#employee_id', function(event){
         var employee_id = $(this).val();
         var btn_action = 'fetch_employee_details';

       $.ajax({
            url:"dtr_action.php",
            method:"POST",
            data:{employee_id:employee_id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {
             $("#action").removeAttr("disabled");
              $('#employee_name').val(data.employeeName);
              $('#employee_hrwk').val(data.hrWorked);
              $('#employee_dyswk').val(data.daysWorked);
              $('#employee_sss').val(data.sss);
              $('#employee_phhealth').val(data.philhealth);
              $('#employee_pgibig').val(data.pagibig);
              $('#employee_netincome').val(data.netIncome);
              
            }
        })
    });
    $("#reportType").on('change',function(){
        var type = $(this).val();
        if(type=='inventory'){
            $("#inventory").css("display","");
             $("#print").css("display","");
            $("#sales").css("display","none");
             $("#employee").css("display","none");
            $("#payroll").css("display","none");
           
        }
        if(type=='sales'){
            $("#sales").css("display","");
             $("#print").css("display","");
             $("#inventory").css("display","none");
            $("#employee").css("display","none");
            $("#payroll").css("display","none");
        }
        if(type=='employee'){
            $("#employee").css("display","");
             $("#print").css("display","");
            $("#sales").css("display","none");
             $("#inventory").css("display","none");
             $("#payroll").css("display","none");
        }
        if(type=='payroll'){
            $("#payroll").css("display","");
             $("#print").css("display","");
            $("#employee").css("display","none");
            $("#sales").css("display","none");
             $("#inventory").css("display","none");
        }
        if(type==''){
             $("#print").css("display","none");
             $("#payroll").css("display","none");
            $("#employee").css("display","none");
            $("#sales").css("display","none");
             $("#inventory").css("display","none");
        }

    });
    
});