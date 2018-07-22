<html>
<body>
	<div class="ii gt m14b7cc3fd14b6cd9adPadO">
		<div style="overflow:hidden;" >
			<table width="100%" cellpadding=0 border=0>
				<tbody>
					<tr>
						<td bgcolor="#f7f7f9">
							<table cellspacing="0 cellpadding=0 border=0 bgcolor=#68c1ec align=center style=background: #68c1ec">
								<tbody>
									<tr>
										<td valign="top" >
											<a href="www.themoustachelaundry.com"> 
												<img src='<?php echo asset_url()?>images/icons/email-logo.png' height='60px' width='205px'>
											</a> 
											<br />
										</td>
									</tr>
								</tbody>
							</table>
							<table width="581 cellspacing=0 cellpadding=0 border=0 bgcolor=#f7f7f9 align=center style=border-bottom: 1px solid #e1e1e1;margin-bottom:30px;">
								<tbody>
									<tr>
										<td valign="top style=padding: 0px 13px 10px 14px;font-family:Calibri,Calibri,sans-serif;">
											<table width="100% cellspacing=0 cellpadding=0 style=background: #f7f7f9; padding: 15px;">
												<tbody>
													<tr>
														<td style="padding-bottom:10px;">
															<h2 style="font-weight:bold;color:#666666;font-family:'Calibri',sans-serif;font-weight:300;">Dear <?php echo $data['name'];?>,</h2>
														</td>
													</tr>
													<tr>
														<td style="color:#666666;font-size:16px;padding-bottom:17px;font-family:'Calibri',sans-serif;font-weight:300;font-weight:2;">
															Your order is ready to be delivered. The bill amounts to Rs <?php echo $data['bill_amount'];?>. The Moustache Man, <?php echo $data['delivery_executive'];?> (<?php echo $data['delivery_executive_mobile'];?>) will be there at the schedule time, be there to say Hi!
															<br><br>
														</td>
													</tr>
													<tr>
														<td style="color:#666666;font-size:16px;padding-bottom:17px;font-family:Calibri,sans-serif;font-weight:300;font-weight:2;">
															Regards, <br> The Moustache Laundry
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
							<table width="581 cellspacing=0 cellpadding=0 border=0 align=center style=border-collapse: collapse; height: 30px;">
								<tbody>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
