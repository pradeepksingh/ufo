
<style>
<!--
.btn-plus {
	margin: 5px 0px;
}
-->
</style>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">
<div id="page-wrapper" >
	<div class="row" >
	<h3><i>Promote Banner</i></h3>
		<div class="col-lg-12" style="margin-top:20px">
			<div class="panel panel-default">
				<div class="panel-heading">Promote Banner</div>
				<div class="panel-body">
					<form action='addpromotebanner'>
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select Zone <span
										class='text-danger'>*</span></label>
									<div class="col-sm-5">
											<select class="form-control" id="zone_id" name="zone_id" required>
											<option value=''> Select Zone</option>
												<?php foreach ($zones as $item){?>
												<option value='<?php echo $item['id']?>'> <?php echo $item['name'];?> </option>
												<?php }?>
											</select>
										</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select Restaurants <span
										class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="rest" name="rest">
											<option value="">select restaurants</option>
											<?php foreach ($rest as $item){?>

											<option value="<?php echo $item['id'];?>"> <?php echo $item['name'];?></option>
											<?php }?>
										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3"> Date Range <span
										class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<input type="text" id="start_date" name="start_date" class="form-control" placeholder="Start Date" style="display:inline;width:49%;" required/>
										<input type="text" id="end_date" name="end_date" class="form-control" placeholder="End Date" style="display:inline;width:49%;" required/>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select Priority <span
										class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="priority" name="priority">
											<option value="">select priority</option>
											<option value="0">0</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select Status <span
										class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="status" name="status">
											<option value="1">Active</option>
											<option value="0">Deactive</option>

										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 margin-bottom-5">
							<label class="control-label col-sm-3"> <span
										class='text-danger'></span></label>
								<div class="col-sm-5" style="text-align:right">
								<div class="form-group" id="error-name">
										<input type="submit" class="btn btn-primary" value="Submit" />
								</div>
								</div>
								
							</div>
						</div>
				
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";

$(function() {
    $("#start_date").datepicker({
        dateFormat: "yy-mm-dd"
    }).datepicker("setDate", "0");
    $("#end_date").datepicker({
        dateFormat: "yy-mm-dd"
    }).datepicker("setDate", "0");    // Here the current date is set
});
 </script>