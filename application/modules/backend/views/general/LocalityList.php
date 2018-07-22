<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<!--<div style="padding-top:10px;">
			<div class="col-sm-6">
				<select name="cityid" id="cityid" class="form-control">
					<option value=""> Select City </option>
					<?php foreach ($cities as $city) { ?>
					<option value="<?php echo $city['id'];?>" <?php if($city['id'] == $cityid) {?>selected<?php }?>><?php echo $city['name'];?></option>
					<?php } ?>
				</select>
			</div>
		</div>-->
		<div class="col-lg-12">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/general/newlocality" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Locality
			</a>
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Locality List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblLocality">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Pincode</th>
									<!--<th>Latitude</th>
									<th>Longitude</th>
									<th>Zone</th>-->
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="locality_area">
							<?php if (isset($localities)) { ?>
							<?php foreach ($localities as $item):?>
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php echo $item['pincode'];?>
									</td>
									<?php /* <td>
										<?php echo $item['latitude'];?>
									</td>
									<td>
										<?php echo $item['longitude'];?>
									</td>
									<td>
										<?php echo $item['zone_name'];?>
									</td> */ ?>
									<td>
										<?php if($item['status'] == 1) {?>
										<a href="<?php echo base_url();?>admin/general/turnofflocality/<?php echo $item['id'];?>">
											<i class="fa fa-cog text-success fa-lg"></i>
										</a>
										<?php }else{?>
										<a href="<?php echo base_url();?>admin/general/turnonlocality/<?php echo $item['id'];?>">
											<i class="fa fa-cog text-danger fa-lg"></i>
										</a>
										<?php }?>
									</td>
									<td><a href = "<?php echo base_url();?>admin/general/editlocality/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a></td>
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
			<a href="<?php echo base_url();?>admin/general/newlocality" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> Locality
			</a>
		</div>
	</div>
</div>
<script>
$("#cityid").change(function() {
	window.location.href = base_url+"admin/general/localitylist/"+$("#cityid").val();
});

$(document).ready(function(){
    $('#tblLocality').DataTable();
});
</script>

