<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div style="padding-top:10px;">
			<div class="col-sm-6">
				<select name="cat_id" id="cat_id" class="form-control">
					<option value="0"> Select Category </option>
					<?php foreach ($categories as $category) { ?>
					<option value="<?php echo $category['id'];?>" <?php if($category['id'] == $cat_id) {?>selected<?php }?>><?php echo $category['name'];?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="btn-plus">
			<a href="<?php echo base_url();?>admin/subcategory/new" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> SubCategory
			</a>
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	SubCategory List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                       	<table class="table table-striped table-bordered table-hover" id="tblitems">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Category Name</th>
									<th>SubCategory Name</th>
									<!-- <th>Status</th>-->
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="items_area">
							<?php if (isset($subcat)) { ?>
							<?php foreach ($subcat as $sub_cat):?>
								<tr>
									<td>
										<?php echo $sub_cat['id'];?>
									</td>
									<td>
										<?php echo $sub_cat['category'];?>
									</td>
									<td>
										<?php echo $sub_cat['name'];?>
									</td>
									<!-- <td>
										<?php if($subcat['status'] == 1) {?>
										<a href="javascript:turnOff(<?php echo $sub_cat['id'];?>);">
											<i class="fa fa-cog text-success fa-lg"></i>
										</a>
										<?php }else{?>
										<a href="javascript:turnOn(<?php echo $sub_cat['id'];?>);">
											<i class="fa fa-cog text-danger fa-lg"></i>
										</a>
										<?php }?>
									</td>-->
									<td><a href = "<?php echo base_url();?>admin/subcategory/edit/<?php echo $sub_cat['id']?>" class="btn btn-success icon-btn btn-xs"><i class="fa fa-pencil"></i></a></td>
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
			<a href="<?php echo base_url();?>admin/subcategory/new" class="btn btn-primary view-contacts bottom-margin">
				<i class="fa fa-plus"></i> SubCategory
			</a>
		</div>
	</div>
</div>
<script>
$("#cat_id").change(function() {
	window.location.href = base_url+"admin/subcategory/list/"+$("#cat_id").val();
});

$(document).ready(function(){
    $('#tblitems').DataTable();
});
function turnOn(id) {
	$.get(base_url+'admin/subcategory/turnon/'+id,{},function(){
		window.location.reload();
	});
}
function turnOff(id) {
	$.get(base_url+'admin/subcategory/turnoff/'+id,{},function(){
		window.location.reload();
	});
}
</script>

