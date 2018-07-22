<style>
.col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
    float:left;
}
</style>
<div id="page-wrapper" style="padding:5px 16px;">
	<div class="row">
		<div class="col-lg-7" style="padding:0px 5px;">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<b>Order Details</b>
              	</div>
                    	<div class="panel-body">
               		<div class="row">
	               		<div class="col-sm-5">
	               			<b>ORDER ID</b>
	               		</div>
	               		<div class="col-sm-7">
	               			<?php echo $order['orderid'];?>
	               		</div>
               		</div>
               		<div class="row">
	               		<div class="col-sm-5">
	               			<b>ORDER CODE</b>
	               		</div>
	               		<div class="col-sm-7">
	               			<?php echo $order['ordercode'];?>
	               		</div>
	               	</div>
	               	
	               	<div class="row">
	               		<div class="col-sm-5">
	               			<b>Customer Name</b>
	               		</div>
	               		<div class="col-sm-7">
						<?php echo $order['name'];?> 
						</div>
	               	</div>
	               
	               	<div class="row">
	               		<div class="col-sm-5">
	               			<b>Customer Mobile</b>
	               		</div>
	               		<div class="col-sm-7">
						<?php echo $order['mobile'];?>
						</div>
	               	</div>
	               	<div class="row">
	               		<div class="col-sm-5">
	               			<b>Address</b>
	               		</div>
	               		<div class="col-sm-7">
						<?php echo $order['address'];?>
						</div>
	               	</div>
				</div>
			</div>

			<div class="panel panel-default">
            	<div class="panel-heading">
                	<b>Order Items</b>
              	</div>
               	<div class="panel-body" style="padding:1px;">
               		<div class="col-sm-12" style="padding:0px 0px;">
	               		<div class="col-sm-4" style="background-color:#f5f5f5;padding:5px;padding-left:15px;"><b>Item Name</b></div>
	               		<div class="col-sm-2" style="background-color:#f5f5f5;padding:5px;"><b>Qty</b></div>
	               		<div class="col-sm-3" style="background-color:#f5f5f5;padding:5px;"><b>Unit Price</b></div>
	               		<div class="col-sm-3" style="background-color:#f5f5f5;padding:5px;"><b>Total Price</b></div>
               		</div>
               		<?php foreach($products as $item) { ?>
	               		<div class="col-sm-12" style="padding:5px 0px;font-weight:400;background-color:#f9f9f9;">
	               			<div class="col-sm-4"><span style="font-weight:500;"><?php echo $item['name'];?></span></div>
		               		<div class="col-sm-2"><?php echo $item['quantity'];?></div>
		               		<div class="col-sm-3"><i class="fa fa-rupee"></i> <?php echo $item['price'];?></div>
		               		<div class="col-sm-3"><i class="fa fa-rupee"></i> <?php echo $item['total_amount'];?></div>
		               		<div class="clearfix" style="padding-left:15px;"></div>
	               		</div>
               		<?php } ?>
               		<div class="col-sm-12" style="padding:5px 0px;">
               			<div class="col-sm-6">
               			</div>
               			<div class="col-sm-6" style="background-color: #fafafa;border-radius: 5px;padding-bottom:10px;">
               				<br>
               				<table cellpadding="0px" cellspacing="0px" style="width:100%;">
								<tr>
									<td width="70%"><b>Order Total</b></td>
									<td width="30%"><i class="fa fa-rupee"></i> <?php echo $order['sub_total'];?></td>
								</tr>
								<tr>
									<td width="70%"><b>Discount</b></td>
									<td width="30%"><i class="fa fa-rupee"></i> <?php echo $order['discount'];?></td>
								</tr>
								<tr>
									<td width="70%"><b>Karma Discount</b></td>
									<td width="30%"><i class="fa fa-rupee"></i> <?php echo $order['karma_discount'];?></td>
								</tr>
								<tr>
									<td width="70%"><b>Net Total</b></td>
									<td width="30%"><i class="fa fa-rupee"></i> <?php echo $order['grand_total'];?></td>
								</tr>
							</table>
               			</div>
               		</div>
               	</div>
          	</div>
          	<?php //} ?>
		</div>
		
		
		<div class="col-lg-5" style="padding:0px 5px 0px 0px;">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<b>Order Actions - </b>
                	<span class="text-success"><b>
                	<?php if($order['order_status'] == 0) { ?>
                	New Order
                	<?php } else if($order['order_status'] == 1) { ?>
                	Order Confirmed
                	<?php } else if($order['order_status'] == 2) { ?>
                	Assigned For Delivery
                	<?php } else if($order['order_status'] == 3) { ?>
                	Delivered
                	<?php } else if($order['order_status'] == 4) { ?>
                	Cancelled
                	<?php }?>
                	</b>
                	</span>
              	</div>
               	<div class="panel-body" style="padding:10px;">
               		<div>
               			<?php if($order['status'] == 0) { ?>
		               		<a href="#pickupModel" role="button" class="btn btn-primary" data-toggle="modal">Confirm Order</a>
		               		&nbsp;
		               		<a href="#cancelModel" role="button" class="btn btn-danger" data-toggle="modal">Cancel Order</a><?php } ?>
               		</div>
               		<div class="row" style="padding:10px 0px;margin-top:5px;background-color:#f2f2f2;">
               			<div class="col-sm-6">
	               			<select name="status_id" id="status_id" class="form-control">
	               				<option value="">Select Status</option>
								<option value="1">Confirm Order</option>
								<option value="2">Assign For Delivery</option>
								<option value="3">Mark Delivered</option>
								<option value="4">Cancelled</option>
								</select>
						</div>
						<div class="col-sm-6">
							<input type="button" class="btn btn-primary" onclick="changeStatus(<?php echo $order['orderid'];?>);" value="Change Status"/>
						</div>
               		</div>
               		<br>
	               <div class="table-responsive">
	               	<table class="table table-striped">
	               		<thead>
	               			<tr class="info">
		               			<th>Action</th>
		               			<th>Date Time</th>
		               			<th>CSE Name</th>
	               			</tr>
	               		</thead>
	               		<tbody>
	               			<?php foreach ($logs as $log) {?>
	               			<tr>
	               				<td><?php echo $log['comment'];?></td>
	               				<td><?php echo date('j M Y h:i A',strtotime($log['created_date']));?></td>
	               				<td><?php echo $log['csename'];?></td>
	               			</tr>
	               			<?php } ?>
	               		</tbody>
	               	</table>
	               	</div>
               	</div>
          	</div>
     	</div>
     	<div class="col-lg-12" style="padding:0px;">
     		<div class="col-lg-7">
	     	</div>
     	</div>
	</div>
</div>
<!--
<div id="pickupModel" class="modal fade" style="">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Assign Pickup Order</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style=padding:20px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Pickup Executive</label>
                       		<select name="executive_id" id="executive_id" class="form-control">
								<option value=""> Select Executive </option>
								<?php foreach ($executives as $executive) { ?>
								<option value="<?php echo $executive['id'];?>"><?php echo $executive['name'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style=padding:20px;display:none;" >
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Pickup Slot</label>
                       		<select name="pickup_slot" id="pickup_slot" class="form-control">
								<option value=""> Select Pickup Slot </option>
								<?php foreach ($pickupslots as $row) { ?>
								<option value="<?php echo $row['slot'];?>" <?php if($order['pickup_slot'] == $row['slot']) {?>selected<?php }?>><?php echo $row['slot'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-primary" onclick="assignPickup(<?php echo $order['orderid'];?>)">Assign Pickup</button>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>-->
</div>
<!--
<div id="repickupModel" class="modal fade" style="">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Re-Assign Pickup</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style=padding:20px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Pickup Executive</label>
                       		<select name="rpexecutive_id" id="rpexecutive_id" class="form-control">
								<option value=""> Select Executive </option>
								<?php foreach ($executives as $executive) { ?>
								<option value="<?php echo $executive['id'];?>" <?php if($executive['id'] == $order['pickup_exe_id']) { ?>selected<?php } ?>><?php echo $executive['name'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style=padding:20px;display:none;">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Pickup Slot</label>
                       		<select name="rpickup_slot" id="rpickup_slot" class="form-control">
								<option value=""> Select Pickup Slot </option>
								<?php foreach ($pickupslots as $row) { ?>
								<option value="<?php echo $row['slot'];?>" <?php if($order['pickup_slot'] == $row['slot']) {?>selected<?php }?>><?php echo $row['slot'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-primary" onclick="reassignPickup(<?php echo $order['orderid'];?>)">Assign Pickup</button>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>-->
</div>
<!--
<div id="cancelModel" class="modal fade" style="">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Cancel Order</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style=padding:20px">
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
                  		<input type="hidden" name="cancelcomment" id="cancelcomment" value=""/>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-danger" onclick="cancelOrder(<?php echo $order['orderid'];?>)">Cancel Order</button>
             			<span class="pull-right">
             				<button type="button" class="btn btn-warning" onclick="deleteOrder(<?php echo $order['orderid'];?>)">Delete Order</button>
             			</span>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>-->
<!--
<div id="pickedupModel" class="modal fade" style="">
    <div id="pickedup-overlay" class="modal-dialog" style="opacity:1 ;width:600px ">
      	<div class="modal-content">
      		<form action="" method="post" name="additems" id="additems" >
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Mark Order Picked Up</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
          		<div class="row" style=padding:20px;display:none;">
              		<div class="col-xs-6">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Date</label>
                       		<input type="text" name="delivery_date" id="idelivery_date" class="form-control datepicker" value="<?php if(!empty($order['tml_delivery_date'])){ echo date('d-m-Y',strtotime($order['tml_delivery_date']));}?>"/>
                  		</div>
              		</div>
              	</div>
          		<h3 style="margin-top:0px;">Add PickedUp Items</h3>
          		<input type="hidden" name="orderid" id="orderid" value="<?php echo $order['orderid'];?>"/>
          		<input type="hidden" name="coupon_code" id="coupon_code" value="<?php echo $order['coupon_code'];?>"/>
          		<input type="hidden" name="m_pickup_date" id="m_pickup_date" value="<?php echo $order['pickup_date'];?>"/>
          		<div id="orderitems">
          			<div class="row" style="padding:10px 5px;background-color:#ddd;border:1px solid #ccc;">
                  		<div class="form-group">
                       		<div class="col-sm-6">
                       			Item Name
                       		</div>
                       		<div class="col-sm-1">
                       			Qty
                       		</div>
                       		<div class="col-sm-2">
                       			Weight
                       		</div>
                       		<div class="col-sm-2">
                       			Rate
                       		</div>
                       		<div class="col-sm-1">
                       			&nbsp;
                       		</div>
                  		</div>
              		</div>
              		<input type="hidden" name="rcount" id="rcount" value="1"/>
              		<div class="row" style="padding:10px 5px;background-color:#f2f2f2;border-bottom:1px solid #ccc;" id="rowitem-1">
                  		<div class="form-group">
                  			<input type="hidden" name="itemid[]" id="itemid-1" value=""/>
                       		<div class="col-sm-6">
                       			<input type="text" class="form-control itemname" name="itemname[]" id="itemname-1" value="" placeholder="Enter Item Name" autocomplete="off"/>
                       		</div>
                       		<div class="col-sm-1 input-group" style="float:left;padding: 0px 2px;">
                       			<input type="text" name="qty[]" id="qty-1" value="1" class="form-control"/>
                       		</div>
                       		<div class="col-sm-2 input-group" style="float:left;padding: 0px 2px;">
                       			<input type="text" name="weight[]" id="weight-1" value="1" class="form-control"/><span id="qty-wt-1" class="input-group-addon">Kg</span>
                       		</div>
                       		<div class="col-sm-2">
                       			<input type="hidden" name="price[]" id="price-1" value=""/>
                       			<span id="pricelbl-1" style="line-height: 30px;"></span>
                       		</div>
                       		<div class="col-sm-1">
                       			&nbsp;
                       		</div>
                  		</div>
              		</div>
              	</div>
              	<br>
              	<a href="javascript:addMoreItems();" class="btn btn-primary pull-right">Add More Items</a>
              	<br>
              	<div id="response"></div>
              	<br>
          	</div>
          	<div class="modal-footer">
             	<div class="col-xs-12">
             		<button type="button" class="btn btn-success" onclick="saveItems()">Save Items</button>
            	</div>
         	</div>
         	</form>
      	</div>
  	</div>-->
</div>
<!--
<div id="updateItemModel" class="modal fade" style="">
    <div id="update-overlay" class="modal-dialog" style="opacity:1 ;width:600px ">
      	<div class="modal-content">
      		<form action="" method="post" name="updateitems" id="updateitems" >
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Update Order Items</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
          		<input type="hidden" name="orderid" id="orderid" value="<?php //echo $order['orderid'];?>"/>
          		<input type="hidden" name="coupon_code" id="coupon_code" value="<?php //echo $order['coupon_code'];?>"/>
          		<input type="hidden" name="m_pickup_date" id="m_pickup_date" value="<?php //echo $order['pickup_date'];?>"/>
          		<div id="eorderitems">
          			<div class="row" style="padding:10px 5px;background-color:#ddd;border:1px solid #ccc;">
                  		<div class="form-group">
                       		<div class="col-sm-6">
                       			Item Name
                       		</div>
                       		<div class="col-sm-1">
                       			Qty
                       		</div>
                       		<div class="col-sm-2">
                       			Weight
                       		</div>
                       		<div class="col-sm-2">
                       			Rate
                       		</div>
                       		<div class="col-sm-1">
                       		&nbsp;
                       		</div>
                  		</div>
              		</div>
              		<input type="hidden" name="ercount" id="ercount" value="<?php //echo count($items);?>"/>
              		<?php //foreach($items as $key=>$item) { ?>
              		<div class="row" style="padding:10px 5px;background-color:#f2f2f2;border-bottom:1px solid #ccc;" id="erowitem-<?php //echo $key;?>">
                  		<div class="form-group">
                  			<input type="hidden" name="itemid[]" id="eitemid-<?php //echo $key;?>" value="<?php //echo $item['item_id'];?>"/>
                       		<div class="col-sm-6">
                       			<input type="text" class="form-control itemname" name="itemname[]" id="eitemname-<?php //echo $key;?>" value="<?php //echo $item['item_name'];?>" placeholder="Enter Item Name" autocomplete="off"/>
                       		</div>
                       		<div class="col-sm-1 input-group" style="float:left;padding: 0px 2px;">
                       			<input type="text" class="form-control" name="qty[]" id="eqty-<?php //echo $key;?>" value="<?php //echo $item['quantity'];?>"/>
                       		</div>
                       		<div class="col-sm-2 input-group" style="float:left;padding: 0px 2px;">
                       			<?php //if($item['cat_id'] == 2) { ?>
                       			<input type="text" class="form-control" name="weight[]" id="eweight-<?php //echo $key;?>" value="<?php //echo $item['weight'];?>"/><span class="input-group-addon" id="eqty-wt-<?php //echo $key;?>">Kg</span>
                       			<?php //} else { ?>
                       			<input type="text" class="form-control" name="weight[]" id="eweight-<?php //echo $key;?>" value="<?php //echo $item['weight'];?>" class="input-disabled" readonly/><span class="input-group-addon" id="eqty-wt-<?php //echo $key;?>">Kg</span>
                       			<?php //} ?>
                       		</div>
                       		<div class="col-sm-2">
                       			<input type="hidden" name="price[]" id="eprice-<?php //echo $key;?>" value="<?php //echo $item['item_price'];?>"/>
                       			<span id="epricelbl-<?php //echo $key;?>" style="line-height: 30px;">Rs. <?php //echo $item['item_price'];?></span>
                       		</div>
                       		<div class="col-sm-1"><a href="javascript:eremoveItem(<?php //echo $key;?>);" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a></div>
                  		</div>
              		</div>
              		<?php //} ?>
              	</div>
              	<br>
              	<a href="javascript:eaddMoreItems();" class="btn btn-primary pull-right">Add More Items</a>
              	<br>
              	<div id="uresponse"></div>
              	<br>
          	</div>
          	<div class="modal-footer">
             	<div class="col-xs-12">
             		<button type="button" class="btn btn-success" onclick="updateItems()">Update Items</button>
            	</div>
         	</div>
         	</form>
      	</div>
  	</div>
</div>-->
<!--
<div id="deliveryModel" class="modal fade" style="">
    <div id="cancel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Assign Order For Delivery</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style="padding:20px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Executive</label>
                       		<select name="dexecutive_id" id="dexecutive_id" class="form-control">
								<option value=""> Select Executive </option>
								<?php foreach ($executives as $executive) { ?>
								<option value="<?php echo $executive['id'];?>"><?php echo $executive['name'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style="padding:20px;display:none;">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Date</label>
                       		<input type="text" name="delivery_date" id="delivery_date" class="form-control datepicker" value="<?php if(!empty($order['tml_delivery_date'])) { echo date('d-m-Y',strtotime($order['tml_delivery_date']));}?>"/>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style="padding:20px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Slot</label>
                       		<select name="delivery_slot" id="delivery_slot" class="form-control">
								<option value=""> Select Delivery Slot </option>
								<?php foreach ($deliveryslots as $row) { ?>
								<option value="<?php echo $row['slot'];?>" <?php if($order['delivery_slot'] == $row['slot']) {?>selected<?php }?>><?php echo $row['slot'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-primary" onclick="assignDelivery(<?php echo $order['orderid'];?>)">Assign Delivery</button>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>
<div id="redeliveryModel" class="modal fade" style="">
    <div id="redel-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Re-Assign Delivery</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style="padding:20px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Executive</label>
                       		<select name="rdexecutive_id" id="rdexecutive_id" class="form-control">
								<option value=""> Select Executive </option>
								<?php foreach ($executives as $executive) { ?>
								<option value="<?php echo $executive['id'];?>" <?php if($executive['id'] == $order['delivery_exe_id']) { ?>selected<?php } ?>><?php echo $executive['name'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style="display:none;">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Date</label>
                       		<input type="text" name="rdelivery_date" id="rdelivery_date" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($order['tml_delivery_date']));?>"/>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style="padding:20px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Slot</label>
                       		<select name="rdelivery_slot" id="rdelivery_slot" class="form-control">
								<option value=""> Select Delivery Slot </option>
								<?php foreach ($deliveryslots as $row) { ?>
								<option value="<?php echo $row['slot'];?>" <?php if($order['delivery_slot'] == $row['slot']) {?>selected<?php }?>><?php echo $row['slot'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-primary" onclick="reassignDelivery(<?php echo $order['orderid'];?>)">Re-Assign Delivery</button>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>-->
<div id="invoiceModal" class="modal fade" style="">
    <div id="invoice-overlay" class="modal-dialog" style="opacity:1 ;width:600px ">

      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Generate Invoice</h4>
          	</div>
          	<div class="modal-body" style="background-color:#fff;">
              	<div class="row">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Order Total</label>
                       		<input type="text" name="o_amount" id="o_amount" class="form-control" value="<?php echo $order['order_amount'];?>" readonly/>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Discount (Rs)</label>
                       		<input type="text" name="discount" id="discount" class="form-control" value="<?php echo $order['zyk_discount'];?>"/>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Convenience Fee (Rs)</label>
                       		<input type="text" name="delivery_charge" id="delivery_charge" class="form-control" value="<?php echo $order['delivery_charge'];?>" readonly/>
                  		</div>
              		</div>
              	</div>
             	<!--<div class="row">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Adjustment (Rs)</label>
                       		<input type="text" name="adjustment" id="adjustment" class="form-control" value="15"/>
                  		</div>
              		</div>
              	</div>-->
              	<div class="row">
              		<div class="col-md-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Grand Total</label>
                       		<input type="text" name="grand_total" id="grand_total" class="form-control" value="<?php echo $order['grand_total'];?>" readonly/>
                  		</div>
              		</div>
              	</div>
          	</div>
          	<div class="panel-footer">
             	<button type="submit" class="btn btn-primary" onclick="generateInvoice(<?php echo $order['orderid'];?>)">Generate Invoice</button>
          	</div>
      	</div>
	
  	</div>
</div>
<!--
<div id="adjustModal" class="modal fade" style="">
    <div id="invoice-overlay" class="modal-dialog" style="opacity:1 ;width:600px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Update Adjustment</h4>
          	</div>
          	<div class="modal-body" style="background-color:#fff;">
              	<div class="row">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label col-sm-4">Add Or Deduct</label>
                       		<div class="col-sm-8">
	                       		<input type="radio" name="adj_type" id="adjadd" value="0" <?php if($order['adjustment'] >= 0) { ?>checked<?php }?>/> ADD
	                       		<input type="radio" name="adj_type" id="adjremove" value="1" <?php if($order['adjustment'] < 0) { ?>checked<?php }?>/> REMOVE
                       		</div>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label col-sm-4">Adjustment (Rs)</label>
                       		<div class=" col-sm-4">
                       			<input type="text" name="iadjustment" id="iadjustment" class="form-control" value="<?php if($order['adjustment'] < 0) { echo $order['adjustment']*-1; } else { echo $order['adjustment']; }?>"/>
                       		</div>
                  		</div>
              		</div>
              	</div>
          	</div>
          	<div class="panel-footer">
             	<button type="submit" class="btn btn-primary" onclick="updateAdjustment(<?php echo $order['orderid'];?>)">Update Adjustment</button>
          	</div>
      	</div>
  	</div>
</div>-->
<!--
<div id="confirmModal" class="modal fade" style="">
    <div id="invoice-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Confirm Delivery</h4>
          	</div>
          	<div class="modal-body" style="background-color:#fff;">
          		<input type="hidden" name="final_total" id="final_total" value="<?php echo $order['grand_total'];?>"/>
              	<div class="row">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Total Amount Received</label>
                       		<input type="text" name="to_amount" id="to_amount" class="form-control" value="<?php echo $order['grand_total'];?>"/>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Payment Mode</label>
                       		<select id="cpay_mode" name="cpay_mode" class="form-control">
                       			<option value="1" <?php if($order['payment_status'] == "Credit") { ?>selected<?php }?>>Online Paid</option>
                       			<option value="0" <?php if($order['payment_status'] != "Credit") { ?>selected<?php }?>>Cash On Delivery</option>
                       		</select>
                  		</div>
              		</div>
              	</div>
	          	<div class="panel-footer">
	             	<button type="submit" class="btn btn-primary" onclick="confirmDelivery(<?php echo $order['orderid'];?>)">Confirm</button>
	          	</div>
	      	</div>
	  	</div>
	</div>
</div>-->
<!--
<div id="reSchedulePickup" class="modal fade" style="">
    <div id="rsp-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Re-Schedule Pickup</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style="padding:0px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Pickup Date</label>
                       		<input type="text" name="rspickup_date" id="rspickup_date" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($order['pickup_date']));?>"/>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style="padding:0px;">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Pickup Slot</label>
                       		<select name="rspickup_slot" id="rspickup_slot" class="form-control">
								<option value=""> Select Pickup Slot </option>
								<?php foreach ($pickupslots as $row) { ?>
								<option value="<?php echo $row['slot'];?>" <?php if($order['pickup_slot'] == $row['slot']) {?>selected<?php }?>><?php echo $row['slot'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style="padding:0px;">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Reason For Reschedule</label>
                       		<textarea class="form-control" name="rsnotes" id="rsnotes"></textarea>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-primary" onclick="reschedulePickup(<?php echo $order['orderid'];?>)">Reschedule Pickup</button>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>-->
<!--
<div id="reScheduleDelivery" class="modal fade" style="">
    <div id="rsp-overlay" class="modal-dialog" style="opacity:1 ;width:400px ">
      	<div class="modal-content">
          	<div class="modal-header">
              	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="color:#fff">×</span><span class="sr-only">Close</span></button>
              	<h4 class="modal-title" id="myModalLabel">Re-Schedule Delivery</h4>
          	</div>
          	<div class="modal-body" style="background-color:#f5f5f5;">
              	<div class="row" style="padding:0px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Date</label>
                       		<input type="text" name="rsdelivery_date" id="rsdelivery_date" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($order['tml_delivery_date']));?>"/>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style="padding:0px;">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Select Delivery Slot</label>
                       		<select name="rsdelivery_slot" id="rsdelivery_slot" class="form-control">
								<option value=""> Select Delivery Slot </option>
								<?php foreach ($pickupslots as $row) { ?>
								<option value="<?php echo $row['slot'];?>" <?php if($order['delivery_slot'] == $row['slot']) {?>selected<?php }?>><?php echo $row['slot'];?></option>
								<?php } ?>
							</select>
                  		</div>
              		</div>
              	</div>
              	<div class="row" style="padding:0px;">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="password" class="control-label">Reason For Reschedule</label>
                       		<textarea class="form-control" name="rsdnotes" id="rsdnotes"></textarea>
                  		</div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
             			<button type="submit" class="btn btn-primary" onclick="rescheduleDelivery(<?php echo $order['orderid'];?>)">Reschedule Delivery</button>
             		</div>
              	</div>
          	</div>
      	</div>
  	</div>
</div>-->
<script src="<?php echo asset_url();?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '0d'
});
$('#rspickup_date').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '0d'
}).on("changeDate", function(e) {
    $.get(base_url+"crm/general/pickupdate",{ pickup_date: $(this).val() },function(data) {
		$("#rspickup_slot").html(data);
    },'html');
});
$('#rsdelivery_date').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '0d'
}).on("changeDate", function(e) {
    $.get(base_url+"crm/general/pickupdate",{ pickup_date: $(this).val() },function(data) {
		$("#rsdelivery_slot").html(data);
    },'html');
});

function updateSlotsDel() {
	$.get(base_url+"crm/general/pickupdate",{ pickup_date: $("#rsdelivery_date").val() },function(data) {
		$("#rsdelivery_slot").html(data);
    },'html');
}
function updateSlotsPick() {
	$.get(base_url+"crm/general/pickupdate",{ pickup_date: $("#rspickup_date").val() },function(data) {
		$("#rspickup_slot").html(data);
    },'html');
}
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

function assignPickup(orderid) {
	if($("#executive_id").val() != "" && $("#pickup_slot").val() != "") {
		//ajaxindicatorstart("Please hang on.. while we assign order ..");
		$.get(base_url+"crm/order/assignpickup/"+orderid,{ executive_id: $("#executive_id").val(), pickup_slot: $("#pickup_slot").val()}, function(data){
			//ajaxindicatorstop();
			alert(data.message);
			window.location.reload();
		},'json');
	} else if($("#executive_id").val() == "") {
		alert("Please select pickup executive");
	} else if($("#pickup_slot").val() == "") {
		alert("Please select pickup slot");
	} else {
		alert("Please select all fields");
	}
}

function reassignPickup(orderid) {
	if($("#rpexecutive_id").val() != "" && $("#rpickup_slot").val() != "") {
		//ajaxindicatorstart("Please hang on.. while we re-assign order ..");
		$.get(base_url+"crm/order/reassignpickup/"+orderid,{ executive_id: $("#rpexecutive_id").val(), pickup_slot: $("#rpickup_slot").val()}, function(data){
		//	ajaxindicatorstop();
			alert(data.message);
			window.location.reload();
		},'json');
	} else if($("#rpexecutive_id").val() == "") {
		alert("Please select pickup executive");
	} else if($("#rpickup_slot").val() == "") {
		alert("Please select pickup slot");
	} else {
		alert("Please select all fields");
	}
}

function assignDelivery(orderid) {
	if($("#dexecutive_id").val() != "" && $("#delivery_slot").val() != "" && $("#delivery_date").val()) {
		//ajaxindicatorstart("Please hang on.. while we assign order ..");
		$.get(base_url+"crm/order/assigndelivery/"+orderid,{ executive_id: $("#dexecutive_id").val(), delivery_slot: $("#delivery_slot").val(), delivery_date: $("#delivery_date").val()}, function(data){
		//	ajaxindicatorstop();
			alert(data.message);
			window.location.reload();
		},'json');
	} else if($("#dexecutive_id").val() == "") {
		alert("Please select delivery executive");
	} else if($("#delivery_slot").val() == "") {
		alert("Please select delivery slot");
	} else if($("#delivery_date").val() == "") {
		alert("Please select delivery date");
	} else {
		alert("Please select all fields");
	}
}

function reassignDelivery(orderid) {
	if($("#rdexecutive_id").val() != "" && $("#rdelivery_slot").val() != "" && $("#rdelivery_date").val()) {
		ajaxindicatorstart("Please hang on.. while we re-assign order ..");
		$.get(base_url+"crm/order/reassigndelivery/"+orderid,{ executive_id: $("#rdexecutive_id").val(), delivery_slot: $("#rdelivery_slot").val(), delivery_date: $("#rdelivery_date").val()}, function(data){
			ajaxindicatorstop();
			alert(data.message);
			window.location.reload();
		},'json');
	} else if($("#rdexecutive_id").val() == "") {
		alert("Please select delivery executive");
	} else if($("#rdelivery_slot").val() == "") {
		alert("Please select delivery slot");
	} else if($("#rdelivery_date").val() == "") {
		alert("Please select delivery date");
	} else {
		alert("Please select all fields");
	}
}

function cancelOrder(orderid) {
	if($("#reason_id").val() != "") {
		var ans = confirm("Are you sure !! you want to cancel this order ?");
		if(ans) { 
			//ajaxindicatorstart("Please hang on .. while we cancel this order ..");
			$.get(base_url+"crm/order/cancel/"+orderid,{ comment: $("#cancelcomment").val(), reason_id: $("#reason_id").val() }, function(data){
			//	ajaxindicatorstop();
				alert(data.message);
				window.location.reload();
			},'json');
		}
	} else {
		alert("Please select reason of cancellation.");
	}
}

function deleteOrder(orderid) {
	if($("#reason_id").val() != "") {
		var ans = confirm("Are you sure !! you want to delete this order ?");
		if(ans) { 
		//	ajaxindicatorstart("Please hang on .. while we delete this order ..");
			$.get(base_url+"crm/order/delete/"+orderid,{ comment: $("#cancelcomment").val(), reason_id: $("#reason_id").val() }, function(data){
			//	ajaxindicatorstop();
				alert(data.message);
				window.location.reload();
			},'json');
		}
	} else {
		alert("Please select reason of deletion.");
	}
}

function confirmDelivery(orderid) {
	//ajaxindicatorstart("Please hang on.. while we complete order ..");
	$.get(base_url+"crm/order/completed/"+orderid,{ net_total: $("#to_amount").val(), final_total: $("#final_total").val(), pay_mode : $("#cpay_mode").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function requestPayment(orderid) {
	//ajaxindicatorstart("Please hang on.. while we made payment request ...");
	$.get(base_url+"crm/order/payment_request/"+orderid,{  }, function(data){
	//	ajaxindicatorstop();
		alert(data.message);
		window.location.reload();
	},'json');
}

function generateInvoice(orderid) {
	//alert("inside invoice");
	//var a=$("#discount").val();
	//alert(a);
	//ajaxindicatorstart("Please hang on.. while we generate invoice ..");
	//$.post(base_url+"admin/order/invoice/generate/"+orderid,{ discount: $("#discount").val() }, function(data){
	$.get(base_url+"admin/order/invoice/generate/"+orderid,{ discount: $("#discount").val()}, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function saveItems() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'crm/order/additems',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#additems').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	//ajaxindicatorstart("Please hang on.. while we add items ..");
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	//ajaxindicatorstop();
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.message);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.message);
        $("#response").show();
        alert(resp.message);
        //window.location.reload();
	    
  	}
}

function updateItems() {
	var options = {
	 		target : '#uresponse', 
	 		beforeSubmit : ushowAddRequest,
	 		success :  ushowAddResponse,
	 		url : base_url+'crm/order/updateitems',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#updateitems').ajaxSubmit(options);
}

function ushowAddRequest(formData, jqForm, options){
	$("#uresponse").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function ushowAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#uresponse").removeClass('alert-success');
       	$("#uresponse").addClass('alert-danger');
		$("#uresponse").html(resp.message);
		$("#uresponse").show();
  	} else {
  		$("#uresponse").removeClass('alert-danger');
        $("#uresponse").addClass('alert-success');
        $("#uresponse").html(resp.message);
        $("#uresponse").show();
        alert(resp.message);
        window.location.reload();
  	}
}


$("#discount").focusout(function() {
	//alert("discount");
	var grand_total = parseInt($("#grand_total").val());
	var discount = parseInt($("#discount").val());
	if(isNaN(discount)) {
		discount = 0;
	}
	// var adjustment = parseInt($("#adjustment").val());
	// if(isNaN(adjustment)) {
		// adjustment = 0;
	// }
	var f_amount = grand_total-discount;
	$("#grand_total").val(f_amount);
});
$("#adjustment").focusout(function() {
	var o_amount = parseInt($("#o_amount").val());
	var discount = parseInt($("#discount").val());
	var adjustment = parseInt($("#adjustment").val());
	var f_amount = o_amount - discount - adjustment;
	$("#grand_total").val(f_amount);
});

function editPickupDate() {
	$("#pickup_date_lbl").hide();
	$("#pickup_date_input").show();
}

function updatePickupDate(orderid) {
	//ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/updatepickupdate/"+orderid,{ pickup_date: $("#pickup_date_edit").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function editPickupSlot() {
	$("#pickup_slot_lbl").hide();
	$("#pickup_slot_input").show();
}

function updatePickupSlot(orderid) {
	//ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/updatepickupslot/"+orderid,{ pickup_slot: $("#pickup_slot_edit").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function reschedulePickup(orderid) {
	//ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/reschedulepickup/"+orderid,{ pickup_date: $("#rspickup_date").val(), pickup_slot: $("#rspickup_slot").val(), notes: $("#rsnotes").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		if(data.status == 1)
		window.location.reload();
	},'json');
}

function editDeliveryDate() {
	$("#delivery_date_lbl").hide();
	$("#delivery_date_input").show();
}

function updateDeliveryDate(orderid) {
	//ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/updatedeliverydate/"+orderid,{ delivery_date: $("#delivery_date_edit").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function editDeliverySlot() {
	$("#delivery_slot_lbl").hide();
	$("#delivery_slot_input").show();
}

function updateDeliverySlot(orderid) {
//	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/updatedeliveryslot/"+orderid,{ delivery_slot: $("#delivery_slot_edit").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function rescheduleDelivery(orderid) {
	//ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/rescheduledelivery/"+orderid,{ delivery_date: $("#rsdelivery_date").val(), delivery_slot: $("#rsdelivery_slot").val(), notes: $("#rsdnotes").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		if(data.status == 1)
		window.location.reload();
	},'json');
}

function editCustomerName() {
	$("#customer_name_lbl").hide();
	$("#customer_name_input").show();
}

function updateCustomerName(orderid) {
	//ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/updatecustomername/"+orderid,{ name: $("#customer_name_edit").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}
function editCustomerMobile() {
	$("#customer_mobile_lbl").hide();
	$("#customer_mobile_input").show();
}

function updateCustomerMobile(orderid) {
//	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/updatecustomermobile/"+orderid,{ mobile: $("#customer_mobile_edit").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}
function editCustomerEmail() {
	$("#customer_email_lbl").hide();
	$("#customer_email_input").show();
}

function updateCustomerEmail(orderid) {
//	ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/updatecustomeremail/"+orderid,{ email: $("#customer_email_edit").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}
function editCustomerAddress() {
	$("#customer_address_lbl").hide();
	$("#customer_address_input").show();
}

function updateCustomerAddress(orderid) {
	//ajaxindicatorstart("Please hang on.. while we update ..");
	$.post(base_url+"crm/order/updatecustomeraddress/"+orderid,{ address: $("#customer_address_edit").val() }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function changeStatus(orderid) {
	var status = $("#status_id").val();
	if(status == "") {
		alert("Please select status.");
	} else {
		//if(status == 0 || status == 2) {
		//	ajaxindicatorstart("Please hang on.. while we update ..");
			$.post(base_url+"admin/order/updateorderstatus/"+orderid,{ status: status }, function(data){
			//	ajaxindicatorstop();
				alert(data.msg);
				window.location.reload();
			},'json');
		//} 
	}
}

function updateAdjustment(orderid) {
	if($("#iadjustment").val() > 0) {
		var adj_type = $("input[name='adj_type']:checked"). val();
		$.post(base_url+"crm/order/updateorderadjustment/"+orderid,{ adj_type: adj_type, adjustment: $("#iadjustment").val() }, function(data){
			//ajaxindicatorstop();
			alert(data.msg);
			window.location.reload();
		},'json');
	} else {
		alert("Please enter adjustment amount.");
	}
}

function resendPaymentLink(orderid) {
//	ajaxindicatorstart("Please hang on.. while we resend payment link ..");
	$.post(base_url+"crm/orders/resendpaymentlink/"+orderid,{ }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function deliveryAttempted(orderid) {
//	ajaxindicatorstart("Please hang on.. while we send sms ..");
	$.post(base_url+"crm/order/deliveryattemptedsms/"+orderid,{ }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function deliveryCallAnswered(orderid) {
	//ajaxindicatorstart("Please hang on.. while we send sms ..");
	$.post(base_url+"crm/order/deliverycallanssms/"+orderid,{ }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		window.location.reload();
	},'json');
}

function pickupAttempted(orderid) {
//	ajaxindicatorstart("Please hang on.. while we send sms ..");
	$.post(base_url+"crm/order/pickupattemptedsms/"+orderid,{ }, function(data){
	//	ajaxindicatorstop();
		alert(data.msg);
		$("#reSchedulePickup").modal('show');
	},'json');
}
function availableUFO(a){
	alert('hello');
	$.post(base_url+"admin/available/ufo" ,{ }, function(data){
		//	ajaxindicatorstop();
			alert(data.msg);
			//$("#reSchedulePickup").modal('show');
		},'json');
	}
}

</script>