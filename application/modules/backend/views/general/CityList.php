<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div>
		</div>
		<div class="col-lg-12">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/general/newcity" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> City
			</a>
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	City List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblCity">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($cities)) { ?>
							<?php foreach ($cities as $item):?>
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php if($item['status'] == 1) {?>
										<a href="<?php echo base_url();?>admin/general/turnoffcity/<?php echo $item['id'];?>">
											<i class="fa fa-cog text-success fa-lg"></i>
										</a>
										<?php }else{?>
										<a href="<?php echo base_url();?>admin/general/turnoncity/<?php echo $item['id'];?>">
											<i class="fa fa-cog text-danger fa-lg"></i>
										</a>
										<?php }?>
									</td>
									<td><a href = "<?php echo base_url();?>admin/general/editcity/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a></td>
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr><td colspan="4">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/general/newcity" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> City
			</a>
		</div>
	</div>
</div>

<script>

$(document).ready(function(){
    $('#tblCity').DataTable();
});
</script>