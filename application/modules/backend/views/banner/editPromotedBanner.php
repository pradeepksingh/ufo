
<style>
<!--
.btn-plus {
	margin: 5px 0px;
}
-->
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">
<div id="page-wrapper">
	<div class="row">
	<h3><i> Edit Promote Banner</i></h3>
		<div class="col-lg-12">
			<div class="panel panel-default">
			 <div class="panel-heading">Promote Banner </div>
				<div class="panel-body">
				<?php foreach ($banner as $items){?>
			
				<form action='updatepromotedbanner' id="add">
					<input type="hidden" value="<?php echo $items['id']?>" name="id">
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select Zone <span
										class='text-danger'>*</span></label>
									<div class="col-sm-5">
											<select class="form-control" id="zone_id" name="zone_id" required>
											<option value=''> Select Zone</option>
												<?php foreach ($zones as $item1){?>
												<option value='<?php echo $item1['id']?>' <?php if($items['zone_id']==$item1['id']){echo 'selected';}?>> <?php echo $item1['name'];?> </option>
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
											<?php foreach ($rest as $item2){?>

											<option value="<?php echo $item2['id'];?>" <?php if($items['rest_id']==$item2['id']){echo 'selected';}?>> <?php echo $item2['name'];?></option>
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
									<label class="control-label col-sm-3">Start Date <span
										class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<input type="text" id="start_date" name="start_date" class="form-control" placeholder="Start Date" value="<?php echo date('d-m-Y',strtotime($items['start_date']));?>" style="display:inline;width:49%;" required/>
										<input type="text" id="end_date" name="end_date" class="form-control" placeholder="End Date" value="<?php echo date('d-m-Y',strtotime($items['end_date']));?>" style="display:inline;width:49%;" required/>
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
										<?php for($i=0;$i<10;$i++){?>
										<option value="<?php echo $i;?>" <?php if($items['priority']==$i){echo 'selected';}?>> <?php echo $i;?></option>
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
									<label class="control-label col-sm-3">Select Status <span
										class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="status" name="status">
											<option value="1"  <?php if($items['status']==1){echo 'selected';}?>>Active</option>
											<option value="0" <?php if($items['status']==0){echo 'selected';}?>>Deactive</option>

										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
						
						<div class="row" style="margin-top: 5px">
							<div class="col-lg-12 margin-bottom-5">
							<div class="col-sm-7"></div>
								<div class="form-group" id="error-name" >
										<input type="submit" class="btn btn-primary" value="Submit" />
								</div>
							</div>
						</div>
				
					</div>
				</form>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";

$('#start_date').datepicker().on('changeDate', function (ev) {
 	$('#addrestaurant').bootstrapValidator('revalidateField', 'start_date');
});
$('#end_date').datepicker().on('changeDate', function (ev) {
    $('#addrestaurant').bootstrapValidator('revalidateField', 'end_date');
});

 </script>