<style>
.col-md-6
{
	padding-left: 73.5px;
}
</style>
<div id="page-wrapper">
	<div class="row">
	<div class="col-lg-12">
		
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Completed Orders
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper" style="overflow-x:auto;">
                       	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>OrderID</th>
									<th>Order Code</th>
									<th>User Name</th>
									<th>User Mobile</th>
									<!--<th>Address</th>
									<th>Category</th>
									<th>Subcategory</th>
									<th>Product Name</th>
									<th>Product SKU</th>-->
									<th>Total Amount</th>
									<!--<th>Manufacture</th>-->
									<th>Status</th>
									<th>Action</th>
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
									<!--<td>
										<?php echo $item['address'];?>
									</td>
									<td>
										<?php echo $item['cat_name'];?>
									</td>
									<td>
										<?php //echo $item['cat_name'];?>
									</td>
									<td>
										<?php echo $item['prod_name'];?>
									</td>
									<td>
										<?php echo $item['sku'];?>
									</td>-->
									<td>
										<?php echo $item['total_amount'];?>
									</td>
								<!--	<td>
										<?php echo $item['manufacturer_id'];?>
									</td>-->
									<td>
										<?php echo $item['order_status'];?>
									</td>
									<td>
										<a href = "<?php echo base_url();?>admin/order/view_details/<?php echo $item['orderid']?>" class="btn btn-success icon-btn btn-xs">Process</a>
								
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
</div>


<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
});

</script>