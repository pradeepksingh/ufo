<style>
<!--
.btn-plus {
	margin: 5px 0px;
}
-->
</style>

<div id="page-wrapper" style="padding-top:20px">
	<div class="row">
	<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Offer</a></li>
    <li><a data-toggle="tab" href="#menu1">Active Offer</a></li>
    <li><a data-toggle="tab" href="#menu2">Log</a></li>
    
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="col-lg-12">
			<div class="btn-plus">
				<a href="<?php echo base_url();?>admin/offer/addoffer"
					class="btn btn-primary view-contacts bottom-margin"> <i
					class="fa fa-plus"></i> Add Offer
				</a>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Offer List</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover"
							id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Coupon Code</th>
									<th>Priority</th>
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
										<?php echo $item['coupon_code'];?>
									</td>
									<td>
										<?php echo $item['priority'];?>
									</td>
									<td>
										<?php if( $item['status'] == 1){?>
										
											<a href="javascript:turnOfOffer(<?php echo $item['id'] ?>,<?php echo $item['restid'] ?>)" class="btn btn-success icon-btn btn-xs">
												<i class="fa fa-gear"></i>
											</a>
											<?php } else {?>
									
											<a href="javascript:turnOnOffer(<?php echo $item['id'] ?>,<?php echo $item['restid'] ?>)" class="btn btn-danger icon-btn btn-xs">
												<i class="fa fa-gear"></i>
											</a>
											<?php }?>
									</td>
									<td>
									
										<a href="<?php echo base_url();?>admin/offer/editoffer/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="javascript:deleteOffer(<?php echo $item['id'] ?>,<?php echo $item['restid'] ?>)" class="btn btn-danger icon-btn btn-xs">
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
			<a href="<?php echo base_url();?>admin/offer/addoffer"
				class="btn btn-primary view-contacts bottom-margin"> <i
				class="fa fa-plus"></i> Add Offer
			</a>
		</div>
    </div>
    <div id="menu1" class="tab-pane fade">
     <div class="col-lg-12">
			<div class="btn-plus" style="height:20px">
				
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Active Offer List</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover"
							id="tblaoffer" style="width:100%">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Title</th>
									<th>Coupon Code</th>
									<th>Priority</th>
									<th>Status</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
							<?php foreach ($offer as $item){?>
							<?php if( $item['status'] == 1){?>
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['title'];?>
									</td>
									<td>
										<?php echo $item['coupon_code'];?>
									</td>
									<td>
										<?php echo $item['priority'];?>
									</td>
									<td>
										<?php if( $item['status'] == 1){?>
										
											<a href="javascript:turnOfOffer(<?php echo $item['id'] ?>,<?php echo $item['restid'] ?>)" class="btn btn-success icon-btn btn-xs">
												<i class="fa fa-gear"></i>
											</a>
											<?php } else {?>
									
											<a href="javascript:turnOnOffer(<?php echo $item['id'] ?>,<?php echo $item['restid'] ?>)" class="btn btn-danger icon-btn btn-xs">
												<i class="fa fa-gear"></i>
											</a>
											<?php }?>
									</td>
									<td>
									
										<a href="<?php echo base_url();?>admin/offer/editoffer/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="javascript:deleteOffer(<?php echo $item['id'] ?>,<?php echo $item['restid'] ?>)" class="btn btn-danger icon-btn btn-xs">
											<i class="fa fa-remove"></i>
										</a>
									</td>
								</tr>
								<?php }}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
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
							id="tbllog" style="width:100%">
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
<!-- Modal coment -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
    $('#tblaoffer').DataTable();
    $('#tbllog').DataTable();
});


function turnOnOffer(id,restid)
{
	/*$('#myModal').modal({
        backdrop: 'static',
        keyboard: true
    });*/
 	$.get(base_url + "admin/offer/turnonoffer/"+ id, {restid:restid}, function (data) {
       
  	});
 	alert('Offer is Activated');
  	location.reload(true);
}
function turnOfOffer(id,restid)
{
	
 	$.get(base_url + "admin/offer/turnofoffer/"+ id, {restid:restid}, function (data) {
       
  	});
 	alert('Offer is Deactivated');
 	location.reload(true);
}
function deleteOffer(id,restid)
{
 	$.get(base_url + "admin/offer/deleteoffer/"+ id, {restid:restid}, function (data) {
       
  	});
 	alert('Offer is removed');
 	location.reload(true);
}

</script>