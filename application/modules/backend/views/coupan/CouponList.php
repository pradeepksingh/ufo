<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>

<div id="page-wrapper">
	<div class="row" >
		<div>
			<form action="" method="post">
			
			</form>
		</div>
		<div class="col-lg-12" style="padding:0px">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/coupon/newCoupon" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add
			</a>
			</div>
        	<div class="panel panel-default"  >
            	<div class="panel-heading" style="width:500">
                	Coupon List
              	</div>
              <div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblCity">	<thead class="bg-info">
								<tr>
									<th>Title</th>
									<th>Coupon Code</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Discount</th>
									<th>First Order ?</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($coupons)) { ?>
							<?php foreach ($coupons as $coupon):?>
								<tr>
									<td>
										<?php echo $coupon['title'];?>
									</td>
									<td>
										<?php echo $coupon['coupon_code'];?>
									</td>
									<td>
										<?php echo date('j M Y',strtotime($coupon['start_date']));?>
									</td>
									<td>
										<?php echo date('j M Y',strtotime($coupon['end_date']));?>
									</td>
									<td>
										<?php echo $coupon['discount'];?> <?php if($coupon['discount_type'] == 0) {?>%<?php } else {?>Flat<?php } ?>
									</td>
									<td>
										<?php if($coupon['is_new_user'] == 0) {?>No<?php } else {?>Yes<?php } ?>
									</td>
									<td>
										<?php if($coupon['status'] == 1) {?>
										<a href="javascript:turnOff(<?php echo $coupon['id'];?>);">
											<i class="fa fa-cog text-success fa-lg"></i>
										</a>
										<?php }else{?>
										<a href="javascript:turnOn(<?php echo $coupon['id'];?>);">
											<i class="fa fa-cog text-danger fa-lg"></i>
										</a>
										<?php }?>
									</td>
									<td><a href = "<?php echo base_url();?>admin/coupon/update/<?php echo $coupon['id']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a></td>
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr><td colspan="6">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/coupon/newCoupon" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Add 
			</a>
		</div>
	</div>
</div>
<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>-->

<!-- Modal -->
<script>
$(document).ready(function(){
    $('#tblCity').DataTable();
});
    function deleteVendor(a)
    {
        //alert("dfsdf");
       $.get(base_url + "admin/coupon/deletevendor/"+a, {vendorid: a}, function (data) {
                   // var html = "<option value=''>Select Area</option>";
                   
                   alert("Delete Complete");
                   window.location.reload();
                });
    }

    function turnOn(id) {
    	$.get(base_url+'admin/coupan/turnoncoupon/'+id,{},function(){
    		window.location.reload();
    	});
    }
    function turnOff(id) {
    	$.get(base_url+'admin/coupan/turnoffcoupon/'+id,{},function(){
    		window.location.reload();
    	});
    }
</script>
    
    