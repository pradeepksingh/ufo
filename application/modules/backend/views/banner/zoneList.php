

<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="btn-plus">
				<a href="<?php echo base_url();?>admin/banner/newzone" class="btn btn-primary view-contacts bottom-margin">
					<i class="fa fa-plus"></i> Zone
				</a>
				
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Zone List
              	</div>
               	 <div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblCity">	
						<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>City</th>
									<th>status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($zones as $item){?>
								<tr>
									<td>
										<?php echo $item['id']?>
									</td>
									<td>
										<?php echo $item['name']?>
									</td>
									<td>
										<?php echo $item['cityname']?>
									</td>
									
									<td>
										<?php if($item['status']==1){?>
										<a href="javascript:turnOfZone(<?php echo $item['id'] ?>)">
											<i class="fa fa-cog text-success fa-lg"></i>
										</a>
										<?php }else {?>
										
										<a href="javascript:turnOnZone(<?php echo $item['id'] ?>)">
											<i class="fa fa-cog text-danger fa-lg"></i>
										</a>
										<?php }?>
										
									</td>
									<td><a href = "<?php echo base_url();?>admin/banner/editzone/<?php echo $item['id'];?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i> Edit</a></td>
								</tr>
							
							<?php }?>
								
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/banner/newzone" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Zone
			</a>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $('#tblCity').DataTable();
});
function turnOnZone(id)
{
 	$.get(base_url + "admin/banner/turnonzone/"+ id, {}, function (data) {
       
  	});
 	alert('Zone is Activated');
  	location.reload(true);
}
function turnOfZone(id)
{
 	$.get(base_url + "admin/banner/turnofzone/"+ id, {}, function (data) {
       
  	});
 	alert('Zone is Deactivated');
 	location.reload(true);
}
function deleteAreaFromZone(id)
{
 	$.get(base_url + "admin/banner/deletareafromzone/"+ id, {}, function (data) {
       
  	});
 	alert('Area is Remove from Zone');
 	location.reload(true);
}
</script>