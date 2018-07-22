<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
	<div class="col-lg-12">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Cancelled Orders
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper" style="overflow:auto;">
                       	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>OrderID</th>
									<th>Order Code</th>
									<th>User Name</th>
									<th>User Mobile</th>
									<th>Address</th>
									<th>Category</th>
									<!--<th>Subcategory</th>-->
									<th>Product Name</th>
									<th>Product SKU</th>
									<th>Price</th>
									<th>Vendor</th>
									<th>Manufacture</th>
									<th>Status</th>
								<!--	<th>Action</th>-->
								</tr>
							</thead>
							<tbody>
							<?php if (isset($orders)) { ?>
							<?php foreach ($orders as $item):?>
							<tr>
									<td>
										<a href = "<?php echo base_url();?>admin/order/view_details/<?php echo $item['orderid']?>" >
										<?php echo $item['orderid'];?>
										</a>
									</td>
									<td>
										<?php echo $item['ordercode'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php echo $item['mobile'];?>
									</td>
									<td>
										<?php echo $item['address'];?>
									</td>
									<td>
										<?php echo $item['cat_name'];?>
									</td>
									<!--<td>
										<?php echo $item['cat_name'];?>
									</td>-->
									<td>
										<?php echo $item['prod_name'];?>
									</td>
									<td>
										<?php echo $item['sku'];?>
									</td>
									<td>
										<?php echo $item['price'];?>
									</td>
									<td>
										<?php echo $item['vendor_name'];?>
									</td>
									<td>
										<?php echo $item['manufacturer_id'];?>
									</td>
									<td>
										<?php echo $item['status'];?>
									</td>
									<!--<td>
										<?php echo $item['vendor_name'];?>
									</td>-->
									
								</tr>
								<?php endforeach;?>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
		</div>
		</div>
	</div>
</div>

<div id="profileModal" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form enctype="multipart/form-data" name="profile_frm" id="profile_frm" style="padding: 15px 19px 20px 10px;" method="post"  action="<?php echo base_url();?>crm/editform">
      		<div class="modal-header" style="padding: 0px;">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<center><h4>Form ITR</h4></center>
      		</div><br/><br/>
	      	<div class="form-group label-floating is-empty">
                    <!--<label for="email" class="control-label">Email Id</label>-->
                    <div>
						<input type="hidden" class="form-control" id="chkid" name="chkid" style="margin-left: -5px;width:70%">	
						<input type="hidden" class="form-control" id="chkemail" name="chkemail" style="margin-left: -5px;width:70%">	
					<div class="row profile-row">
						<div class="col-lg-4" style="margin-left: 115px;">
							Form Id
						</div>
						<div class="col-lg-8" style="width: 46.666667%;" id="id123">
							
						</div>
					</div><br/>
					<div class="row profile-row">
						<div class="col-lg-4" style="margin-left: 115px;">
							Name
						</div>
						<div class="col-lg-8" style="width: 46.666667%;" id="name123">
							
						</div>
					</div><br/>
							<div class="row profile-row">
						<div class="col-lg-4" style="margin-left: 115px;">
							Email
						</div>
						<div class="col-lg-8" style="width: 46.666667%;" id="email123">
						
						</div>
					</div><br/>
						<div class="row profile-row">
						<div class="col-lg-4" style="margin-left: 115px;">
							Contact
						</div>
						<div class="col-lg-8" style="width: 46.666667%;" id="mobile123">
							
						</div>
					</div><br/>
						<div class="row profile-row">
						<div class="col-lg-4" style="margin-left: 115px;">
							Status
						</div>
						<div class="col-lg-8" style="width: 46.666667%;" id="7">
							<select class="form-control" id="status" name="status" style="margin-left: -5px;width:70%">
							<option value="Pending">Pending</option>
							<option value="Working">Working</option>
							<option value="Rejected">Rejected</option>
							<option value="Completed">Completed</option>
							</select>
						</div>
					</div><br/>										
					
					<div class="row profile-row">						
					<div class="col-lg-4" style="margin-left: 115px;">Comment</div>			
					<div class="col-lg-8" style="width: 46.666667%;" id="7">		
                    <textarea id="comment" name="comment" class="form-control" style="margin-left: -5px;width:70%"></textarea>					
					</div>					
					</div><br/>
					
                    </div>
                    
                  </div><br/>
	      	<div class="modal-footer" style="padding: 0px;"><br/>
			
	      		<center><button type="submit" class="btn btn-primary" style="padding: 5px;width: 77px;font-size: 12px;">Update</button></center>
	        	
	      	</div>
	      	</form>
    	</div>
  	</div>
</div>
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
});
function hideNav() {
	var status = $("#side-menu").css("display");
	if(status == 'block') {
		$("#side-menu").hide();
		$("#page-wrapper").css("margin","0 0 0 0");
		$("#show-hide-nav").html('<i class="fa fa-chevron-circle-right fa-2x"></i>');
	} else {
		$("#page-wrapper").css("margin","0 0 0 250px");
		$("#side-menu").show();
		$("#show-hide-nav").html('<i class="fa fa-chevron-circle-left fa-2x"></i>');
	}
}
</script>