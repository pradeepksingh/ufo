
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
			<h3> <i>Promoted Banner List</i></h3>
				<form action="<?php echo base_url();?>admin/banner/searchpromotedbanner" method="post"> 
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
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select Status <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="status" name="status">
											<option value="">Select Status</option>
											<option value="1">Active</option>
											<option value="0">In-Active</option>
										</select>
									</div>
									<div class="messageContainer col-sm-4"> <input type="submit" class="btn btn-primary" value="Search"></div>
							   </div>
							</div>
						</div>
					</form>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="btn-plus">
						<a href="<?php echo base_url();?>admin/banner/newpromotebanner" class="btn btn-primary view-contacts bottom-margin">
							<i class="fa fa-plus"></i> Promote 
						</a>
						
					</div>
				</div>
			<div class="panel-body">
				<div class="dataTable_wrapper">
					<table class="table table-striped table-bordered table-hover" id="tblCity">
					<thead class="bg-info">
							<tr>
								<th>ID</th>
								<th>City</th>
								<th>Restaurant</th>
								<th>Zone</th>
								<th>Priority</th>
								<th>status</th>
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
										<?php echo $item['city']?>
									</td>
									<td>
										<?php echo $item['rest']?>
									</td>
									<td>
										<?php echo $item['zone']?>
									</td>
									<td>
										<?php echo $item['priority']?>
									</td>
									<td>
										<?php if ($item['status']==1){?>
										<a href="javascript:turnOfBanner(<?php echo $item['id'];?>)">
											<i class="fa fa-cog text-success fa-lg"></i>
										</a>
										<?php } else {?>
										
										<a href="javascript:turnOnBanner(<?php echo $item['id'];?>)">
											<i class="fa fa-cog text-danger fa-lg"></i>
										</a>
										<?php }?>
									</td>
									<td>
										<a href="<?php echo base_url();?>admin/banner/editpromotedbanner/<?php echo $item['id'];?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> Edit</a>
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
function turnOnBanner(id)
{
 	$.get(base_url + "admin/banner/turnonbanner/"+ id, {}, function (data) {
       
  	});
 	alert('Banner is Activated');
 	location.reload(true);
}
function turnOfBanner(id)
{
 	$.get(base_url + "admin/banner/turnofbanner/"+ id, {}, function (data) {
      
  	});
 	 alert('Banner is Deactivated');
 	location.reload(true);
}

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