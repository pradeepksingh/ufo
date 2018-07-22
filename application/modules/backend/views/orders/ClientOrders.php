<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Restaurant Orders
              	</div>
               	<div class="panel-body">
               		<div class="btn-plus">
						<a href="<?php echo base_url();?>admin/order/client/neworder" class="btn btn-primary view-contacts bottom-margin">
							<i class="fa fa-plus"></i> Delivery Order
						</a>
					</div>
                	<div class="dataTable_wrapper" style="overflow:auto;">
                       	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>OrderID</th>
									<th>City</th>
									<th>Restaurant</th>
									<th>User Name</th>
									<th>User Mobile</th>
									<th>Payment Mode</th>
									<th>Status</th>
									<th>CSE</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($orders)) { ?>
							<?php foreach ($orders as $item):?>
								<tr>
									<td>
										<?php if($item['cse_name'] != "") { ?>
										<a href = "<?php echo base_url();?>admin/order/client_order_detail/<?php echo $item['id']?>">
											<?php echo $item['id'];?>
										</a>
										<?php } else { ?>
											<?php echo $item['id'];?>
										<?php } ?>
									</td>
									<td>
										<?php echo $item['cityname'];?>
									</td>
									<td>
										<?php echo $item['restname'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php echo $item['mobile'];?>
									</td>
									<td>
										<?php if($item['is_online_paid'] == 1) {?>Online Paid<?php }else { ?>COD<?php } ?>
									</td>
									<td>
										<?php if($item['status'] == 1) { ?><span style="padding:5px;background-color:#4cae4c;color:#fff;">Confirmed</span><?php } else if($item['status'] == 2) { ?><span style="padding:5px;background-color:#a94442;color:#fff;">Cancelled</span><?php } else { ?><span style="padding:5px;background-color:#8a6d3b;color:#fff;">Pending</span><?php } ?>
									</td>
									<td>
										<?php if($item['cse_name'] == "") { ?>
										NA
										<?php } else { ?>
										<?php echo $item['cse_name'];?>
										<?php } ?>
									</td>
									<td>
										<a href = "<?php echo base_url();?>admin/order/client_order_detail/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs">View</a>
									</td>
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