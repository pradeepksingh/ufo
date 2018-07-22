<!--  Edit Restaurant -->
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
			<h3>Update Offer</h3>
		</div>
	</div>
	<form id="addcity" action="<?php echo base_url();?>admin/restaurantoffers/update" method="post" enctype='multipart/form-data'>
		<div id="basic" class="tab-pane fade in active">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
					<div class="panel-heading">Update Offer</div>
						<div class="panel-body">
						<?php foreach ($offer as $item){?>
						<input type="hidden" name="id" value="<?php echo $item['id'];?>">
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
									<div class="form-group" id="error-title">
										<label class="control-label col-sm-3">Title <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="title" name="title" value ="<?php echo $item['title'];?>" required />
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-description">
										<label class="control-label col-sm-3">Description <span
											class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<textarea rows="7" class="form-control" name="description" id="description" required><?php echo $item['description'];?></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        <div class="form-group" id="error-from_date">
                                            <label class="control-label col-sm-3">From Date <span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="from_date" name="from_date" value ="<?php echo date('d-m-Y',strtotime($item['from_date']));?>" required />
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
                                                <input type="text" class="form-control" id="to_date" name="to_date" value ="<?php echo date('d-m-Y',strtotime($item['to_date']));?>" required />
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
											<select class="form-control" id="discount_type" name="discount_type" required>
												<?php if($item['discount_type']==1) { ?>
												<option value="1" selected>Percentage</option>
												<option value="2">Flat</option>
												<?php } else { ?>
												<option value="1" >Percentage</option>
												<option value="2" selected>Flat</option>
												<?php } ?>
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
												<option value="0" <?php if($item['payment_mode'] == 0) { ?>selected<?php } ?>> Both</option>
												<option value="1" <?php if($item['payment_mode'] == 1) { ?>selected<?php } ?>> Online</option>
												<option value="2" <?php if($item['payment_mode'] == 2) { ?>selected<?php } ?>> COD</option>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row" style="display:none;">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-discount_by_zk">
										<label class="control-label col-sm-3">Descount By ZYK <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											  <input type="text" class="form-control" id="discount_by_zk" name="descount_by_zk" required value="<?php echo $item['discount_by_zk'];?>"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-discount_by_rest">
										<label class="control-label col-sm-3">Descount By Restaurant<span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											  <input type="text" class="form-control" id="discount_by_rest" name="descount_by_rest" required value="<?php echo $item['discount_by_rest'];?>"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-max_discount">
										<label class="control-label col-sm-3">Minimum Order Value <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="mov" name="mov" value="<?php echo $item['mov'];?>" required placeholder="Minimum Order Value"/>
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
											<input type="text" class="form-control" id="max_discount" name="max_discount" value="<?php echo $item['max_discount'];?>" required placeholder="Max Discount"/>
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
											<input type="file" name="avatar" class="form-control" >
										</div>
										
									</div>
								</div>
							</div>
							<div class="col-sm-4" style="position:absolute;left:70%;top:400px">
								<img src="<?php echo asset_url();?><?php echo $item['image'];?>" style="height:200px;width:250px"/>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-status">
										<label class="control-label col-sm-3">Status <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select class="form-control" name="status" required>
												<?php if($item['status']==1){?>
												<option value="1" selected> Active</option>
												<option value="0"> Deactive</option>
												<?php } else {?>
												<option value="1" > Active</option>
												<option value="0" selected> Deactive</option>
												<?php }?>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="fenceid" value=""/>
			<div id="geodiv" >
			
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
$(document).ready(function (){
	$("#map-canvas").hide();
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  var target = $(e.target).attr("href") // activated tab
		  if(target=="#delivery")
		  {
			  lati= value.latitude;
				longi= value.longitude;
				$.get(base_url + "admin/restaurant/getgeofance/"+$("#restid").val(), {}, function (data) {
					$.each(data, function (key, value) {
						$('#fenceid').val(value.fenceid);
			       	});
				}, 'json');
			  showGEO(lati,longi,value.fence_pos);
		  }
		  else
		  {
			  $("#map-canvas").hide();
		  }
		});
	
});
	
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=AIzaSyCH-u-UD2bz6cfPEAe8mCVyrnnI7ONx9ro");
var bermudaTriangle;
var lat,long;
var jsonArr = [];
function successFunction(lat,lon,pos) 
{
$('#lat').val(lat);
$('#long').val(lon);
var myLatLng = new google.maps.LatLng(parseFloat(lat), parseFloat(lon));
var mapOptions = {
    zoom: 12,
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.RoadMap
};
var map = new google.maps.Map(document.getElementById('map-canvas'),
                              mapOptions);
//var triangleCoords= getFences( parseFloat(lat),parseFloat(lon));
var triangleCoords1 = [];
var i=0;

var json = JSON.parse(pos);
$.each(json, function (key, value) {
    
	//triangleCoords1.push([parseFloat(value.latitude),parseFloat(value.longitude)]);
	 triangleCoords1.push({lat:parseFloat(value.latitude),lng:parseFloat(value.longitude)});
	
    	});

              	
// Construct the polygon
bermudaTriangle = new google.maps.Polygon({
    paths: triangleCoords1,
    draggable: false,
    editable: true,
    strokeColor: '#FF0000',
    strokeOpacity: 0.3,
    strokeWeight: 3,
    fillColor: '#FF0000',
    fillOpacity: 0.35
});


bermudaTriangle.setMap(map);
google.maps.event.addListener(bermudaTriangle, "dragend", getPolygonCoords);
google.maps.event.addListener(bermudaTriangle.getPath(), "insert_at", getPolygonCoords);
google.maps.event.addListener(bermudaTriangle.getPath(), "remove_at", getPolygonCoords);
google.maps.event.addListener(bermudaTriangle.getPath(), "set_at", getPolygonCoords);

var myLatLng = {lat: parseFloat(lat), lng: parseFloat(lon)};
	var contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
        '<div id="bodyContent">'+
        '<p>Singh shahab da bargar' +
        'Heritage Site.</p>'+
        '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
        'Order</a> '+
        '</div>'+
        '</div>';
    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Hello World!',
      center:myLatLng
    });
	marker.addListener('click', function() {
      infowindow.open(map, marker);
    });
}
function getPolygonCoords() {
    var len = bermudaTriangle.getPath().getLength();
	var str='';
	for (var i = 0; i < len; i++) {
    jsonArr.push({
        id: bermudaTriangle.getPath().getAt(i).toUrlValue(5)
    });
	str=str+'<input type="text" value="'+ bermudaTriangle.getPath().getAt(i).toUrlValue(5)+'" name="latlong[]">';
	}
	$('#geodiv').html(str);
	//console.log(jsonArr);
}

function errorFunction(position) 
{
    alert('Error!');
}

function getFences(lat,lng,radius){
var d2r = Math.PI / 180;
var r2d = 180 / Math.PI;
var earthsradius = 6371000;
  var points = 8;
   var radius = radius;
   var rlat = (radius / earthsradius) * r2d;
   var rlng = rlat / Math.cos(lat * d2r);
   var extp = new Array();
   for (var i=0; i < points+1; i++)
   {
      var theta = Math.PI * (i / (points/2));
      ex = lng + (rlng * Math.cos(theta));
      ey = lat + (rlat * Math.sin(theta));
      extp.push(new google.maps.LatLng(ey, ex));
   }
return extp;
}
function showGEO()
{
    $("#map-canvas").show();
    successFunction($('#latitude').val(),$('#longitude').val(),$('#radius').val());
}
</script>

