<!--  Restaurant Offer List -->
<style>
<!--
.btn-plus {
	margin: 5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
	
		<div class="alert alert-info" style="margin:5px;padding:10px">
			<div class="row" style="padding-top:10px;">
				<div class="col-sm-3"><b> Search By Status</b></div>
				<div class="col-sm-3">
					<select id="offer_status" name="offer_status" class="form-control">
						<option value="" <?php if($status == '') {?>selected<?php }?>>Select Status</option>
						<option value="1" <?php if($status == 1) {?>selected<?php }?>>Active</option>
						<option value="0" <?php if($status == '0') {?>selected<?php }?>>In-Active</option>
					</select>
				</div>
			</div>
		</div>
		<ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">Add Offer</a></li>
		   
		    <li><a data-toggle="tab" href="#menu2">Log</a></li>
	  </ul>
	  <div class="tab-content">
    	<div id="home" class="tab-pane fade in active">
		<div class="col-lg-12">
			<div class="btn-plus">
				<a href="<?php echo base_url();?>admin/restaurantoffers/new"
					class="btn btn-primary view-contacts bottom-margin"> <i
					class="fa fa-plus"></i> Add Offer
				</a>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Restaurant Offer List</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover"
							id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Restaurant</th>
									<th>From Date </th>
									<th>To Date</th>
									<th>Descount By Rest</th>
									<th>Status</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
						
							<?php foreach ($offer as $item){?>
							
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['title'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php echo $item['from_date'];?>
									</td>
									<td>
										<?php echo $item['to_date'];?>
									</td>
									<td>
										<?php echo $item['discount_by_rest'];?>
										<?php if($item['discount_type']==1){ echo " %";}else{ echo " Flat";}?>
									</td>
									<td>
									<?php if( $item['status'] == 1){?>
										<a href="javascript:turnOf(<?php echo $item['id'] ?>)" class="btn btn-success icon-btn btn-xs">
											<i class="fa fa-gear"></i>
										</a>
									<?php } else {?>
										<a href="javascript:turnOn(<?php echo $item['id'] ?>)" class="btn btn-danger icon-btn btn-xs">
											<i class="fa fa-gear"></i>
										</a>
									<?php }?>
									</td>
									<td>
										<a href="<?php echo base_url();?>admin/restaurantoffers/edit/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="javascript:deleteOffer(<?php echo $item['id'] ?>)" class="btn btn-danger icon-btn btn-xs">
											<i class="fa fa-remove"></i>
										</a>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/restaurantoffers/new" class="btn btn-primary view-contacts bottom-margin"> 
				<i class="fa fa-plus"></i> Add Offer
			</a>
		</div>
		
		</div>
		<div id="menu2" class="tab-pane fade">
     <div class="col-lg-12">
			<div class="btn-plus" style="height:20px">
				
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Offer Log List</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover"
							id="log" style="width:100%">
							<thead class="bg-info">
								<tr>
									<th>Field Name</th>
									<th>Old value</th>
									<th>New value</th>
									<th>Date</th>
									<th>Rest id</th>
									<th>Updated By</th>
									<th>Update On</th>
									
								</tr>
							</thead>
							<tbody>
							<?php foreach ($log as $item){?>
							
								<tr>
									<td>
										<?php echo $item['field_name'];?>
									</td>
									<td>
										<?php echo $item['old_value'];?>
									</td>
									<td>
										<?php echo $item['new_value'];?>
									</td>
									<td>
										<?php echo $item['updated_datetime'];?>
									</td>
									<td>
										<?php echo $item['restid'];?>
									</td>
									<td>
										<?php echo $item['updated_by'];?>
									</td>
									<td>
										<?php echo $item['page_name'];?>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
    </div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
    $('#log').DataTable();
});
function turnOn(id)
{
 	$.get(base_url + "admin/restaurantoffers/turnonoffer/"+ id, {}, function (data) {
       
  	});
 	alert('Offer is Activated');
  	location.reload(true);
}
function turnOf(id)
{
 	$.get(base_url + "admin/restaurantoffers/turnofoffer/"+ id, {}, function (data) {
       
  	});
 	alert('Offer is Deactivated');
 	location.reload(true);
}
function deleteOffer(id)
{
 	$.get(base_url + "admin/restaurantoffers/delete/"+ id, {}, function (data) {
       
  	});
 	alert('Offer is removed');
 	location.reload(true);
}

$("#offer_status").change(function(){
	window.location.href = base_url+"admin/restaurantoffers?status="+$(this).val();
});

</script>