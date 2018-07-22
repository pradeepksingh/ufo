<style>
<!--
.margin-bottom-5 {
	margin-bottom: 5px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3>Add SubCategory</h3>
		</div>
	</div>
	<form id="addcity" name="addcity" action="" method="post" enctype="multipart/form-data">
		<div id="basic" class="tab-pane fade in active">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Vendor Name <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select name="cat_id" id="cat_id" class="form-control">
													<option value=""> Select Vendor </option>
													<?php foreach ($vendors as $vendor) { ?>
													<option value="<?php echo $vendor['id'];?>" ><?php echo $vendor['name'];?></option>
													<?php } ?>
											</select>
											<!--<input type="text" class="form-control" id="vname" name="vname" />-->
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
						    <div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-cat_id">
											<label class="control-label col-sm-3">Select Category <span class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<select name="cat_id" id="cat_id" class="form-control">
													<option value=""> Select Category </option>
													<?php foreach ($categories as $category) { ?>
													<option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
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
										<label class="control-label col-sm-3">SubCategory Name <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="name" name="name" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
						    <div class="row">
		                          	<div class="col-lg-12 margin-bottom-5">
		                              	<div class="form-group" id="error-image">
	                                       	<label class="control-label col-sm-3">Upload Image (300 X 225 px) <span class='text-danger'>*</span></label>
	                                      	<div class="col-sm-5">
		                                       	<input type="file" value="" name="image" id="image" class="form-control " >
											</div>
											<div class="messageContainer col-sm-4"></div>
	                                   	</div>
		                           	</div>
		                     </div>
							 <div class="text-center">
									<div id="response"></div>
									<button type="submit" class="btn btn-success">Submit</button>
							 </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$('#addcity').bootstrapValidator({
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
                    message: 'SubCategory Name is required and cannot be empty'
                }
            }
        },
        cat_id: {
            validators: {
                notEmpty: {
                    message: 'Category Name is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addCategory();
});

function addCategory() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/subcategory/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addcity').ajaxSubmit(options);
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
        window.location.href = base_url+"admin/subcategory/list/0";
  	}
}
</script>