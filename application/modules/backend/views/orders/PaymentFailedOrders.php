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
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Payment Failed Orders
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
									<th>City</th>
									<th>Restaurant</th>
									<th>Placing Mode</th>
									<th>Type/Discount</th>
									<th>CSE</th>
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
										<?php echo $item['cityname'];?>
									</td>
									<td>
										<?php echo $item['restname'];?>
									</td>
									<td>
										<?php if($item['order_placing_mode'] == 0) { ?>Phone<?php } else { ?>App<?php } ?>
									</td>
									<td>
										<?php if($item['is_takeaway'] == 1) { ?>Takeaway<?php } else { ?>Delivery<?php } ?>
									</td>
									<td>
										<?php if($item['cse_name'] == "") { ?>
										NA
										<?php } else { ?>
										<?php echo $item['cse_name'];?>
										<?php } ?>
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