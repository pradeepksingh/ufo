<!--  Add Restaurant -->
<style>
<!--
.margin-bottom-5 {
	margin-bottom: 5px;
}
-->
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3>Add Offer</h3>
		</div>
	</div>
	<form id="addcity" action="<?php echo base_url();?>admin/restaurantoffers/add" method="post" enctype='multipart/form-data'>
		<div id="basic" class="tab-pane fade in active">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
					<div class="panel-heading">Add Offer</div>
					<div class="panel-body">
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-cityid">
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
								<div class="form-group" id="error-zone_id">
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
									<div class="form-group" id="error-restid">
										<label class="control-label col-sm-3">Select Restaurant <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="restid" id="restid" required>
												
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-title">
										<label class="control-label col-sm-3">Title <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="title" name="title" required />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-description">
										<label class="control-label col-sm-3">Description <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<textarea rows="7" class="form-control" name="description" required></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        <div class="form-group" id="error-from_date">
                                            <label class="control-label col-sm-3">From Date <span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="from_date" name="from_date" required value=""/>
                                            </div>
                                            <div class="messageContainer col-sm-4"></div>
                                        </div>
                                    </div>
                                </div>
								<div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        <div class="form-group" id="error-to_date">
                                            <label class="control-label col-sm-3">To Date <span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="to_date" name="to_date" required value=""/>
                                            </div>
                                            <div class="messageContainer col-sm-4"></div>
                                    	</div>
                           			 </div>
                           		 </div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-discount_type">
										<label class="control-label col-sm-3">Descount Type<span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="discount_type" required>
												<option value="1"> Percentage</option>
												<option value="2"> Flat</option>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-payment_mode">
										<label class="control-label col-sm-3">Accepted Payment Type<span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="payment_mode" id="payment_mode" required>
												<option value="0"> Both</option>
												<option value="1"> Online</option>
												<option value="2"> COD</option>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row" style="display:none;">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-discount_by_zk">
										<label class="control-label col-sm-3">Descount By ZYK<span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											  <input type="text" class="form-control" id="discount_by_zk" name="discount_by_zk" required value="0"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-discount_by_rest">
										<label class="control-label col-sm-3">Descount By Restaurant <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											  <input type="text" class="form-control" id="discount_by_rest" name="discount_by_rest" required value=""/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-mov">
										<label class="control-label col-sm-3">Minimum Order Value <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="mov" name="mov" required placeholder="Minimum Order Value"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-max_discount">
										<label class="control-label col-sm-3">Max Descount <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="max_discount" name="max_discount" required placeholder="Max Discount"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-avatar">
										<label class="control-label col-sm-3">Image <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="file" name="avatar" class="form-control" required>
										</div>
										<div class="col-sm-4">
										<h5 class="text-success"> </h5>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-status">
										<label class="control-label col-sm-3">Status <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="status" required>
												<option value="1">Active</option>
												<option value="0">Deactive</option>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="response"></div>
			<button type="submit" class="btn btn-success">Submit</button>
			<br> <br>
	
	</form>
</div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";

$(document).ready(function () {
  	$('#srest').hide();
   	var d = new Date();
   	var currMonth = d.getMonth();
    var currYear = d.getFullYear();
    var startDate = new Date(currYear,currMonth,d.getDate());
    $('#from_date').datepicker();
    $('#to_date').datepicker();
});

$("#zone_id").change(function () {
	var html = "<option value=''> Select Restaurant</option>";
 	$.get(base_url + "admin/restaurantoffers/getrestaurantbyzoneid", {zoneid: $("#zone_id").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + value.areaname+  " </option>" ;
  		});
        $('#restid').html(html);
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

