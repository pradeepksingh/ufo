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
			<h3>Update SubCategory</h3>
		</div>
	</div>
	<form id="additem" name="additem" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $subcat['id'];?>"/>
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
											<input type="text" class="form-control" id="vname" name="vname" />
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
													<option value="<?php echo $category['id'];?>" <?php if($category['id'] == $subcat['cat_id']) {?>selected<?php }?>><?php echo $category['name'];?></option>
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
												<input type="text" class="form-control" name="name" id="name" value="<?php echo $subcat['name'];?>"/>
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
		                                       	<input type="file" value="" name="image" id="image" class="form-control " />
											</div>
											<div class="messageContainer col-sm-4"></div>
											<?php if(!empty($subcat['image'])) { ?>
											<div class="col-sm-offset-3 col-sm-5"><img src="<?php echo asset_url();?><?php echo $subcat['image'];?>" width="80"/></div>
											<?php } ?>
	                                   	</div>
		                           	</div>
		                     </div>
							 <div class="text-center">
									<div id="response"></div>
									<button type="submit" class="btn btn-success">Update</button>
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
$('#additem').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('div.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	'cat_id': {
            validators: {
                notEmpty: {
                    message: 'Services Name is required and cannot be empty'
                }
            }
        },
        'name': {
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
	updateItem();
});

function updateItem() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'crm/item/subcategory/update',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#additem').ajaxSubmit(options);
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
		$("#response").html(resp.msg);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"crm/item/subcategory/"+$("#cat_id").val();
  	}
}

</script>