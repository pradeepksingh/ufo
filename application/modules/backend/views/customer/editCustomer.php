		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">Employee > Update Client</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Update Client</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                <?php foreach ($customers as $customer){?>
                                    <form action="" id="updateclientform"  name="updateclientform" method="post">
                                    <input type="hidden" id="id" name="id" value="<?php echo $customer['id']; ?>" />
                                    <input type="hidden" id="otp" name="otp" value="<?php echo $customer['otp']; ?>" />
                                    <input type="hidden" id="coupon_code" name="coupon_code" value="<?php echo $customer['coupon_code'];?>" />
                                    <input type="hidden" id="created_on" name="created_on" value="<?php  echo $customer['created_on'];?>" />
                                    <input type="hidden" id="last_login" name="last_login" value="<?php echo $customer['last_login'];?>" />
                                    <input type="hidden" id="source" name="source" value="<?php echo $customer['source'];?>" />
                                        <div class="form-body">
                                            <h3 class="box-title">Client Info</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Name</label>
                                                        <input type="text" id="name" name="name" value="<?php echo $customer['name'];?>" class="form-control" placeholder="Enter name"> 
                                                     </div>
                                                     <div class="messageContainer"></div>
                                                </div>
                                              
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" id="mobile" name="mobile" value="<?php echo $customer['mobile']; ?>" class="form-control" placeholder="Phone"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" id="email" name="email" value="<?php echo $customer['email'];?>" class="form-control" placeholder="Enter email address"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Password</label>
                                                       	<input type="password" id="password" name="password" value="<?php echo $customer['original'];?>" class="form-control" placeholder="Set password for customer">
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
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> update</button>
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
$('#updateclientform').bootstrapValidator({
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
	updateNewCustomer();
});
function updateNewCustomer() {
	$.post(base_url+"admin/customer/update", { id :$("#id").val(), name: $("#name").val(), email: $("#email").val(), mobile: $("#mobile").val(), password: $("#password").val(), otp:$("#otp").val(), coupon_code : $("#coupon_code").val(), created_on: $("#created_on").val(), last_login : $("#last_login").val(), source : $("#source").val()}, function(data){
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