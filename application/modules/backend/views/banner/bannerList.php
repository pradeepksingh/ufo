
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
			<h3> <i>Banner List</i></h3>
				<form action="searchbanner" method="post"> 
					<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="cityid" name="cityid" required>
											<option value=""> select city</option>
													<?php foreach ($cities as $item){?>

											<option value="<?php echo $item['id']?>"> <?php echo $item['name']?></option>
													<?php }?>
										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
							   </div>
							</div>
						</div>
					<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select Zone <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="zone_id" name="zone_id" required>
										
										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
							   </div>
							</div>
						</div>
						<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Select Restaurant <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="rest_id" id="rest_id" required>
												
											</select>
										</div>
										<div class="messageContainer col-sm-4"><input type="submit" value="search" class="btn btn-primary"/></div>
									</div>
								</div>
							</div>
					</form>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="btn-plus">
						<a href="<?php echo base_url();?>admin/banner/newbanner" class="btn btn-primary view-contacts bottom-margin">
							<i class="fa fa-plus"></i> Banner
						</a>
						
					</div>
				</div>
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblCity">
					<thead class="bg-info">
							<tr>
								<th>ID</th>
								<th>Restaurant</th>
								<th>Description</th>
								<th>Actions</th>
							
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $banner as $item) { ?>
								<tr>
									<td>
									<?php echo $item['id']?>
									</td>
									<td>
										<?php echo $item['rest']?>
									</td>
									<td>
										<?php echo $item['description']?>
									</td>
									<td>
										<a href="<?php echo base_url();?>admin/banner/editbanner/<?php echo $item['id'];?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
									</td>
								</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<a href="<?php echo base_url();?>admin/banner/newbanner" class="btn btn-primary view-contacts bottom-margin">
					<i class="fa fa-plus"></i> Banner
				</a>
			</div>
		</div>
	</div>

<script>


$(document).ready(function(){
    $('#tblCity').DataTable();
});
$("#zone_id").change(function () {
	var html = "<option value=''> Select Restaurant</option>";
 	$.get(base_url + "admin/restaurantoffers/getrestaurantbyzoneid", {zoneid: $("#zone_id").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + value.areaname+  " </option>" ;
  		});
        $('#rest_id').html(html);
 	},'json');
});
$("#cityid").change(function () {
	var html = "<option value=''> Select Zone </option>";
 	$.get(base_url + "admin/banner/getzonebycityid", {cityid: $("#cityid").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + " </option>" ;
  		});
        $('#zone_id').html(html);
 		
  	},'json');
});

</script>