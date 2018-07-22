<style>
<!--
.margin-bottom-5{
	margin-bottom: 5px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<!--<div>
			<form action="<?php echo base_url().'general/editcity'?>" method="post">
				<br>
				<div class="row">
	            	<div class="col-lg-12 margin-bottom-5">
	                	<div class="form-group" id="error-cityid">
                        	<label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
                            <div class="col-sm-5">
                            	<select name="cityid" id="cityid" class="form-control">
									<option value="">Select City</option>
									<?php foreach ($cities as $city) {?>
									<option value="<?php echo $city['id']; ?>" <?php if($cityid == $city['id']) {?>selected<?php }?>><?php echo $city['name']; ?></option>
									<?php }?>
								</select>
							</div>
							<div class="messageContainer col-sm-4"></div>
                    	</div>
	             	</div>
	         	</div>
	            <div class="row">
	            	<div class="col-lg-12 margin-bottom-5">
	                	<div class="form-group" id="error-areaid">
                        	<label class="control-label col-sm-3">Select Area <span class='text-danger'>*</span></label>
                            <div class="col-sm-5">
                           		<select name="areaid" id="areaid" class="form-control">
									<option value="">Select Area</option>
									<?php foreach ($areas as $area) {?>
									<option value="<?php echo $area['id']; ?>" <?php if($areaid == $area['id']) {?>selected<?php }?>><?php echo $area['name']; ?></option>
									<?php }?>
								</select>
							</div>
							<div class="messageContainer col-sm-4"></div>
                     	</div>
	             	</div>
	          	</div>
	          	<div class="row">
	            	<div class="col-lg-12 margin-bottom-5">
	                	<div class="form-group" id="error-areaid">
                        	<label class="control-label col-sm-3">Status<span class='text-danger'>*</span></label>
                            <div class="col-sm-5">
                           		<select name="status" id="status" class="form-control">
									<option value="" selected >Select Status</option>
									<option value="1"  >Active</option>
									<option value="0">Deactive</option>	
								</select>
							</div>
							<div class="messageContainer col-sm-4"></div>
                     	</div>
	             	</div>
	          	</div><br>
			</form>
		</div>-->
		<div class="col-lg-12">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Vendor Product List
					<div class="text-right"><a href="<?php echo base_url();?>admin/product">Add product</a></div>
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Area</th>
									<th>Delivery Type</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="menulist">
							<?php if (isset($restaurants)) { ?>
							<?php foreach ($restaurants as $item):?>
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php echo $item['area_name'];?>
									</td>
									<td>
										<?php if($item['delivery_type']==1) {echo 'Restaurant';}else echo 'olotime';?>
									</td>
									<td>
										<?php if($item['status'] == 1) {?>Active<?php }else{?>Inactive<?php }?>
									</td>
									<td>
										<?php if ($item['menu_uploaded'] == 0) {?>
										<a href = "" class="btn btn-success icon-btn btn-xs" data-toggle="modal" data-target="#myModal" onclick="loadPopup(<?php echo $item['id'];?>,`<?php echo $item['name'];?>`);"><i class="fa fa-upload"></i> Upload</a>
										<?php } else { ?>
										<a href = "<?php echo base_url();?>admin/menu/edit/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs" target="_blank"><i class="fa fa-pencil"></i> Edit</a>
										<a href = "" class="btn btn-success icon-btn btn-xs" data-toggle="modal" data-target="#myModal" onclick="updatePopup(<?php echo $item['id'];?>,`<?php echo $item['name'];?>`);"><i class="fa fa-upload"></i> Upload</a>
										<?php if($item['has_menu'] == 1) { ?>
										<a href = "<?php echo base_url();?>admin/menu/download/<?php echo $item['id']?>" class="btn btn-warning icon-btn btn-xs" target="_blank"><i class="fa fa-download"></i> Download</a>
										<?php }?>
										<?php } ?>
										<?php if ($item['menu_uploaded'] == 1) { ?>
										<a href = "javascript:comment(<?php echo $item['id']?>);" class="btn btn-info icon-btn btn-xs"><i class="fa fa-clone"></i> Publish</a>
										<?php } ?>
									</td>
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr><td colspan="5">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title" id="myTitle">Upload Menu</h4>
      		</div>
      		<div class="modal-body" id="upload-popup">
        		
      		</div>
      		<!-- div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div-->
    	</div>
  	</div>
</div>
<!--  Comment for Log -->

<div class="modal fade" id="modelComment" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background:#transparent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Comment</h4>
        </div>
        <div class="modal-body" style="padding:10px" >
        <input type="hidden" id="restidc" value=""/>
          <textarea rows='5' style="width:100%" autofocus id="comment" name='comment'></textarea>
        </div>
        <div class="modal-footer" style="background-color: none">
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='commentAdd()'>Publish</button>
          <button type="button " class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>

$("#cityid").change(function(){
	$.get(base_url+"admin/general/localities",{cityid: $("#cityid").val()},function(data){
		var html = "<option value=''>Select Area</option>";
		$.each( data, function( key, value ) {
		    html = html + "<option value='"+value.id+"'>"+value.name+"</option>";
		});	
		$("#areaid").html(html);
	},'json');
});

$("#areaid").change(function(){
	search();
});

$("#status").change(function(){
	search();
});

function search() {
	$.get(base_url+"admin/menu/search",{areaid: $("#areaid").val(),status:$("#status").val()},function(data){
		var html = "";
		var delivery_type='';
		$.each( data, function( key, value ) {
			if (value.menu_uploaded == 0) {
				var action = '<a href = "" class="btn btn-success icon-btn btn-xs" data-toggle="modal" data-target="#myModal" onclick="loadPopup('+value.id+',`'+value.name+'`);"><i class="fa fa-upload"></i> Upload</a>';
			} else {
				var action = '<a href = "'+base_url+'admin/menu/edit/'+value.id+'" class="btn btn-success icon-btn btn-xs" target="_blank"><i class="fa fa-pencil"></i> Edit</a> '+
							 '<a href = "" class="btn btn-success icon-btn btn-xs" data-toggle="modal" data-target="#myModal" onclick="updatePopup('+value.id+',`'+value.name+'`);"><i class="fa fa-upload"></i> Upload</a> ';
				if(value.has_menu == 1) {
					action = action + '<a href = "'+base_url+'admin/menu/download/'+value.id+'" class="btn btn-warning icon-btn btn-xs" target="_blank"><i class="fa fa-download"></i> Download</a>';
				}
			}
			if(value.menu_uploaded == 1) {
				action = action + '&nbsp;<a href = "javascript:publishMenu('+value.id+');" class="btn btn-info icon-btn btn-xs"><i class="fa fa-clone"></i> Publish</a>';
			}
			if(value.delivery_type == 1) {
				delivery_type = 'Restaurant';
			}
			if(value.delivery_type == 2) {
				delivery_type = 'olotime';
			}
			var status = "";
			if (value.status == 1) {
				status = 'Active';
			} else {
				status = 'Inactive';
			}
		    html = html + '<tr>'+
						   '<td>'+value.id+'</td>'+
						   '<td>'+value.name+'</td>'+
						   '<td>'+value.area_name+'</td>'+
						   '<td>'+delivery_type+'</td>'+
						   '<td>'+status+'</td>'+
						   '<td>'+action+'</td>'+
						   '</tr>';
		});	
		$("#menulist").html(html);
	},'json');
}

function loadPopup(id,name) {
	$.get(base_url+"admin/menu/upload/"+id,{},function(data){
		$("#upload-popup").html(data);
		$("h4#myTitle").html(name);
		$('#menuUpload').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().next('.messageContainer');
		   	},
		    feedbackIcons: {
		        validating: 'glyphicon glyphicon-refresh'
		    },
		    excluded: ':disabled',
		    fields: {
		    	menu: {
		            validators: {
		                notEmpty: {
		                    message: 'The Upload File is required and cannot be empty'
		                },
		                file: {
		                    extension: 'xls',
		                    type: 'application/vnd.ms-excel',
		                    maxSize: 2097152,   // 2048 * 1024
		                    message: 'Please select .xls file only'
		                }
		            }
		        }
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			uploadMenu();
		});
	},'html');
}

function updatePopup(id,name) {
	$.get(base_url+"admin/menu/update/"+id,{},function(data){
		$("#upload-popup").html(data);
		$("h4#myTitle").html(name);
		$('#menuUpdate').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().next('.messageContainer');
		   	},
		    feedbackIcons: {
		        validating: 'glyphicon glyphicon-refresh'
		    },
		    excluded: ':disabled',
		    fields: {
		    	menu: {
		            validators: {
		                notEmpty: {
		                    message: 'The Upload File is required and cannot be empty'
		                },
		                file: {
		                    extension: 'xls',
		                    type: 'application/vnd.ms-excel',
		                    maxSize: 2097152,   // 2048 * 1024
		                    message: 'Please select .xls file only'
		                }
		            }
		        }
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			updateMenu();
		});
	},'html');
}

function uploadMenu() {
	var options = {
    	target:        '#messageContainer',
        beforeSubmit:  showRequest,
        success:       showResponse,
        url : base_url+'admin/menu/import',
 		semantic : true,
 		dataType : 'json'
    };
	$('#menuUpload').ajaxSubmit(options);
}

function updateMenu() {
	var options = {
    	target:        '#messageContainer',
        beforeSubmit:  showRequest,
        success:       showResponse,
        url : base_url+'admin/menu/importupdate',
 		semantic : true,
 		dataType : 'json'
    };
	$('#menuUpdate').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
}

function showResponse(responseText, statusText)  {
   if(responseText.status == 0)
   {
	   alert(responseText.message);
   }else {
	   alert(responseText.message);
	   window.location.href = base_url+"admin/menu/list?areaid="+$("#areaid").val()+"&cityid="+$("#cityid").val();
   }	
}


$(document).ready(function(){
    $('#dataTables-example').DataTable();
});
function commentAdd()
{
	if($('#comment').val()!='')
	{	
		$.get(base_url+"admin/menu/publish",{restid:$('#restidc').val(),comment:$('#comment').val()},function(data) {
			alert(data.msg);
			window.location.href = base_url+"admin/menu/list?areaid="+$("#areaid").val()+"&cityid="+$("#cityid").val();
		},'json');
	}
	else
	{
		alert(' Please Add comment then Action is completed ');
	    
	}
}
function comment(restid)
{
	$('#modelComment').modal({
        backdrop: 'static',
        keyboard: false
    });
   $('#restidc').val(restid);
   //$('#statusvalue').val(status);
 	//alert('User is Activated');
  	//location.reload(true);
}

</script>