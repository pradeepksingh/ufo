<style>
<!--
.margin-bottom-5{
	margin-bottom: 5px;
}
-->
#map-canvas {
	
    width: 100%;
    height: 350px;
   
}
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">
<div id="page-wrapper">
  <div class="container-fluid">
	<div class="row">
       	<div class="col-lg-12">
        	<h3>Add Vendor</h3>
       	</div>
   	</div>
   	<form id="addrestaurant" name="addrestaurant" action="" method="post">
		<ul class="nav nav-tabs">
		  	<li class="active"><a data-toggle="tab" href="#basic">Basic Details</a></li>
		  	<li><a data-toggle="tab" href="#billing">Billing Settings</a></li>
		  	
		</ul>
		<div class="tab-content">
		  	<div id="basic" class="tab-pane fade in active">
		  		<div class="row">
	                <div class="col-lg-12">
	                    <div class="panel panel-default">
	                        <div class="panel-body">
	                          	<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Vendor Name <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="name" name="name"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
									<div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-landmark">
                                            <label class="control-label col-sm-5">Email <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="email" name="email"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>  
	                          	</div> 
								<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-landline_1">
                                            <label class="control-label col-sm-5">Mobile Number <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="mobile" name="mobile"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-landline_2">
                                            <label class="control-label col-sm-5">Landline </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="landline" name="landline"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	</div>
	                          	<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-address">
                                            <label class="control-label col-sm-5">Address <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <textarea class="form-control" rows="3" id="address" name="address"></textarea>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-pincode">
                                            <label class="control-label col-sm-5">Pincode</label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="pincode" name="pincode"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	</div>
	                      	</div>
	                  	</div>
	               	</div>
	        	</div>
		  	</div>
		  	<div id="billing" class="tab-pane fade">
		    	<div class="row">
	                <div class="col-lg-12">
	                    <div class="panel panel-default">
	                        <div class="panel-body">
	                          	<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-billing_cycle">
                                            <label class="control-label col-sm-5">Billing Cycle <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <select name="billing_cycle" id="billing_cycle" class="form-control" style="display:inline;width:48%;">
													<option value="">Select Billing Cycle</option>
													<option value="1">Weekly</option>
													<option value="2">Fortnightly</option>
													<option value="3">Monthly</option>
												</select>
												<input type="text" id="cycle_effective_date" name="cycle_effective_date" class="form-control" placeholder="Effective Date" style="display:inline;width:49%;"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-with_service_tax">
                                            <label class="control-label col-sm-5">Inclusive Service Tax </label>
                                            <div class="col-sm-10">
	                                            <select name="with_service_tax" id="with_service_tax" class="form-control">
													<option value="1">Yes</option>
													<option value="0">No</option>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	</div>
	                          	<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-payment_mode">
                                            <label class="control-label col-sm-5">Invoice Payment Mode </label>
                                            <div class="col-sm-10">
	                                            <select name="payment_mode" id="payment_mode" class="form-control">
													<option value="1">Online</option>
													<option value="2">Cheque</option>
													<option value="0">Cash</option>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
                                  	<div class="col-lg-6 margin-bottom-5">
                                     	<div class="form-group" id="error-company_name">
                                          	<label class="control-label col-sm-5">Billing Company Name </label>
                                           	<div class="col-sm-10">
                                             	<input type="text" class="form-control" id="company_name" name="company_name" value=""/>
                                          	</div>
                                           	<div class="messageContainer col-sm-10"></div>
                                      	</div>
                                  	</div>
                              	</div>
	                          	<div class="row">
                                  	<div class="col-lg-6 margin-bottom-5">
                                     	<div class="form-group" id="error-cheque-favour-of">
                                          	<label class="control-label col-sm-5">Cheque In Favour <span class='text-danger'>*</span></label>
                                           	<div class="col-sm-10">
                                              	<input type="text" class="form-control" id="cheque_favour_of" name="cheque_favour_of" value=""/>
                                           	</div>
                                          	<div class="messageContainer col-sm-10"></div>
                                       	</div>
                                  	</div>
                                    <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-account_name">
                                            <label class="control-label col-sm-5">Account Name <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="account_name" name="account_name"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	</div>
	                          	<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-account_number">
                                            <label class="control-label col-sm-5">Account Number </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="account_number" name="account_number"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          		<div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-bank_name">
                                            <label class="control-label col-sm-5">Bank Name </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="bank_name" name="bank_name"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	</div>
	                          	<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-branch_name">
                                            <label class="control-label col-sm-5">Branch Name </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="branch_name" name="branch_name"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-ifsc_code">
                                            <label class="control-label col-sm-5">IFSC Code </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                             </div>
                                <div class="row">
	                          		<div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-min_amount">
                                            <label class="control-label col-sm-5">Minimum Billing Amount </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="min_amount" name="min_amount"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                              	 <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-is_official">
                                            <label class="control-label col-sm-5">Is Official ? </label>
                                            <div class="col-sm-10">
	                                            <select name="is_official" id="is_official" class="form-control">
                                                        <option value="1">Official</option>
                                                        <option value="0">UnOfficial</option>
                                                </select>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	</div>
	                          	<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-hard_copy">
                                            <label class="control-label col-sm-5">Invoice Hardcopy Required ?</label>
                                            <div class="col-sm-10">
	                                            <select name="hard_copy" id="hard_copy" class="form-control">
													<option value="1">Yes</option>
													<option value="0">No</option>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-invoice_notify_mobile">
                                            <label class="control-label col-sm-5">Gateway Charge <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" id="gateway_charge" name="gateway_charge" class="form-control" placeholder="Gateway Charge" style="width:37%;display:inline;"/>
	                                            <input type="text" id="gateway_effective_date" name="gateway_effective_date" placeholder="Effective Date" class="form-control" style="width:60%;display:inline;"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	</div>
	                      	</div>
	                  	</div>
	               	</div>
	        	</div>
		  	</div>
		  <div id="geodiv" >
		  </div>
		  	
		  
		  	<div class="row">
					<div class="col-lg-12 margin-bottom-5 text-center">
					<div id="response"></div>
						<button type="submit" class="btn btn-success">Submit</button>
					</div>
			</div>
			
		  	<br>
		  	<br>
		</div>
	</form>
  </div>
</div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/selectize.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$(document).ready(function (){
	$("#map-canvas").hide();
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  var target = $(e.target).attr("href") // activated tab
		  if(target=="#delivery")
		  {
			  showGEO();
		  }
		  else
		  {
			  $("#map-canvas").hide();
		  }
		});
	
});
	
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=initMap&key=AIzaSyCH-u-UD2bz6cfPEAe8mCVyrnnI7ONx9ro");
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$('#cycle_effective_date').datepicker().on('changeDate', function(ev){
	$('#addrestaurant').bootstrapValidator('revalidateField', 'cycle_effective_date');
});
$('#gateway_effective_date').datepicker().on('changeDate', function(ev){
	$('#addrestaurant').bootstrapValidator('revalidateField', 'gateway_effective_date');
});
/* $('#trial_start_date').datepicker().on('changeDate', function(ev){
	$('#addrestaurant').bootstrapValidator('revalidateField', 'trial_start_date');
});
$('#trial_end_date').datepicker().on('changeDate', function(ev){
	$('#addrestaurant').bootstrapValidator('revalidateField', 'trial_end_date');
});  */
$('.resttime').timepicker();
var cuisine = $("#cuisines").selectize({
    plugins: ['remove_button'],
    delimiter: ',',
    persist: false,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
});

/*cuisine.on('change', function() {
	$('#addrestaurant').bootstrapValidator('revalidateField', 'cuisines[]');
});
*/

function initMap() {
	var options = {
	  	componentRestrictions: {country: 'in'}
	};
	var input =  document.getElementById('locality');
	var autocomplete = new google.maps.places.Autocomplete(input,options);
	autocomplete.addListener('place_changed', function() {
		var place = autocomplete.getPlace();
	    if (!place.geometry) {
	      window.alert("Autocomplete's returned place contains no geometry");
	      return;
	    }
	    $('#latitude').val(place.geometry.location.lat());
	    $('#longitude').val(place.geometry.location.lng());
		$('#addrestaurant').bootstrapValidator('revalidateField', 'locality');
		$('#addrestaurant').bootstrapValidator('revalidateField', 'latitude');
		$('#addrestaurant').bootstrapValidator('revalidateField', 'longitude');
		
	});
}
// Code BY Rohit GEO FANCY
/*
var bermudaTriangle;
var lat,long;
var jsonArr = [];
function successFunction(lat,long1,radius) 
{
	
    $('#lat').val(lat);
    $('#long').val(long1);
	var myLatLng = new google.maps.LatLng(lat, long1);
    var mapOptions = {
        zoom: 12,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.RoadMap
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'),
                                  mapOptions);
	var triangleCoords= getFences( parseFloat(lat),parseFloat(long1),radius);
    var triangleCoords1 = [];
	
    // Construct the polygon
    bermudaTriangle = new google.maps.Polygon({
        paths: triangleCoords,
        draggable: false,
        editable: true,
        strokeColor: '#0055ff',
        strokeOpacity: 0.3,
        strokeWeight: 3,
        fillColor: '#0055ff',
        fillOpacity: 0.35
    });

    bermudaTriangle.setMap(map);
    getPolygonCoords();
    google.maps.event.addListener(bermudaTriangle, "dragend", getPolygonCoords);
    google.maps.event.addListener(bermudaTriangle.getPath(), "insert_at", getPolygonCoords);
    google.maps.event.addListener(bermudaTriangle.getPath(), "remove_at", getPolygonCoords);
    google.maps.event.addListener(bermudaTriangle.getPath(), "set_at", getPolygonCoords);
}




function getPolygonCoords() {
    var len = bermudaTriangle.getPath().getLength();
	var str='';
	for (var i = 0; i < len; i++) {
    jsonArr.push({
        id: bermudaTriangle.getPath().getAt(i).toUrlValue(5)
    });
	str=str+'<input type="hidden" value="'+ bermudaTriangle.getPath().getAt(i).toUrlValue(5)+'" name="latlong[]">';
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
}*/
$("#cityid").change(function(){
	$.get(base_url+"admin/general/localities",{cityid: $("#cityid").val()},function(data){
		var html = "<option value=''>Select Area</option>";
		$.each( data, function( key, value ) {
		    html = html + "<option value='"+value.id+"'>"+value.name+"</option>";
		});	
		$("#areaid").html(html);
	},'json');
});

$("#is_trial").change(function(){
	if($(this).val() == 1) {
		$("#trial_dates").show();
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_start_date', true);
                $('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_end_date', true);
	} else {
		$("#trial_dates").hide();
		$('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_start_date', false);
                $('#addrestaurant').bootstrapValidator('enableFieldValidators', 'trial_end_date', false);
	}
});

$('#addrestaurant').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
  		/* cityid: {
            validators: {
                notEmpty: {
                    message: 'City is required and cannot be empty'
                },
                integer: {
                    message: 'Invalid City.'
           		}
            }
        }, 
        areaid: {
            validators: {
                notEmpty: {
                    message: 'Area is required and cannot be empty'
                },
                integer: {
                    message: 'Invalid Area.'
           		}
            }
        }, */
		email: {
			validators: {
				notEmpty: {
					message: 'Email is required and cannot be empty'
				},
				regexp: {
					regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
					message: 'The value is not a valid email address'
				}	
			}
		},
		mobile: {
			validators: {
				notEmpty: {
					message: 'Mobile is required and cannot be empty'
				},
				regexp: {
					regexp: '^[7-9][0-9]{9}$',
					message: 'Invalid Mobile Number'
				}
			}
		},
        name: {
            validators: {
                notEmpty: {
                    message: 'Vendor Name is required and cannot be empty'
                }
            }
        },
        address: {
            validators: {
                notEmpty: {
                    message: 'Address is required and cannot be empty'
                }
            }
        },
      /*  locality: {
            validators: {
                notEmpty: {
                    message: 'Locality is required and cannot be empty'
                }
            }
        },
        latitude: {
            validators: {
                notEmpty: {
                    message: 'Latitude is required and cannot be empty'
                }
            }
        },
        longitude: {
            validators: {
                notEmpty: {
                    message: 'Longitude is required and cannot be empty'
                }
            }
        },
        radius: {
            validators: {
                notEmpty: {
                    message: 'Delivery radius is required and cannot be empty'
                },
                integer: {
                    message: 'Invalid Radius.'
           		},
           		stringLength: {
                    max: 6,
                    min: 3,
                    message: 'Invalid Radius.'
                },
            }
        }, */
        pincode: {
            validators: {
                integer: {
                    message: 'Invalid pincode.'
           		},
           		stringLength: {
                    max: 6,
                    min: 6,
                    message: 'Invalid pincode.'
                },
            }
        },
        /*'cuisines[]': {
            validators: {
                notEmpty: {
                    message: 'Cuisine is required and cannot be empty'
                }
            }
        },*/
       /* tax: {
            validators: {
                numeric: {
                    message: 'Invalid Tax.',
                    decimalSeparator: '.'
           		}
            }
        },
        mstart_time:{
        	enabled: false,
            validators:{
	            notEmpty:{
	            	message: 'Morning start time is required and cannot be empty'
	            },
	            regex: {
                    regex: /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/,
                    message: 'Morning start time is not a valid'
                }
            }
        },
        mclose_time:{
        	enabled: false,
            validators:{
	            notEmpty:{
	            	message: 'Morning close time is required and cannot be empty'
	            },
	            regex: {
                    regex: /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/,
                    message: 'Morning close time is not a valid'
                }
            }
        },
        estart_time:{
        	enabled: false,
            validators:{
	            notEmpty:{
	            	message: 'Evening start time is required and cannot be empty'
	            },
	            regex: {
                    regex: /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/,
                    message: 'Evening start time is not a valid'
                }
            }
        },
        eclose_time:{
        	enabled: false,
            validators:{
	            notEmpty:{
	            	message: 'Evening close time is required and cannot be empty'
	            },
	            regex: {
                    regex: /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/,
                    message: 'Evening close time is not a valid'
                }
            }
        },*/
        billing_cycle: {
            validators: {
                notEmpty: {
                    message: 'Billing cycle is required and cannot be empty'
                }
            }
        },
        cycle_effective_date: {
            validators: {
                notEmpty: {
                    message: 'Effective cycle date is required'
                },
                date: {
                    format: 'DD-MM-YYYY',
                    message: 'Effective cycle date is not a valid'
                }
            }
        },
        account_name: {
            validators: {
                notEmpty: {
                    message: 'Account Name is required and cannot be empty'
                }
            }
        },
        /*gateway_charge: {
            validators: {
                notEmpty: {
                    message: 'Gateway charge is required and cannot be empty'
                },
            }
        },
        gateway_effective_date: {
            validators: {
                notEmpty: {
                    message: 'Effective gateway charge date is required'
                },
                date: {
                    format: 'DD-MM-YYYY',
                    message: 'Effective gateway charge date is not a valid'
                }
            }
        },
        trial_start_date: {
        	enabled: false,
            validators: {
                notEmpty: {
                    message: 'Trial start date is required'
                },
                date: {
                    format: 'DD-MM-YYYY',
                    message: 'Trial start date is not a valid'
                }
            }
        },
        trial_end_date: {
        	enabled: false,
            validators: {
                notEmpty: {
                    message: 'Trial end date is required'
                },
                date: {
                    format: 'DD-MM-YYYY',
                    message: 'Trial end date is not a valid'
                }
            }
        },*/
       /* logo: {
            validators: {
                notEmpty: {
                    message: 'The vendor Logo is required and cannot be empty'
                },
                file: {
                    extension: 'jpeg,jpg,png,gif',
                    type: 'image/jpeg,image/png,image/gif,image/jpg',
                    maxSize: 2097152,   // 2048 * 1024
                    message: 'The selected file is not valid'
                }
            }
        },*/
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addRestaurant();
});

function addRestaurant() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/vendor/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addrestaurant').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.msg.name);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        window.location.href = base_url+"admin/vendor/list";
  	}
}

function addMoreSlabs() {
	var slabcount = parseInt($("#slabcount").val());
	slabcount++;
	var slab_html = '<tr id="slabrow'+slabcount+'">'+
					'<td><input type="text" name="lower_limit[]" class="form-control" placeholder="From Amount"/></td>'+
					'<td><input type="text" name="upper_limit[]" class="form-control" placeholder="To Amount"/></td>'+
					'<td><input type="text" name="from_rad[]" class="form-control" placeholder="From Radius"/></td>'+
					'<td><input type="text" name="to_rad[]" class="form-control" placeholder="To Radius"/></td>'+
					'<td><input type="text" name="charge[]" class="form-control" placeholder="Delivery Charge"/></td>'+
					'<td><a href="javascript:deleteSlab('+slabcount+');" class="btn btn-danger btn-sm">X</a></td>'+
					'</tr>';
	$("#del_slabs").append(slab_html);
	$("#slabcount").val(slabcount);
}

function deleteSlab(id){
	var slabcount = parseInt($("#slabcount").val());
	slabcount = slabcount - 1;
	$("#slabrow"+id).remove();
	$("#slabcount").val(slabcount);
}

function addMoreDelTime() {
	var timecount = parseInt($("#timecount").val());
	timecount++;
	var slab_html = '<tr id="timeslabrad'+timecount+'">'+
					'<td colspan=3><input type="text" name="from_time_rad[]" class="form-control" placeholder="From Radius"/></td>'+
					'<td colspan=3><input type="text" name="to_time_rad[]" class="form-control" placeholder="To Radius"/></td>'+
					'<td class="text-center"><a href="javascript:deleteDelTime('+timecount+');" class="btn btn-danger btn-sm">X</a></td>'+
				'</tr>'+
				'<tr id="timeslabtime'+timecount+'">'+
					'<td><input type="text" name="mon[]" class="form-control" placeholder="Monday"/></td>'+
					'<td><input type="text" name="tue[]" class="form-control" placeholder="Tuesday"/></td>'+
					'<td><input type="text" name="wed[]" class="form-control" placeholder="Wednesday"/></td>'+
					'<td><input type="text" name="thu[]" class="form-control" placeholder="Thursday"/></td>'+
					'<td><input type="text" name="fri[]" class="form-control" placeholder="Friday"/></td>'+
					'<td><input type="text" name="sat[]" class="form-control" placeholder="Saturday"/></td>'+
					'<td><input type="text" name="sun[]" class="form-control" placeholder="Sunday"/></td>'+
				'</tr>';
	$("#del_time").append(slab_html);
	$("#timecount").val(timecount);
}

function deleteDelTime(id){
	var timecount = parseInt($("#timecount").val());
	timecount = timecount - 1;
	$("#timeslabrad"+id).remove();
	$("#timeslabtime"+id).remove();
	$("#timecount").val(timecount);
}

function addMoreMov() {
	var movcount = parseInt($("#movcount").val());
	movcount++;
	var slab_html = '<tr id="movrow'+movcount+'">'+
					'<td><input type="text" name="from_mov_rad[]" class="form-control" placeholder="From Radius"/></td>'+
					'<td><input type="text" name="to_mov_rad[]" class="form-control" placeholder="To Radius"/></td>'+
					'<td><input type="text" name="amount[]" class="form-control" placeholder="MOV"/></td>'+
					'<td><a href="javascript:deleteMov('+movcount+');" class="btn btn-danger btn-sm">X</a></td>'+
					'</tr>';
	$("#del_mov").append(slab_html);
	$("#movcount").val(movcount);
}

function deleteMov(id){
	var movcount = parseInt($("#movcount").val());
	movcount = movcount - 1;
	$("#movrow"+id).remove();
	$("#movcount").val(movcount);
}
$("#cboCustomTime").change(function(){
        
      showCustomTime();
        
    });
    
    function showCustomTime(){
         if($("#cboCustomTime").val() == 1){
           $("#divCustomT").show();
           $("#divRegularT").hide();
        }else{
           $("#divCustomT").hide();
           $("#divRegularT").show();   
        }
    }
    function showGEO()
    {
        $("#map-canvas").show();
        successFunction($('#latitude').val(),$('#longitude').val(),$('#radius').val());
    }
</script>