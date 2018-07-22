<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
		<br>
		<div class="col-lg-12">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<b>Restaurant Details</b>
              	</div>
               	<div class="panel-body">
               		<div class="col-sm-4">
               			<b>Restaurant</b>
               		</div>
               		<div class="col-sm-8">
               			<?php echo $order['restname'];?> - <?php echo $order['areaname'];?>
               		</div>
               		<div class="col-sm-4">
               			<b>Customer Name</b>
               		</div>
               		<div class="col-sm-8">
               			<?php echo $order['name'];?>
               		</div>
               		<div class="col-sm-4">
               			<b>Customer Mobile</b>
               		</div>
               		<div class="col-sm-8">
               			<?php echo $order['mobile'];?>
               		</div>
               		<div class="col-sm-4">
               			<b>Customer Email</b>
               		</div>
               		<div class="col-sm-8">
               			<?php echo $order['email'];?>&nbsp;
               		</div>
               		<div class="col-sm-4">
               			<b>Customer Address</b>
               		</div>
               		<div class="col-sm-8">
               			<?php echo $order['delivery_address'];?>&nbsp;
               		</div>
               		<div class="col-sm-4">
               			<b>Customer Location</b>
               		</div>
               		<div class="col-sm-8">
               			<?php echo $order['locality'];?>&nbsp;
               		</div>
               		<div class="col-sm-4">
               			<b>Order Items</b>
               		</div>
               		<div class="col-sm-8">
               			<?php echo $order['order_items'];?>&nbsp;
               		</div>
               		<div class="col-sm-4">
               			<b>Order Amount</b>
               		</div>
               		<div class="col-sm-8">
               			<i class="fa fa-rupee"></i> <?php echo $order['order_amount'];?>&nbsp;
               		</div>
               		<div class="col-sm-4">
               			<b>Payment Mode</b>
               		</div>
               		<div class="col-sm-8">
               			<?php if($order['is_online_paid'] == 1) { ?>Online Paid<?php }else { ?>COD<?php } ?>
               		</div>
				</div>
			</div>
		</div>
     	<div class="col-lg-12">
     		<div class="panel panel-default">
               	<div class="panel-body" style="padding:10px;">
               	<?php if($order['status'] == 0) { ?>
               		<a href="javascript:acceptOrder(<?php echo $order['id'];?>);" role="button" class="btn btn-success" >Accept Order</a>
               		<a href="#rejectModel" role="button" data-toggle="modal" class="btn btn-danger" >Reject Order</a>
               	<?php } else if($order['status'] == 1){ ?>
               	<span class="alert alert-success">Order Accepted </span> &nbsp; 
               	<a href="#rejectModel" role="button" data-toggle="modal" class="btn btn-danger" >Reject Order</a>
               	<?php } else if($order['status'] == 2){ ?>
               	<span class="alert alert-danger">Order Rejected </span> &nbsp; 
               	<a href="javascript:acceptOrder(<?php echo $order['id'];?>);" role="button" class="btn btn-success" >Accept Order</a>
               	<?php } ?>
               	</div>
          	</div>
     	</div>
	</div>
</div>
<div id="rejectModel" class="modal fade" style="">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
    	<input type="hidden" name="corderid" id="corderid" value="<?php echo $order['id'];?>"/>
      	<div class="modal-content">
          	<div class="modal-header" style="background-color:#3b598a">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel" style="color:#fff">Reject Order</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style="padding:20px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Reason</label>
                       		<select name="reason_id" id="reason_id" class="form-control">
								<option value=""> Select Reason </option>
								<?php foreach ($reasons as $reason) { ?>
								<option value="<?php echo $reason['id'];?>"><?php echo $reason['name'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-danger" onclick="rejectOrder(<?php echo $order['id'];?>)">Reject Order</button>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>
<script>
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

function acceptOrder(orderid) {
	ajaxindicatorstart("Please hang on.. while we accept order.");
	$.get(base_url+"admin/order/client/orderaccept/"+orderid,{ }, function(data){
		ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function rejectOrder(orderid) {
	var ans = confirm("Are you sure !! you want to reject this order ?");
	if(ans) { 
		ajaxindicatorstart("Please hang on .. while we cancel this order ..");
		$.get(base_url+"admin/order/client/orderreject/"+orderid,{ reason_id: $("#reason_id").val() }, function(data){
			ajaxindicatorstop();
			alert(data.msg);
			window.location.reload();
		},'json');
	}
}

</script>