<?php foreach ($cart['cartitems'] as $cartitem) { ?>
<?php if($cartitem['size'] != 'standard') { $cart_item_size = $cartitem['size']; } else { $cart_item_size = 'standard'; } ?>
	<div class="row cart-items">
		<div class="col-xs-2">
			<?php if(!empty($cartitem['image'])) { ?>
			<img src="http://localhost/vp/assets/<?php echo $cartitem['image'];?>" title="<?php echo $cartitem['name'];?>" class=""/>
			<?php } else { ?>
			<img src="<?php echo asset_url();?>images/menu/category/img-10.jpg" title="<?php echo $cartitem['name'];?>" class=""/>
			<?php } ?>
		</div>
		<div class="col-xs-10">
			<div class="col-xs-8"><?php echo $cartitem['name'];?><?php if($cartitem['size'] != 'standard') { echo " (".ucfirst($cartitem['size']).")";}?></div>
			<div class="col-xs-4">
				<div class="input-group">
					<?php if(count($cartitem['itemsets']) <= 0) {?>
					<a href="javascript:removeItemFromCart(<?php echo $cartitem['itemid'];?>,<?php echo $cartitem['option_id'];?>);" class="">
						<i class="fa fa-minus-circle fa-lg"></i>
					</a> 
					<?php } else { ?>
					<span style="padding-left:10px;">&nbsp;</span>
					<?php } ?>
					<?php echo $cartitem['quantity'];?>
					<?php if(count($cartitem['itemsets']) <= 0) {?>
					<a href="javascript:addItemToCart(<?php echo $cartitem['itemid'];?>,<?php echo $cartitem['option_id'];?>,`<?php echo $cart_item_size;?>`,<?php echo $cartitem['price'];?>);" class="">
						<i class="fa fa-plus-circle fa-lg"></i>
					</a>
					<?php } ?>
				</div>
			</div>
			<div class="col-sm-12"><i class="fa fa-rupee"></i> <?php echo $cartitem['totalprice'];?></div>
		</div>
	</div>
<?php } ?>