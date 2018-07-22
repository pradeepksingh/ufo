<div id="page-wrapper">
  <div class="container-fluid">
	<div class="row">
		<div>
		</div>
		<div class="col-lg-12">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/product/new" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Product
			</a>
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	product List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblproduct">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Description</th>
									<th>Price</th>
     								<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($products)) { ?>
							<?php foreach ($products as $item):?>
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php echo substr($item['short_description'],0,100);?> ...
									</td>
									<td>
										<?php echo $item['unit_price'];?>
									</td>
									<td><a href = "<?php echo base_url();?>admin/product/edit/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-sm"><i class="fa fa-pencil"></i></a></td>
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr><td colspan="4">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/product/new" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> product
			</a>
			<?php if (!$products) { ?>
			<a href = "" class="btn btn-success icon-btn btn-xs" data-toggle="modal" data-target="#myModal" onclick="loadPopup(1,'abc');"><i class="fa fa-upload"></i> Upload</a>
				<?php }?>
		</div>
	</div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title" id="myTitle">Upload Product</h4>
      		</div>
      		<div class="modal-body" id="upload-popup">
        		
      		</div>
      		<!-- div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div-->
    	</div>
  	</div>
</div>

<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>

<script>
$(document).ready(function(){
    $('#tblproduct').DataTable();
});


function loadPopup(id,name) {
	$.get(base_url+"admin/product/upload/"+id,{},function(data){
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

function uploadMenu() {
	//alert("inside import");
	var options = {
    	target:        '#messageContainer',
        beforeSubmit:  showRequest,
        success:       showResponse,
        url : base_url+'admin/product/import',
 		semantic : true,
 		dataType : 'json'
    };
	$('#menuUpload').ajaxSubmit(options);
}

function showRequest(formData, jqForm, options) {
}

function showResponse(responseText, statusText)  {
   if(responseText.status == 0)
   {
	   alert(responseText.message);
   }else {
	   alert(responseText.message);
	  window.location.href = base_url+"admin/product/list";
   }	
}

</script>