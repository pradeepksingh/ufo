		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">Employee > Add Client</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Add New Client</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="" id="client-form"  method="post">
                                        <div class="form-body">
                                            <h3 class="box-title">Client Info</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Name</label>
                                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter name"> 
                                                     </div>
                                                     <div class="messageContainer"></div>
                                                </div>
                                              
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" id="mobile" name="mobile" class="form-control" placeholder="Phone"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" id="email" name="email" value="" class="form-control" placeholder="Enter email address"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Password</label>
                                                       	<input type="password" id="password" name="password" value="" class="form-control" placeholder="Set password for Customer">
                                                     </div>
                                                     <div class="messageContainer"></div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <hr>
                                              <div class="danger"  style="color:red;"><h3 id="profile_response"></h3></div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-default">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
		</div>
		<script type="text/javascript" src="<?php echo asset_url();?>js/bootstrapValidator.min.js" ></script>
<script>
$('#client-form').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
  		name: {
            validators: {
                notEmpty: {
                    message: 'Name is required and cannot be empty'
                }
            }
        }, 
        email: {
            validators: {
            	notEmpty: {
                    message: 'Email is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
                }
        		
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                }
            }
        },
        mobile: {
            validators: {
                notEmpty: {
                    message: 'Mobile is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
        		
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	addNewCustomer();
});
function addNewCustomer() {
	//alert('Hello');
	$.post(base_url+"admin/customer/add", { name: $("#name").val(), email: $("#email").val(), mobile: $("#mobile").val(), password: $("#password").val()}, function(data){
		if(data.status == 1) {
			alert(data.msg);
			window.location.href = base_url+"admin/customer";
		} else {
			$("#profile_response").show();
			alert(data.msg);
			$("#profile_response").html(data.msg);
		}
	},'json');
}
</script>