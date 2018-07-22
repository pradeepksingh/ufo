
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
		<h3> <i> Update Banner </i></h3>
			<div class="panel panel-default">
			
				<div class="panel-heading">
					Update Banner
				</div>
				<div class="panel-body">
					<form action ="<?php echo base_url();?>admin/banner/updatebanner" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" id="id" value="<?php echo $banner['id'];?>"/>
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="cityid" name="cityid" required>
											<option value=""> select city</option>
											<?php foreach ($cities as $item){?>
											<option value="<?php echo $item['id']?>" <?php if($item['id'] == $banner['cityid']) { ?>selected<?php } ?>> <?php echo $item['name']?></option>
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
									<label class="control-label col-sm-3">Select Restaurants <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="restid" name="restid" required>
											<option value=""> select restaurants</option>
											<?php foreach ($rests as $item) { ?>
											<option value="<?php echo $item['id'];?>" <?php if($item['id'] == $banner['rest_id']) { ?>selected<?php } ?>><?php echo $item['name'];?></option>
											<?php } ?>
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
									<div>
										<img alt="" src="<?php echo asset_url();?><?php echo $banner['avatar'];?>">
									</div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Description<span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<textarea rows="5" colls="5" class="form-control" name="description"><?php echo $banner['description'];?></textarea>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<input type="submit" class="btn btn-primary" value="Update"/>
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

$("#cityid").change(function () {
	var html = "";
 	$.get(base_url + "admin/banner/getrestbycityid", {cityid: $("#cityid").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + " </option>" ;
  		});
        $('#restid').html(html);
 		
  	},'json');
});
</script>



