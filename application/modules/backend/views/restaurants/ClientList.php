<style>
<!--
.btn-plus {
	margin: 5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div>
			<form action="<?php echo base_url().'general/editcity'?>"
				method="post"></form>
		</div>
		<div class="col-lg-12">
			<div class="btn-plus">
				<a href="<?php echo base_url();?>admin/restaurant/newclient"
					class="btn btn-primary view-contacts bottom-margin"> <i
					class="fa fa-plus"></i> Client Login
				</a>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Client Login List</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover"
							id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>User Name</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($clients)) { ?>
							<?php foreach ($clients as $item):?>
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['brand_name'];?>)
									</td>
									<td>
										<?php echo $item['username'];?>
									</td>
									<td>
										<?php if($item['client_status'] == 1) { ?>
											<a href="<?php echo base_url();?>admin/restaurant/turnoffclient/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs">
												<i class="fa fa-gear"></i>
											</a>
										<?php } else { ?>
											<a href="<?php echo base_url();?>admin/restaurant/turnonclient/<?php echo $item['id']?>" class="btn btn-danger icon-btn btn-xs">
												<i class="fa fa-gear"></i>
											</a>
										<?php } ?>
									</td>
									<td>
										<a href="<?php echo base_url();?>admin/restaurant/editclient/<?php echo $item['id']?>" class="btn btn-success icon-btn btn-xs">
											<i class="fa fa-pencil"></i>
										</a>
									</td>
								</tr>
								<?php endforeach;?>
							<?php } else { ?>
								<tr>
									<td colspan="5">Records not found.</td>
								</tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url();?>admin/restaurant/newclient"
				class="btn btn-primary view-contacts bottom-margin"> <i
				class="fa fa-plus"></i> Client Login
			</a>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
});

</script>