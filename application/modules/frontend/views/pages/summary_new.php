<div class="col-sm-offset-6 col-sm-6 cart-total-summary">
	<input type="hidden" name="cart_subtotal" id="cart_subtotal" value="<?php echo $cart['subtotal'];?>" />
	<div class="col-xs-8 summary_head">
		<strong>Item Total</strong>
	</div>
	<div class="col-xs-4 summary_head">
		<i class="fa fa-rupee"></i> <?php echo $cart['subtotal'];?>
	</div>
	<?php if(!empty($cart['discount'])) { ?>
	<div class="col-xs-8 summary_head">
		<strong>Discount</strong>
	</div>
	<div class="col-xs-4 summary_head">
		<i class="fa fa-rupee"></i> <?php echo $cart['discount'];?>
	</div>
	<?php } ?>
	<div class="col-xs-8 summary_head">
		<strong>Delivery Charges</strong>
	</div>
	<div class="col-xs-4 summary_head">
		<i class="fa fa-rupee"></i> <?php echo $cart['delivery_charge'];?>
	</div>
	<div class="col-xs-12"><hr style="margin:10px 0px;"/></div>
	<div class="col-xs-8 summary_head_total">
		<strong>Final Total</strong>
	</div>
	<div class="col-xs-4 summary_head_total">
		<i class="fa fa-rupee"></i> <?php echo $cart['ordertotal'];?>
	</div>
</div>