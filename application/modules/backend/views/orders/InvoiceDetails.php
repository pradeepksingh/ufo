<html>
<head>
<title>Invoice</title>
<style>
	.items td{
		border-bottom:1px solid #212121;
		border-right:1px solid #212121;
		padding:5px;
	}
	.summary td{
		border-bottom:1px solid #212121;
		padding:5px;
	}
	table { 
	    border-spacing: 0;
	    border-collapse: collapse;
	}
</style>
</head>
<body>
<div style="border:1px solid #212121;" align="center">
<table style="padding:25px;">
	<tr>
		<td>
			<table style="width:100%;">
				<tr>
					<td style="width:70%;">
						<img alt="Logo" src="<?php echo asset_url();?>backend/images/logo-text-dark.png"/>
					</td>
					<td>
						<table>
							<tr>
								<td>Receipt No.</td>
								<td>: <?php echo $invoice_number;?></td>
							</tr>
							<!--<tr>
								<td>PickUp Date</td>
								<td>: <?php// echo date('j M Y',strtotime($order['pickup_date']));?></td>
							</tr>-->
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%;">
				<tr>
					<td style="width:30%;">Name Of Customer</td>
					<td>: <?php echo $order['name'];?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>: <?php echo $order['address'];?></td>
				</tr>
				<tr>
					<td>Contact No</td>
					<td>: <?php echo $order['mobile'];?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%;" cellspacing="0">
				<tr class="items">
					<td style="border-left:1px solid #212121;border-top:1px solid #212121;"><b>Product Name</b></td>
					<td style="border-top:1px solid #212121;"><b>Quantity</b></td>
					<td style="border-top:1px solid #212121;"><b>Rate</b></td>
					<td style="border-top:1px solid #212121;"><b>Total</b></td>
				</tr>
				<?php foreach ($products as $item) { ?>
				<tr class="items">
					<td style="border-left:1px solid #212121;"><?php echo $item['prod_name'];?></td>
					<td><?php echo $item['quantity']; ?></td>
					<td><?php echo $item['price'];?></td>
					<td><?php echo $item['total_amount'];?></td>
				</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			<table style="width:100%;" cellspacing="0">
				<tr class="summary">
					<td>Total</td>
					<td style="text-align: right;">Rs. <?php echo $order['order_amount'];?></td>
				</tr>
				<tr class="summary">
					<td>Less: Discount</td>
					<td style="text-align: right;">Rs. <?php echo $order['zyk_discount'];?></td>
				</tr>
				<tr class="summary">
					<td>Add: Convenience fees</td>
					<td style="text-align: right;">Rs. <?php echo $order['delivery_charge'];?></td>
				</tr>
				<tr class="summary">
					<td>Net Total</td>
					<td style="text-align: right;">Rs. <?php echo $order['net_total'];?></td>
				</tr>
				<!--<tr class="summary">
					<td>Add/(Less)- Adjustments</td>
					<td style="text-align: right;">Rs. <?php //echo $order['adjustment'];?></td>
				</tr>-->
				<tr class="summary">
					<td style="border-bottom:2px solid #212121;"><b>Grand Total</b></td>
					<td style="text-align:right;border-bottom:2px solid #212121;">Rs. <?php echo $order['grand_total'];?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="text-align:center;">
			Thank you! 
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
</div>
</body>
</html>