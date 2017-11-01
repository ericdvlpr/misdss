 $(document).ready(function(){  
           load_data();  
           $('#action').val("Insert");  
           function load_data()  
           {  
                var action = "Load";  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{action:action},  
                     success:function(data)  
                     {  
                          $('#user_table').html(data);  
                     }  
                });  
           }  
           $('#user_form').on('submit', function(event){  
                event.preventDefault();  
                var firstName = $('#first_name').val();  
                var lastName = $('#last_name').val();  
                var extension = $('#user_image').val().split('.').pop().toLowerCase();  
                if(extension != '')  
                {  
                     if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                     {  
                          alert("Invalid Image File");  
                          $('#user_image').val('');  
                          return false;  
                     }  
                }  
                if(firstName != '' && lastName != '')  
                {  
                     $.ajax({  
                          url:"action.php",  
                          method:"POST",  
                          data:new FormData(this),  
                          contentType:false,  
                          processData:false,  
                          success:function(data)  
                          {  
                               alert(data);  
                               $('#user_form')[0].reset();  
                               load_data();  
                          }  
                     })  
                }  
                else  
                {  
                     alert("Both Fields are Required");  
                }  
           });  
      });  