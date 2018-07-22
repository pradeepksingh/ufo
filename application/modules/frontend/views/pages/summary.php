<div class="row cart-total-summary">
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
</div>
<div class="gross_total">
	<div class="col-xs-8 summary_head">
		<strong>Final Total</strong>
	</div>
	<div class="col-xs-4">
		<i class="fa fa-rupee"></i> <?php echo $cart['ordertotal'];?>
	</div>
</div>