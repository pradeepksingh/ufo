<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h3>Edit Category</h3>
			</div>
		</div>
		<form id="editcategory" name="editcategory" action="" method="post" enctype="multipart/form-data">
		<?php //print_r($categories);?>
		<input type="hidden" name="id" value="<?php echo $categories[0]['id'];?>"/>
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Category Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $categories[0]['name'];?>" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
		                              	<div class="form-group" id="error-image">
	                                       	<label class="control-label ">Upload Image (300 X 225 px) <span class='text-danger'>*</span></label>
	                                       	<input type="file" value="" name="image" id="image" value="<?php echo $categories[0]['image'];?>" class="form-control " >
										</div>
										<span>
											<img src="<?php echo asset_url();?><?php echo $categories[0]['image'];?>" width="160px" height="80px" />
										</span>
										<div class="messageContainer col-sm-4"></div>
	                                </div>
                                </div>
								<div class="row">
	                                <div class="col-md-12">
										<div class="form-group" id="error-name">
											<label class="control-label"> Description <span class='text-danger'>*</span></label>
											<textarea rows="6" class="form-control" id="description" name="description" ><?php echo $categories[0]['description'];?></textarea> 
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Sort Order <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $categories[0]['sort_order'];?>" id="sort_order" name="sort_order" value ="0" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label"> Meta Tiltle <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" value="<?php echo $categories[0]['meta_title'];?>" id="meta_title" name="meta_title" />
										</div>
										<div class="messageContainer"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Meta Description <span class='text-danger'>*</span></label>
											<textarea  class="form-control" id="meta_description" name="meta_description" ><?php echo $categories[0]['meta_description'];?></textarea>
											<div class="messageContainer"></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Meta Keyword <span class='text-danger'>*</span></label>
											<textarea  class="form-control" id="meta_keyword" name="meta_keyword" ><?php echo $categories[0]['meta_keyword'];?></textarea>
											<div class="messageContainer"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status <span class='text-danger'>*</span></label>
											<select id="status" class="form-control" name="status">
												<option value="1" <?php if(isset($categories[0]['status']) && $categories[0]['status'] == 1) {?>selected<?php }?>>Enable</option>
												<option value="0" <?php if(isset($categories[0]['status']) && $categories[0]['status'] == 0) {?>selected<?php }?>>Disable</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Parent Category <span class='text-danger'>*</span></label>
											<select id="parent_id" name="parent_id" class="form-control" >
											<option value="">Select Category</option>
											<?php foreach($pcategory as $category) {?>
											
												<option value="<?php echo $category['id'] ?>" <?php if($category['id'] == $categories[0]['parent_id']) {?>selected<?php }?>><?php echo $category['name'] ?></option>
												
											<?php  } ?>
											</select>
										</div>
										<div class="messageContainer"></div>
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
$('#editcategory').bootstrapValidator({
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
                    message: 'Category Name is required and cannot be empty'
                }
            }
        }
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateCategory();
});

function updateCategory() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/category/update',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#editcategory').ajaxSubmit(options);
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
        window.location.href = base_url+"admin/category/list";
  	}
}
</script>