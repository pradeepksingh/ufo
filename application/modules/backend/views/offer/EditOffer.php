<script src="<?php echo asset_url();?>js/jscolor.js"></script>
<style>
<!--
.margin-bottom-5 {
	margin-bottom: 5px;
}
-->
</style>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3>Edit Offer</h3>
		</div>
	</div>
	<form id="addcity" action="updateoffer" method="post" enctype='multipart/form-data'>
		<div id="basic" class="tab-pane fade in active">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
					<div class="panel-heading">Edit Offer</div>
						<div class="panel-body">
						<?php foreach ($offer as $item){?>
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-cityid">
									<label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="cityid" name="cityid" >
											<option value=""> select city</option>
											<?php foreach ($cities as $item1){?>
											<option value="<?php echo $item1['id']?>" <?php if($item['cityid'] == $item1['id']) { ?>selected<?php } ?>><?php echo $item1['name']?></option>
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
											<option> Select Zone</option>
											<?php foreach ($zones as $zone) { ?>
											<option value="<?php echo $zone['id'];?>" <?php if($zone['id'] == $item['zone_id']) { ?>selected<?php } ?>><?php echo $zone['name'];?></option>
											<?php } ?>
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
												<option> Select Restaurant</option>
												<?php foreach ($restaurants as $restaurant) { ?>
												<option value="<?php echo $restaurant['id'];?>" <?php if($restaurant['id'] == $item['restid']) { ?>selected<?php } ?>><?php echo $restaurant['name'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-restid">
										<label class="control-label col-sm-3">Offer Type <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type ="radio" name="offer_type" value="0" class="position-type-regular" <?php if($item['offer_type']==0) {?> checked<?php } ?>> Regrural</input>
											<input type ="radio" name="offer_type" value="1" class="position-type-home" <?php if($item['offer_type']==1) {?> checked<?php } ?> > Home </input>
										</div>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
							<div class="row" id="position">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-restid">
										<label class="control-label col-sm-3">Position  <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type ="radio" name="position" value="0" <?php if($item['position']==0) {?> checked<?php } ?>> Left</input>
											<input type ="radio" name="position" value="1" <?php if($item['position']==1) {?> checked<?php } ?> > Right </input>
										</div>
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Title <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" value="<?php echo $item['title']?>" id="title" name="title" required />
											<input type="hidden" value="<?php echo $item['id'];?>" name="id"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="messageContainer col-sm-4" style="position:absolute;200px;height:200px;left:65%;top:200px">
								<img src="<?php echo asset_url();?><?php echo $item['avatar']?>" style="200px;height:200px" alt="">
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Description <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<textarea rows="7" class="form-control" name="description"><?php echo $item['description']?></textarea>
										</div>
										<div class="messageContainer col-sm-4">
										<blockquote> <code>
										&lt;li&gt; Coupon Code : ZYK &lt;/li&gt;
										&lt;li&gt; Location    : ZYK &lt;/li&gt;
										&lt;li&gt; Discount    : 150 &lt;/li&gt;
										 </code></blockquote> 
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Coupon Code</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="coupon_code" name="coupon_code" value="<?php echo $item['coupon_code'];?>" />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3"> Url <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="url" name="url" value="<?php echo $item['url']?>" />
										</div>

									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Image <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="file" class="form-control" id="avatar1" name="avatar1" />
										</div>
										<div class="col-sm-4">
										<h5 class="text-success"> Size <b>Offer page:</b> (357*241) <b>home Left:</b>(750*350) <b>home right:</b>(288*292) </h5>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Priority <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="priority">
												<?php for($i=0;$i<10;$i++){?>
												<option value="<?php echo $i;?>" <?php if($item['priority']==$i){echo "selected";}?>> <?php echo $i;?></option>
												<?php }?>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Status <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="status">
												<option value="1" <?php if($item['status']==1){ echo "selected"; }?>> Active</option>
												<option value="0" <?php if($item['status']==0){ echo "selected"; }?>>Deactive</option>
												</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
			</div>

			<div id="response"></div>
			<button type="submit" class="btn btn-success">Submit</button>
			<br> <br>
	
	</form>
</div>
<script>
$("#zone_id").change(function () {
	var html = "";
 	$.get(base_url + "admin/restaurantoffers/getrestaurantbyzoneid", {zoneid: $("#zone_id").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + " </option>" ;
  		});
        $('#rest_id').html(html);
 	},'json');
});

$("#cityid").change(function () {
	var html = "";
 	$.get(base_url + "admin/banner/getzonebycityid", {cityid: $("#cityid").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + " </option>" ;
  		});
        $('#zone_id').html(html);
 		
  	},'json');
});
$(document).ready(function() {
	var restid = <?php echo $offer[0]['restid'];?>;
	var html = "";
 	$.get(base_url + "admin/banner/getrestbycityid", {cityid: 1}, function (data) {
 		$.each(data, function (key, value) {
 	 		if(value.id == restid)
 	 		{
 	 			html=html+ "<option value='" + value.id + "' selected> " + value.name + " </option>" ;
 	 		}
 	         html=html+ "<option value='" + value.id + "'> " + value.name + " </option>" ;
  		});
        $('#rest_id').html(html);
  	},'json');
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	 if($('input[value="0"]').prop("checked")){
         $("#position").hide();
     }
    
    $('.position-type-regular').click(function(){
            $("#position").hide();
    });
    $('.position-type-home').click(function(){
        $("#position").show(); 
	});
});
</script>
