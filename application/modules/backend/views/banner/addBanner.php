
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
		<h3> <i> Add Banner  </i></h3>
			<div class="panel panel-default">
				<div class="panel-heading">
					Add Banner
				</div>
				<div class="panel-body">
					<form action ="addbanner" method="post" enctype="multipart/form-data">
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
									<label class="control-label col-sm-3">Select Restaurants <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="restid" name="restid" required>
											<option value=""> select restaurants</option>
										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Image (285*85)<span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<input type="file" class="form-control" id="avatar" name="avatar" value=""  title="" placeholder="" >
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Description<span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<textarea rows="5" colls="5" class="form-control" name="description"></textarea>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<input type="submit" class="btn btn-primary" value="Submit"/>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script >

$("#zone_id").change(function () {
	var html = "<option > Select Restaurant</option>";
 	$.get(base_url + "admin/restaurantoffers/getrestaurantbyzoneid", {zoneid: $("#zone_id").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + " </option>" ;
  		});
        $('#restid').html(html);
 	},'json');
});

$("#cityid").change(function () {
	var html = "<option> Select Zone</option>";
 	$.get(base_url + "admin/banner/getzonebycityid", {cityid: $("#cityid").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + " </option>" ;
  		});
        $('#zone_id').html(html);
 		
  	},'json');
});
</script>



