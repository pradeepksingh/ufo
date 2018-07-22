<div id="page-wrapper" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h3>Add Category</h3>
			</div>
		</div>
		<form id="editAttribute" name="editAttribute" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" value="<?php echo $attribute[0]['attribute_id'];?>" name="id" />
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
							<?php //print_r($attribute);?>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group" id="error-name">
											<label class="control-label col-sm-3">Attribute Group <span class='text-danger'>*</span></label>
											<select name="attribute_group_id" id="attribute_group_id" class="form-control">
													<option value=""> Select Attribute </option>
													<?php foreach ($attrgroups as $attrgroup) { ?>
													<option value="<?php echo $attrgroup['attribute_group_id'];?>"  <?php if($attrgroup['attribute_group_id'] == $attribute[0]['attribute_group_id']) { ?>selected<?php } ?> ><?php echo $attrgroup['name'];?></option>
													<?php } ?>
											</select>
											<!--<input type="text" class="form-control" id="vname" name="vname" />-->
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-sm-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Attribute Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="name" value="<?php echo $attribute[0]['name'];?>" name="name" />
										</div>
										<div class="messageContainer "></div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Value <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="value"  value="<?php echo $attribute[0]['value'];?>" name="value" />
										</div>
										<div class="messageContainer "></div>
									</div>
									<div class="col-sm-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Sort Order <span class='text-danger'></span></label>
											<input type="text" class="form-control" id="sort_order"  value="<?php echo $attribute[0]['sort_order'];?>" name="sort_order" value="0" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
									<div class="col-sm-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status<span class='text-danger'></span></label>
											<select class="form-control" name="status">
												<option value="1" <?php if($attribute[0]['status'] == '1') { ?>selected<?php } ?>>Enable</option>
												<option value="0" <?php if($attribute[0]['status'] == '0') { ?>selected<?php } ?>>Disable</option>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
								 <div class="text-center">
									<div id="response"></div>
									<button type="submit" class="btn btn-success">Submit</button>
									<br>
								 </div>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</form>
</div>
</div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$('#editAttribute').bootstrapValidator({
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
                    message: 'Attribute Name is required and cannot be empty'
                }
            }
        },
    value: {
	        validators: {
	            notEmpty: {
	                message: 'Attribute Value is required and cannot be empty'
	            }
	        }
	    }
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	editAttribute();
});

function editAttribute() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/attribute/update',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#editAttribute').ajaxSubmit(options);
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
        window.location.href = base_url+"admin/attribute/list";
  	}
}
</script>