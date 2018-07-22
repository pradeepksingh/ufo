
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
			<div class="panel panel-default">
				<div class="panel-heading">
					Edit Zone
				</div>
				<div class="panel-body">
					<input type="hidden" name="id" id="id" value="<?php echo $zone['id'];?>"/>
					<div class="row" style="margin-top:5px">
						<div class="col-lg-12 margin-bottom-5">
							<div class="form-group" id="error-name">
								<label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="cityid" name="cityid">
											<option value=""> select city</option>
											<?php foreach ($cities as $item){?>
											<option value="<?php echo $item['id']?>" <?php if($item['id'] == $zone['city_id']) { ?>selected<?php } ?>> <?php echo $item['name']?></option>
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
								<label class="control-label col-sm-3">Name <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<input type="text" name="name" id="name" class="form-control" value="<?php echo $zone['name'];?>"/>
									</div>
									<div class="messageContainer col-sm-4"></div>
						    </div>
						</div>
					</div>   
					<div class="row" style="margin-top:5px">
						<div class="col-lg-12 margin-bottom-5">
							<div class="form-group" id="error-name">
								<label class="control-label col-sm-3">Status <span class='text-danger'>*</span></label>
								<div class="col-sm-5">
									<select class="form-control" id="status" name="status">
										<option value=""> select status</option>
										<option value="1" <?php if($zone['status'] == 1) {?>selected<?php } ?>> Active </option>
										<option value="0" <?php if($zone['status'] == 0) {?>selected<?php } ?>> Deactive </option>
									</select>
								</div>
								<div class="messageContainer col-sm-4"></div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:5px">
						<div class="col-lg-12 margin-bottom-5">
							<div class="form-group" id="error-name">
									<input type="button" class="btn btn-primary" id="updatezone" value="Update"/>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script >

$("#updatezone").click(function () {
 	$.get(base_url + "admin/banner/updatezone", { id: $("#id").val(), cityid: $("#cityid").val(),name: $("#name").val(),status: $("#status").val()}, function (data) {
        alert("Updated Successfully");
 		window.location.href = base_url+"admin/banner/zonelist";
  	});
});
</script>

