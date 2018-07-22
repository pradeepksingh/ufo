<style>
<!--
.btn-plus {
	margin: 5px 0px;
}
#myModal > .modal-dialog{
	margin-top: 20px;
	top :90px;
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
			<!--<div class="btn-plus">
				<a href="#"
					class="btn btn-primary view-contacts bottom-margin"> <i
					class="fa fa-plus"></i> Add User
				</a>
			</div>-->
			<div class="panel panel-default">
				<div class="panel-heading">Customer List <a href="<?php echo base_url();?>admin/customer/new"><button class="btn btn-sm btn-success pull-right">Add New  Customer</button></a></div>
				<div class="panel-body">
					<div class="">
						<table class="table table-striped " class="display nowrap" cellspacing="0" width="100%" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email Id</th>
									<th>Phone No</th>
									<th>Action </th>
								</tr>
							</thead>
							<tbody>
							
							<?php foreach ($customers as $item){?>
							
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
										<?php echo $item['email'];?>
									</td>
									<td>
										<?php echo $item['mobile'];?>
									</td>
									<td>
									<a href="<?php echo base_url();?>admin/customer/edit/<?php echo $item['id'];?>"   class="" disabled='true'>
											<i class="ti-pencil-alt"></i>
										</a>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--<a href=""
				class="btn btn-primary view-contacts bottom-margin"> <i
				class="fa fa-plus"></i> Add user
			</a>-->
		</div>
	</div>
</div>
	
  
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
});


</script>