<div id="messageContainer" ></div>
<form id="newMenuAdd" enctype="multipart/form-data" name="newMenuAdd" method="post" action="<?php echo base_url();?>admin/menus/menu/addcategory">
	<input type="hidden" name="restid" value="<?php echo $restid;?>" />
	<input type="hidden" name="id" value="<?php echo $id;?>" />
	<input type="hidden" name="new_menu_mcat_id" id="new_menu_mcat_id" value="<?php echo $id;?>">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12 margin-bottom-5">
						<div class="form-group" id="error-name">
							<label class="control-label col-sm-3">Main category</label>
							<div class="col-sm-5">
								<?php echo $name;?>
							</div>
							<div class="messageContainer col-sm-4"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 margin-bottom-5">
						<div class="form-group" id="error-name">
							<label class="control-label col-sm-3">Category Name <span class='text-danger'>*</span></label>
							<div class="col-sm-5">
								<input type="text" name="newcname" value="" class="form-control" required="required">
							</div>
							<div class="messageContainer col-sm-4"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 margin-bottom-5">
						<div class="form-group" id="error-name">
							<label class="control-label col-sm-3">Category image </label>
							<div class="col-sm-5">
								<input class="form-control" type="file" name="newcimage" id="newcimage">
							</div>
							<div class="messageContainer col-sm-4"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 margin-bottom-5">
						<div class="form-group" id="error-name">
							<label class="control-label col-sm-3">Category Sort Order <span class='text-danger'>*</span></label>
							<div class="col-sm-5">
								<input type="number" class="form-control" name="newcsortorder" value="1" required="required">
							</div>
							<div class="messageContainer col-sm-4"></div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 margin-bottom-5">
						<div class="form-group" id="error-name">
							<label class="control-label col-sm-3">Category Description</label>
							<div class="col-sm-5">
								<textarea class="form-control" id="newcdescription" name="newcdescription" rows="4" cols="50" ></textarea>
							</div>
							<div class="messageContainer col-sm-4"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<button class="btn btn-success" type="submit" id="addcategory" title="Add Category"><i class="fa fa-plus"></i> Add Category</button>
</form>
 <div id="popupnewitems" class="row" style="margin-top:10px;;border-top:dotted #EFEFEF;display:none">
	<form id="newitemform" class="validateDontSubmit" enctype="multipart/form-data">
	<div class="row" style="margin:0px;">
		<input type="hidden" name="catid" id="popup_menu_cat_id" value=""/>
		<div class="panel panel-default" style="overflow-x:scroll;">
			<div class="panel-body">
				<table id="popupitemtable" class="table table-striped table-bordered table-hover">
					<thead>
						<th style="text-align: center;width:32px;">Item Name</th>
						<th style="text-align: center">Size</th>
						<th style="text-align: center">Description</th>
						<th style="text-align: center">Price</th>
						<th style="text-align: center">Vat Tax</th>
						<th style="text-align: center">Ser. Tax</th>
						<th style="text-align: center">Start Time</th>
						<th style="text-align: center">End Time</th>
						<th style="text-align: center">Color</th>
						<th style="text-align: center">Packaging</th>
						<th style="text-align: center">Start Date</th>
						<th style="text-align: center">End Date</th>
						<th style="text-align: center">Image</th>
						<th style="text-align: center">Actions</th>
					</thead>
					<tr class="row2" >
						<input type="hidden" name="has_options[]" value="0"/>
						<td class="username-coloured"><input type="text" name="name[]" value="" required="required" class="form-control" style="width:200px;"/></td>
						<td class="username-coloured"><input type="text" name="size[]" size="2" value="standard" class="form-control" style="width:80px;"/></td>
						<td class="username-coloured"><textarea style="margin: 0px; width: 160px; height: 50px;" name="desription[]" rows="5" cols="50" class="form-control"></textarea></td>
						<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="price[]" value="0" required="required" class="form-control"/></td>
						<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="vat_tax[]" value="0" class="form-control"/></td>
						<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="service_tax[]" value="0" class="form-control"/></td>
						<td class="username-coloured"><input type="text" name="start_time[]" size="1" value="00:00:00" required="required" class="form-control" style="width:90px;"/></td>
						<td class="username-coloured"><input type="text" name="end_time[]" size="1" value="23:59:00" required="required" class="form-control" style="width:90px;"/></td>
						<td class="username-coloured"><input type="text" style="margin: 0px; width: 80px;" name="color[]" value="" class="form-control"/></td>
						<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="packaging[]" value="0" class="form-control"/></td>
						<td class="username-coloured"><input type="text" class="date_picker form-control" name="start_date[]" size="3" value="<?php echo date('Y-m-d');?>" required="required" style="width:120px;"/></td>
						<td class="username-coloured"><input type="text" class="date_picker form-control" name="end_date[]" size="3" value="" style="width:120px;"/></td>
						<td class="username-coloured"><input type="file" style="margin: 0px; width: 120px;" name="image[]" value="" style="width:120px;"/></td>
						<input type="hidden" name="is_duplicate[]" value="1"/>
						<td>&nbsp;</td>
					</tr>
				</table>
				<div class="row col-lg-12">
					<button type="button" class="additem btn btn-sm btn-success" style="float:right;" title="Add Item"><i class="fa fa-plus"></i>Add More Items</button>
				</div>
			</div>
		</div>
	</div>
	<button class="btn btn-success" type="submit" id="popupadditems" title="Add Menu Items" style="margin-left:15px;"><i class="fa fa-plus"></i> Save Items</button>
	</form>
	<div class="row col-lg-12 btn-group">
	<br/>
	<br/>
	</div>
</div>
<script type="text/javascript" language="javascript">
$("#popupnewitems").on("click","#popupadditems",function(e) {
	var $myForm = $(this).closest('form');
	if ($myForm[0].checkValidity()) {
		e.preventDefault();
		$.ajax({
	    	type: "POST",
	    	url: "<?php echo base_url();?>admin/menu/items/add_menu",
	    	data: $("#popupnewitems input").serialize()+"&restid=<?php echo $restid;?>&output=json",	
	    	dataType: "json",
	    	success: function(request){
	    	   window.location.href = "<?php echo base_url();?>admin/menu/edit/<?php echo $restid;?>"; 
		    },
	    	error: function(request, errorType, errorThrown){
		    }
		});
	}
});

$("#popupnewitems").on("click",".additem",function(e) {
	e.preventDefault();
	
	var category = this.title.split("_");
	var html = '<tr><input type="hidden" name="has_options[]" value="0"/>'+
		'<td class="username-coloured"><input type="text" name="name[]" value="" required="required" class="form-control" style="width:200px;"/></td>'+
		'<td class="username-coloured"><input type="text" name="size[]" size="2" value="standard" class="form-control" style="width:80px;"/></td>'+
		'<td class="username-coloured"><textarea style="margin: 0px; width: 160px; height: 50px;" name="desription[]" rows="5" cols="50" class="form-control"></textarea></td>'+
		'<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="price[]" value="0" required="required" class="form-control"/></td>'+
		'<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="vat_tax[]" value="0" class="form-control"/></td>'+
		'<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="service_tax[]" value="0" class="form-control"/></td>'+
		'<td class="username-coloured"><input type="text" name="start_time[]" size="1" value="00:00:00" required="required" class="form-control" style="width:90px;"/></td>'+
		'<td class="username-coloured"><input type="text" name="end_time[]" size="1" value="23:59:00" required="required" class="form-control" style="width:90px;"/></td>'+
		'<td class="username-coloured"><input type="text" style="margin: 0px; width: 80px;" name="color[]" value="" class="form-control"/></td>'+
		'<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="packaging[]" value="0" class="form-control"/></td>'+
		'<td class="username-coloured"><input type="text" class="date_picker form-control" name="start_date[]" size="3" value="<?php echo date('Y-m-d');?>" required="required" style="width:120px;"/></td>'+
		'<td class="username-coloured"><input type="text" class="date_picker form-control" name="end_date[]" size="3" value="" style="width:120px;"/></td>'+
		'<td class="username-coloured"><input type="file" style="margin: 0px; width: 120px;" name="image[]" value="" style="width:120px;"/></td>'+
		'<input type="hidden" name="is_duplicate[]" value="1"/>'+
		'<td><button class="btn btn-danger popitemremove" type="button">X</button></td></tr>';
	$("#popupitemtable").append(html);    
	$( ".date_picker" ).datepicker({ dateFormat: "yy-mm-dd" }); 
});

$("#popupnewitems").on("click",".popitemremove",function(e) {
	$(this).closest("tr").remove();
});


</script>