
<div class="row">
	<h4 class="font-size-25 space1">Cart</h4>
</div>
<input type="hidden" name="subtotal" id="subtotal" value="<?php echo $cart['subtotal']; ?>" />
<?php foreach($cart['cartitems'] as $productcart) { ?>
<div class="row margin-topp1 font-style1">
	<div class="col-sm-6 col-xs-6">
		<p><?php echo $productcart['name']; ?></p>
	</div>
	<div class="col-sm-6 col-xs-6 right">
		<p>(&#8377; <?php echo $productcart['totalprice']; ?>)</p>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-xs-6">
		<p>QTY <?php echo $productcart['cartquantity']; ?></p>
	</div>
	<div class="col-sm-6 col-xs-6"></div>
</div>
<?php } ?>
<?php if($cart['discount'] > 0) { ?>
<div class="row blue  margin-topp1">
	<div class="col-sm-6 col-xs-6">
		<p>Promotion Code</p>
		<p><?php echo $cart['coupon_code'];?></p>
	</div>
	<div class="col-sm-6 col-xs-6 right">
		<p>- &#8377; <?php echo $cart['discount'];?>/-</p>
	</div>
</div>
<?php } ?>
<?php if($cart['karma_discount'] > 0) { ?>
<div class="row blue  margin-topp1">
	<div class="col-sm-6 col-xs-6">
		<p>Karma Discount</p>
	</div>
	<div class="col-sm-6 col-xs-6 right">
		<p>- &#8377; <?php echo $cart['karma_discount'];?>/-</p>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="col-sm-6 col-xs-6">
		<p>
			<b>Order Total</b>
		</p>
	</div>
	<div class="col-sm-6 col-xs-6 right">
		<p>
			<b>&#8377; <?php echo $cart['subtotal'] - $cart['discount'] - $cart['karma_discount']; ?>/-</b>
		</p>
	</div>
</div>