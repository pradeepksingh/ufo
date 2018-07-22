
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
					Assign Area to Zone
				</div>
				<div class="panel-body">
				<form action = "addassignzonearea" method="post">
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
										<select class="form-control" id="zoneid" name="zoneid" required>
											<option value=""> select zone</option>
										</select>
									</div>
									<div class="messageContainer col-sm-4"><input type="submit" class="btn btn-primary" id="" value="Save"/></div>
						    </div>
						</div>
					</div>
						
					<div class="row" style="margin-top:5px">
						<div class="col-lg-12 margin-bottom-5">
							<div class="form-group" id="error-name">
								
									<div class="col-sm-12" id="area">
										
									</div>
									
						    </div>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$("#cityid").change(function () {
 	$.get(base_url + "admin/banner/getzonebycityid", {cityid: $("#cityid").val()}, function (data) {
     	var html = "<option value=''>Select Area</option>";
       	$.each(data, function (key, value) {
       		html = html + "<option value='" + value.id + "'>" + value.name + "</option>";
       	});
    	$("#zoneid").html(html);
  	}, 'json');
});

$("#zoneid").change(function () {
	var html = "";
 	$.get(base_url + "admin/banner/getareanotinzone", {zoneid: $("#zoneid").val(),cityid: $("#cityid").val()}, function (data) {
     	
       	$.each(data, function (key, value) {
       		html = html + "<div class='col-sm-4' style='padding-top:5px'><label class='checkbox-inline' style=''> <input type='checkbox' id='areas' name='areas[]' value='" + value.id +"' >" + value.name + " </label></div>";
       	});
       	$("#area").html(html);
  	}, 'json');
 	
});
$("#assignarea").click(function () {
	var html = "";
 	$.get(base_url + "admin/banner/addassignzonearea", {zoneid: $("#zoneid").val(),area: $("input[name~='areas[]']").val()}, function (data) {

 	     alert("Added Successfully");
       
  	});
 	
});
</script>

