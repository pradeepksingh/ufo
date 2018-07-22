		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">Employee > Add User</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Add New User</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                <?php foreach($users as $user){?>
                                    <form action="" id="executive-form"  method="post">
                                        <div class="form-body">
                                            <h3 class="box-title">User Info</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">First Name</label>
                                                        <input type="hidden" id="id" name="id" value="<?php echo $user['id']; ?>" class="form-control" placeholder="Enter first name"> 
                                                        <input type="text" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" class="form-control" placeholder="Enter first name"> 
                                                     </div>
                                                     <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Last Name</label>
                                                        <input type="text" id="last_name" value="<?php echo $user['last_name']; ?>"  name="last_name" class="form-control" placeholder="Enter last name"> 
                                                     </div>
                                                     <div class="messageContainer"></div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" class="form-control" placeholder="Phone"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" readonly value="" class="form-control" placeholder="Enter email address"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">User Role</label>
                                                       <select class="form-control" id="user_role" name="user_role" required class="form-control">
                                                      	 <option value="">Select Role</option>
                                                      	 <option value="1" <?php if($user['user_role']==1){ echo "selected";} ?>>Admin</option>
                                                      	 <option value="2" <?php if($user['user_role']==2){ echo "selected";} ?>>Executive</option>
                                                       </select>
                                                     </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Status</label>
                                                       <select class="form-control" id="status" name="status" required class="form-control">
                                                       	 <option value="">Select Status</option>
                                                      	 <option value="1" <?php if($user['status']==1){ echo "selected";} ?>>Enable</option>
                                                      	 <option value="0" <?php if($user['status']==0){ echo "selected";} ?>>Disable</option>
                                                       </select>
                                                     </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Password</label>
                                                       	<input type="password" id="password" name="password" value="<?php echo $user['text_password']; ?>" class="form-control" placeholder="Set password for Employee">
                                                     </div>
                                                     <div class="messageContainer"></div>
                                                </div>
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
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
		</div>
		<script type="text/javascript" src="<?php echo asset_url();?>js/bootstrapValidator.min.js" ></script>
<script>
$('#executive-form').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
  		first_name: {
            validators: {
                notEmpty: {
                    message: 'First Name is required and cannot be empty'
                }
            }
        }, 
        last_name: {
            validators: {
                notEmpty: {
                    message: 'Last Name is required and cannot be empty'
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
	addNewEmployee();
});
function addNewEmployee() {
	//alert('Hello');
	$.post(base_url+"admin/user/update", { id :$("#id").val(), first_name: $("#first_name").val(), last_name: $("#last_name").val(), email: $("#email").val(), mobile: $("#mobile").val(), status: $("#status").val(),  user_role: $("#user_role").val(),  password: $("#password").val()}, function(data){
		if(data.status == 1) {
			alert(data.msg);
			window.location.href = base_url+"admin/users";
		} else {
			$("#profile_response").show();
			alert(data.msg);
			$("#profile_response").html(data.msg);
		}
	},'json');
}
</script>