<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h3>Add Category</h3>
			</div>
		</div>
		<form id="addcategory" name="addcategory" action="" method="post" enctype="multipart/form-data">
			<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Category Name <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="name" name="name" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
		                              	<div class="form-group" id="error-image">
	                                       	<label class="control-label ">Upload Image (300 X 225 px) <span class='text-danger'>*</span></label>
	                                       	<input type="file" value="" name="image" id="image" class="form-control " >
										</div>
										<div class="messageContainer col-sm-4"></div>
	                                </div>
                                </div>
								<div class="row">
	                                <div class="col-md-12">
										<div class="form-group" id="error-name">
											<label class="control-label"> Description <span class='text-danger'>*</span></label>
											<textarea rows="6" class="form-control" id="description" name="description" /></textarea> 
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Sort Order <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="sort_order" name="sort_order" value ="0" />
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label"> Meta Tiltle <span class='text-danger'>*</span></label>
											<input type="text" class="form-control" id="meta_title" name="meta_title" />
										</div>
										<div class="messageContainer"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Meta Description <span class='text-danger'>*</span></label>
											<textarea  class="form-control" id="meta_description" name="meta_description" > </textarea>
											<div class="messageContainer"></div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Meta Keyword <span class='text-danger'>*</span></label>
											<textarea  class="form-control" id="meta_keyword" name="meta_keyword" > </textarea>
											<div class="messageContainer"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Status <span class='text-danger'>*</span></label>
											<select id="status" class="form-control" name="status">
												<option value="1">Enable</option>
												<option value="0">Disable</option>
											</select>
										</div>
										<div class="messageContainer"></div>
									</div>
									<div class="col-md-6">
										<div class="form-group" id="error-name">
											<label class="control-label">Parent Category <span class='text-danger'>*</span></label>
											<select id="parent_id" name="parent_id" class="form-control" >
											<option value="">Select Category</option>
											<?php foreach($categories as $category) {?>
												
												<option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
												<?php }?>
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
$('#addcategory').bootstrapValidator({
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
	addCategory();
});

function addCategory() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/category/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addcategory').ajaxSubmit(options);
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