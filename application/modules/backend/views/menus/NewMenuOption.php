<style>
<!--
.margin-bottom-5{
	margin-bottom: 5px;
}
-->
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div id="page-wrapper">
	<div class="row">
		<div>
			<h1>Add Options for <?php echo $name;?></h1>
			<form id="createOptions" name="createOptions" method="post" action="<?php echo base_url();?>admin/menu/options/addoptions" enctype="multipart/form-data">
				<div id="messageContainer" ></div>
				<input  type="hidden" name="restid" id="restid" value="<?php echo $restid;?>" />
				<input  type="hidden" name="option_id" id="option_id" value="<?php echo $id;?>" />
				<input  type="hidden" name="item_size" id="item_size" value="<?php echo $size;?>" />
				<input type="hidden" name="option_count" id="option_count" value="1"/>
				<div class="panel panel-default">
					<div class="panel-body">
						<div id="options_area">
							<div id="category_1">
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-ocname">
										<label class="control-label col-sm-3">Option category Name <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input  type="text" name="ocname[]" class="form-control" value="" required="required"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-occhoice_type">
										<label class="control-label col-sm-3">Choice <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="occhoice_type[]"><option value="0">Single</option><option value="1">Multiple</option></select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-ocoptional_flag">
										<label class="control-label col-sm-3">Is Optional <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="ocoptional_flag[]"><option value="1">No</option><option value="0">Yes</option></select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-ocmin_options">
										<label class="control-label col-sm-3">Min options <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="number" class="form-control" name="ocmin_options[]" value="1" required="required" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-ocmax_options">
										<label class="control-label col-sm-3">Max options <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="number" class="form-control" name="ocmax_options[]" value="1" required="required"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-ocsortorder">
										<label class="control-label col-sm-3">Sort order</label>
										<div class="col-sm-5">
											<input type="number" class="form-control" name="ocsortorder[]" value="1" required="required"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-ocdescription">
										<label class="control-label col-sm-3">Description</label>
										<div class="col-sm-5">
											<textarea class="form-control" name="ocdescription[]" rows="4" cols="50" ></textarea>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row" style="overflow-x:scroll;">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
										<th>Name</th>
										<th>Size</th>
										<th>Description</th>
										<th>Price</th>
										<th>Sort Order</th>
										<th>Default Option</th>
										<th>Start Date</th>
										<th>End Date</th>
										<th>Start Time</th>
										<th>End Time</th>
										<th>Calories</th>
										<th>Image</th>
										<th>Actions</th>
										</tr>
									</thead>
									<tbody id="options1">
										<tr>
											<td class="username-coloured"><input class="form-control" type="text" name="name1[]" value="" style="width:200px;" required="required"/></td>
											<td class="username-coloured"><input class="form-control" type="text" name="size1[]" style="width:80px;" value="standard" /></td>
											<td class="username-coloured"><textarea class="form-control" style="margin: 0px; width: 160px; height: 50px;" name="desription1[]" rows="5" cols="50"></textarea></td>
											<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 80px;" type="number" name="price1[]" value="0" required="required"/></td>
											<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 60px;" type="number" name="sortorder1[]" value="1" /></td>
											<td class="username-coloured"><select class="form-control" style="margin: 0px; width: 60px;" name="is_default1[]"><option value="0">No</option><option value="1">Yes</option></select></td>
											<td class="username-coloured"><input class="form-control date_picker" type="text" name="start_date1[]" value="<?php echo date('Y-m-d');?>" style="width:120px;" required="required"/></td>
											<td class="username-coloured"><input class="form-control date_picker" type="text" name="end_date1[]" style="width:120px;" value="" /></td>
											<td class="username-coloured"><input class="form-control" type="text" name="start_time1[]" value="00:00:00" required="required" style="width:100px;"/></td>
											<td class="username-coloured"><input class="form-control" type="text" name="end_time1[]" value="23:59:00" required="required" style="width:100px;"/></td>
											<td class="username-coloured"><input class="form-control" type="number" style="margin: 0px; width: 60px;" name="calories1[]" value="" /></td>
											<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 120px;" type="file" name="image1[]" value="" /></td>
											<td>&nbsp;</td>
										</tr>
									</tbody>
								</table>
								<button type="button" name="add_more_items" onclick="addMoreItems(1);" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> Add More Items</button>
							</div>
							</div>
						</div>
						<button name="add_more" id="add_more" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> Add More Options</button>
					</div>
					<input class="btn btn-success" type="submit" id="addoptions" value="Save Options" style="margin-left:15px;" /><br><br>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery-ui.min.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	$( ".date_picker" ).datepicker({ dateFormat: "yy-mm-dd" }); 
	$('#createOptions').bootstrapValidator({
		container: function($field, validator) {
			return $field.parent().next('.messageContainer');
	   	},
	    feedbackIcons: {
	        validating: 'glyphicon glyphicon-refresh'
	    },
	    excluded: ':disabled',
	    fields: {
	    	'ocname[]': {
	            validators: {
	                notEmpty: {
	                    message: 'Option Category Name is required and cannot be empty'
	                }
	            }
	        },
	        'ocmin_options[]': {
	            validators: {
	                notEmpty: {
	                    message: 'Minimum options is required and cannot be empty'
	                },
	                numeric: {
	                    message: 'Invalid Min Options',
	                }
	            }
	        },
	        'ocmax_options[]': {
	            validators: {
	                notEmpty: {
	                    message: 'Max options is required and cannot be empty'
	                },
	                numeric: {
	                    message: 'Invalid Max Options',
	                }
	            }
	        }
	    }
	});
});


function removeOption(id) {
	var option_count = parseInt($("#option_count").val());
	option_count--;
	$("#category_"+id).remove();
	$("#option_count").val(option_count);
}

$("#createOptions").on("click","#add_more",function(e) {
	e.preventDefault();
	var option_count = parseInt($("#option_count").val());
	option_count++;
	var html = '<div id="category_'+option_count+'">'+
		'<div class="row"><div><button type="button" class="btn btn-danger pull-right" onclick="removeOption('+option_count+');">X</button></div>'+
			'<div class="col-lg-12 margin-bottom-5">'+
				'<div class="form-group" id="error-ocname">'+
					'<label class="control-label col-sm-3">Option category Name <span class="text-danger">*</span></label>'+
					'<div class="col-sm-5">'+
						'<input  type="text" name="ocname[]" class="form-control" value="" required="required"/>'+
					'</div>'+
					'<div class="messageContainer col-sm-4"></div>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'<div class="row">'+
			'<div class="col-lg-12 margin-bottom-5">'+
				'<div class="form-group" id="error-occhoice_type">'+
					'<label class="control-label col-sm-3">Choice <span class="text-danger">*</span></label>'+
					'<div class="col-sm-5">'+
						'<select class="form-control" name="occhoice_type[]"><option value="0">Single</option><option value="1">Multiple</option></select>'+
					'</div>'+
					'<div class="messageContainer col-sm-4"></div>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'<div class="row">'+
			'<div class="col-lg-12 margin-bottom-5">'+
				'<div class="form-group" id="error-ocoptional_flag">'+
					'<label class="control-label col-sm-3">Is Optional <span class="text-danger">*</span></label>'+
					'<div class="col-sm-5">'+
						'<select class="form-control" name="ocoptional_flag[]"><option value="1">No</option><option value="0">Yes</option></select>'+
					'</div>'+
					'<div class="messageContainer col-sm-4"></div>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'<div class="row">'+
			'<div class="col-lg-12 margin-bottom-5">'+
				'<div class="form-group" id="error-ocmin_options">'+
					'<label class="control-label col-sm-3">Min options <span class="text-danger">*</span></label>'+
					'<div class="col-sm-5">'+
						'<input type="number" class="form-control" name="ocmin_options[]" value="1" required="required" />'+
					'</div>'+
					'<div class="messageContainer col-sm-4"></div>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'<div class="row">'+
			'<div class="col-lg-12 margin-bottom-5">'+
				'<div class="form-group" id="error-ocmax_options">'+
					'<label class="control-label col-sm-3">Max options <span class="text-danger">*</span></label>'+
					'<div class="col-sm-5">'+
						'<input type="number" class="form-control" name="ocmax_options[]" value="1" required="required"/>'+
					'</div>'+
					'<div class="messageContainer col-sm-4"></div>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'<div class="row">'+
			'<div class="col-lg-12 margin-bottom-5">'+
				'<div class="form-group" id="error-ocsortorder">'+
					'<label class="control-label col-sm-3">Sort order</label>'+
					'<div class="col-sm-5">'+
						'<input type="number" class="form-control" name="ocsortorder[]" value="1" required="required"/>'+
					'</div>'+
					'<div class="messageContainer col-sm-4"></div>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'<div class="row">'+
			'<div class="col-lg-12 margin-bottom-5">'+
				'<div class="form-group" id="error-ocdescription">'+
					'<label class="control-label col-sm-3">Description</label>'+
					'<div class="col-sm-5">'+
						'<textarea class="form-control" name="ocdescription[]" rows="4" cols="50" ></textarea>'+
					'</div>'+
					'<div class="messageContainer col-sm-4"></div>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'<div class="row" style="overflow-x:scroll;">'+
			'<table class="table table-striped table-bordered table-hover">'+
				'<thead>'+
					'<tr>'+
					'<th>Name</th>'+
					'<th>Size</th>'+
					'<th>Description</th>'+
					'<th>Price</th>'+
					'<th>Sort Order</th>'+
					'<th>Default Option</th>'+
					'<th>Start Date</th>'+
					'<th>End Date</th>'+
					'<th>Start Time</th>'+
					'<th>End Time</th>'+
					'<th>Calories</th>'+
					'<th>Image</th>'+
					'<th>Actions</th>'+
					'</tr>'+
				'</thead>'+
				'<tbody id="options'+option_count+'">'+
					'<tr>'+
						'<td class="username-coloured"><input type="text" class="form-control" name="name'+option_count+'[]" value="" style="width:200px;" required="required"/></td>'+
						'<td class="username-coloured"><input type="text" class="form-control" name="size'+option_count+'[]" value="standard" style="width:80px;" /></td>'+
						'<td class="username-coloured"><textarea class="form-control" style="margin: 0px; width: 160px; height: 50px;" name="desription'+option_count+'[]" rows="5" cols="50"></textarea></td>'+
						'<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 80px;" type="number" name="price'+option_count+'[]" value="0" required="required"/></td>'+
						'<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 60px;" type="number" name="sortorder'+option_count+'[]" value="1" /></td>'+
						'<td class="username-coloured"><select class="form-control" style="margin: 0px; width: 60px;" name="is_default'+option_count+'[]"><option value="0">No</option><option value="1">Yes</option></select></td>'+
						'<td class="username-coloured"><input type="text" class="form-control date_picker" name="start_date'+option_count+'[]" value="<?php echo date('Y-m-d');?>" style="width:120px;" required="required"/></td>'+
						'<td class="username-coloured"><input type="text" class="form-control date_picker" name="end_date'+option_count+'[]" value="" style="width:120px;"/></td>'+
						'<td class="username-coloured"><input type="text" class="form-control" name="start_time'+option_count+'[]" value="00:00:00" style="width:100px;" required="required"/></td>'+
						'<td class="username-coloured"><input type="text" class="form-control" name="end_time'+option_count+'[]" value="23:59:00" style="width:100px;" required="required"/></td>'+
						'<td class="username-coloured"><input type="number" class="form-control" style="margin: 0px; width: 60px;" name="calories'+option_count+'[]" value="" /></td>'+
						'<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 120px;" type="file" name="image'+option_count+'[]" value="" /></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
				'</tbody>'+
			'</table>'+
			'<button type="button" name="add_more_items" onclick="addMoreItems('+option_count+');" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> Add More Items</button>'+
		'</div>'+
		'</div>';
	$("#options_area").append(html);
	$("#option_count").val(option_count);		    
});

function addMoreItems(id) {
	var html = '<tr>'+
	'<td class="username-coloured"><input type="text" class="form-control" name="name'+id+'[]" value="" style="width:200px;" required="required"/></td>'+
	'<td class="username-coloured"><input type="text" class="form-control" name="size'+id+'[]" value="standard" style="width:80px;"/></td>'+
	'<td class="username-coloured"><textarea class="form-control" style="margin: 0px; width: 160px; height: 50px;" name="desription'+id+'[]" rows="5" cols="50"></textarea></td>'+
	'<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 80px;" type="number" name="price'+id+'[]" value="0" required="required"/></td>'+
	'<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 60px;" type="number" name="sortorder'+id+'[]" value="1" /></td>'+
	'<td class="username-coloured"><select class="form-control" style="margin: 0px; width: 60px;" name="is_default'+id+'[]"><option value="0">No</option><option value="1">Yes</option></select></td>'+
	'<td class="username-coloured"><input type="text" class="form-control date_picker" name="start_date'+id+'[]" value="<?php echo date('Y-m-d');?>" style="width:120px;" required="required"/></td>'+
	'<td class="username-coloured"><input type="text" class="form-control date_picker" name="end_date'+id+'[]" value="" style="width:120px;"/></td>'+
	'<td class="username-coloured"><input type="text" class="form-control" name="start_time'+id+'[]" value="00:00:00" style="width:100px;" required="required"/></td>'+
	'<td class="username-coloured"><input type="text" class="form-control" name="end_time'+id+'[]" value="23:59:00" style="width:100px;" required="required"/></td>'+
	'<td class="username-coloured"><input type="number" class="form-control" style="margin: 0px; width: 60px;" name="calories'+id+'[]" value="" /></td>'+
	'<td class="username-coloured"><input class="form-control" style="margin: 0px; width: 120px;" type="file" name="image'+id+'[]" value="" /></td>'+
	'<td><button type="button" class="remove_items btn btn-danger btn-sm">X</button></td>'+
	'</tr>';
	$("#options"+id).append(html);
}

$("#createOptions").on("click",".remove_items",function(e) {
	$(this).closest("tr").remove();
});


</script>
