<style>
<!--
.margin-bottom-5 {
	margin-bottom: 5px;
}
-->
</style>
<link href="<?php echo base_url();?>assets/css/selectize.bootstrap3.css" rel="stylesheet">
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3>Add Client</h3>
		</div>
	</div>
	<form id="addclient" name="addclient" action="" method="post">
		<div id="basic" class="tab-pane fade in active">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Select Restaurant <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select name="restid[]" id="restid" class="form-control" multiple>
												<option value=""> Select Restaurant </option>
												<?php foreach ($restaurants as $restaurant) { ?>
												<option value="<?php echo $restaurant['id'];?>"><?php echo $restaurant['name'];?> (<?php echo $restaurant['area_name'];?>)</option>
												<?php } ?>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Brand Name</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="brand_name" name="brand_name" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Brand Email</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="brand_email" name="brand_email" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Brand Email Password</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="brand_email_password" name="brand_email_password" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">SMS Provider</label>
										<div class="col-sm-5">
											<select name="sms_provider" id="sms_provider" class="form-control">
												<option value="olotime">OLO Time</option>
												<option value="smsgupshup">SMS GUPSHUP</option>
												<option value="mvayoo">MVayoo</option>
												<option value="smscountry">SMS Country</option>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">SMS Username</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="sms_username" name="sms_username" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">SMS Password</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="sms_password" name="sms_password" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">User Name <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="username" name="username" autocomplete="off"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Password <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="password" class="form-control" id="password" name="password" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="response"></div>
		<button type="submit" class="btn btn-success">Submit</button>
		<br> <br>
	</form>
</div>
<script src="<?php echo base_url();?>assets/js/selectize.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$('#restid').selectize({
    plugins: ['remove_button'],
    delimiter: ',',
    persist: false,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
});
$("#restid").change(function() {
	var restid = $("#restid").val();
	$("#username").val("ZK"+restid[0]);	
});
$('#addclient').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        username: {
            validators: {
                notEmpty: {
                    message: 'User Name is required and cannot be empty'
                }
            }
        },
        brand_name: {
            validators: {
                notEmpty: {
                    message: 'Brand Name is required and cannot be empty'
                }
            }
        },
	    'restid[]': {
	        validators: {
	            notEmpty: {
	                message: 'Restaurant name is required'
	            }
	        }
	    },
	    password: {
	        validators: {
	            notEmpty: {
	                message: 'Password is required'
	            }
	        }
	    }
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addClient();
});

function addClient() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/restaurant/addclient',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addclient').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.msg.name);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"admin/restaurant/clients";
  	}
}


</script>