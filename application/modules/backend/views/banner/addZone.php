
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
					Add Zone
				</div>
				<div class="panel-body">
					<div class="row" style="margin-top:5px">
						<div class="col-lg-12 margin-bottom-5">
							<div class="form-group" id="error-name">
								<label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="cityid" name="cityid">
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
								<label class="control-label col-sm-3">Name <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<input type="text" name="name" id="name" class="form-control"/>
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
										<option value="1"> Active </option>
										<option value="0"> Deactive </option>
									</select>
								</div>
								<div class="messageContainer col-sm-4"></div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:5px">
						<div class="col-lg-12 margin-bottom-5">
							<div class="form-group" id="error-name">
								<input type="button" class="btn btn-primary" id="addzone" value="Submit"/>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script >

$("#addzone").click(function () {
 	$.get(base_url + "admin/banner/addzone", {cityid: $("#cityid").val(),name: $("#name").val(),status: $("#status").val()}, function (data) {
        alert("Added Successfully");
 		window.location.assign('zonelist');
  	});
});
</script>

