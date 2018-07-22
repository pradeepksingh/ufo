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
			<h3>Add Offer</h3>
		</div>
	</div>
	<form id="addcity" action="saveoffer" method="post" enctype='multipart/form-data'>
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
										<div class="form-group" id="error-restid">
											<label class="control-label col-sm-3">Offer Type <span class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<input type ="radio" name="offer_type" value="0" class="position-type-regular" checked> Regrural</input>
												<input type ="radio" name="offer_type" value="1" class="position-type-home" > Home </input>
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
												<input type ="radio" name="position" value="0" checked> Left</input>
												<input type ="radio" name="position" value="1" > Right </input>
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
												<input type="text" class="form-control" id="title" name="title"  />
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label col-sm-3">Description <span
												class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<textarea rows="7" class="form-control" name="description"></textarea>
											</div>
											<div class="messageContainer col-sm-4">
											<h4> Copy Description Code</h4>
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
												<input type="text" class="form-control" id="coupon_code" name="coupon_code" />
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
	
												<input type="text" class="form-control" id="url" name="url" />
											</div>
	
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label col-sm-3">Image <span class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<input type="file" name="avatar" class="form-control">
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
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label col-sm-3">Status <span
												class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<select class="form-control" name="status">
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






</script>

<script src="<?php echo asset_url();?>js/selectize.min.js"></script>
<script src="<?php echo asset_url();?>js/ckeditor/ckeditor.js"></script>

<link type="text/css" rel="stylesheet"
	href="<?php echo asset_url();?>css/selectize.bootstrap3.css">




<script type="text/javascript">


function brandType()
{
    $('#item').html(" ");
    $('#restt').val("");
   
    
    
}
	
	
</script>
<script>
function myFunction()
{ $('#item').html(" ");
    $('#list').html(" ");
    var html="";   
    var i=0;
      $.get( base_url + "admin/brand/getallrest" , {item: $('#restt').val()}, function (data) {                                                          
    	$.each(data, function (key, value) {
	       i++;
	         html=html+ "<label class='checkbox-inline' > <input type='checkbox' style='width=50%' name='search' value='" + value.id + "' onclick='addlist("+ value.id +",`" + value.name + "`)'>" + value.name + "</label>";
	        if(i==2)
                {
                   html=html+'<br/>' ;
                   i=0;
                }
 		});
                 $('#item').html(html);
    }, 'json');
}
function addlist(id,name)
{
    $('#hi').show();
    var html= "<label class='checkbox-inline' > <input type='checkbox' style='width=50%' checked name='searchlist[]' id='" + id + "' value='" + id + "'>" + name + "</label>";
    $('#list').append(html);
}
$(document).ready(function()
{
      $('#hi').hide();
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
