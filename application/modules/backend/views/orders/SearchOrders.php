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
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Search Orders
              	</div>
              	<div>
              		<div class="panel panel-default">
	                   	<div class="panel-body">
                            <div class="row">
	                            <div class="col-sm-4">
	                            	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date"/>
	                            </div>
	                            <div class="col-sm-4">
	                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date"/>
	                            </div>
	                            <div class="col-sm-4">
	                            	<input type="text" id="orderid" name="orderid" class="form-control" placeholder="Order ID/CODE"/>
	                            </div>
                          	</div>
                          	<div class="row" style="padding-top:5px;">
                          		<div class="col-sm-4">
	                            	<input type="text" id="mobile" name="mobile" class="form-control" placeholder="Customer Mobile"/>
	                            </div>
                          		<div class="col-sm-4">
                          			<input type="button" name="search" id="search" class="btn btn-primary" value="Search"/>
                          		</div>
                          	</div>
	                   	</div>
	               	</div>
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
									<th>Status</th>
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
										<?php if($item['status'] == 1) { ?>Confirmed<?php } else if($item['status'] == 2) { ?>Cancelled<?php } else { ?>Pending<?php } ?>
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
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$(document).ready(function(){
    $('#tblRestos').DataTable();
    $('#from_date').datepicker();
    $('#to_date').datepicker();
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

$("#search").click(function() {
	$.post(base_url+"admin/order/search",{from_date: $("#from_date").val(), to_date: $("#to_date").val(), orderid: $("#orderid").val(), mobile: $("#mobile").val()},function(data){
		var oTable = $("#tblRestos").dataTable();
	    oTable.fnClearTable();
	    $(data).each(function(index){
		    var vieworder = '<a href="'+base_url+'admin/order/view_details/'+data[index].orderid+'" >'+data[index].orderid+'</a>';
	    	var row = [];
	    	row.push(vieworder);
	    	row.push(data[index].ordercode);
	    	row.push(data[index].name);
		    row.push(data[index].mobile);
	    	row.push(data[index].address);
	    	row.push(data[index].cityname);
	    	row.push(data[index].restname);
	    	if(data[index].order_placing_mode == 0) {
	    		row.push('Phone');
	    	} else {
	    		row.push('App');
	    	}
	    	if(data[index].is_takeaway == 1) {
	    		row.push('Takeaway');
	    	} else {
	    		row.push('Delivery');
	    	}
	    	if(data[index].status == 1) {
	    		row.push('Confirmed');
	    	} else if(data[index].status == 2) {
	    		row.push('Cancelled');
	    	} else {
	    		row.push('Pending');
	    	}
	    	if(data[index].cse_name == "") {
	    		row.push('NA');
	    	} else {
	    		row.push(data[index].cse_name);
	    	}
	    	oTable.fnAddData(row);
	    });
	},'json');
});
</script>