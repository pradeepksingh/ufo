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
			<h3>Update Locality</h3>
		</div>
	</div>
	<form id="editlocality" name="editlocality" action="" method="post">
		<input type="hidden" name="id" value="<?php echo $locality[0]['id'];?>"/>
		<div id="basic" class="tab-pane fade in active">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<!--<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<select name="cityid" id="cityid" class="form-control">
												<option value=""> Select City </option>
												<?php foreach ($cities as $city) { ?>
												<option value="<?php echo $city['id'];?>" <?php if($city['id'] == $locality[0]['cityid']) {?>selected<?php }?>><?php echo $city['name'];?></option>
												<?php } ?>
											</select>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>-->
							<div class="row">
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Locality Name <span class='text-danger'>*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="name" name="name" value="<?php echo $locality[0]['name'];?>"/>
										</div>
										<div class="messageContainer col-sm-10"></div>
									</div>
								</div>
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Pincode <span class='text-danger'>*</span></label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="pincode" name="pincode" maxlength="6" value="<?php echo $locality[0]['pincode'];?>"/>
										</div>
										<div class="messageContainer col-sm-10"></div>
									</div>
								</div>
							</div>
							<!-- <div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Type Locality </label>
										<div class="col-sm-5">
											<input type="text" class="form-control" id="locality" name="locality" autocomplete="off" value="<?php echo $locality[0]['name'];?>"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Latitude <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="latitude" id="latitude" value="<?php echo $locality[0]['latitude'];?>"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 margin-bottom-5">
									<div class="form-group" id="error-name">
										<label class="control-label col-sm-3">Longitude <span class='text-danger'>*</span></label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo $locality[0]['longitude'];?>"/>
										</div>
										<div class="messageContainer col-sm-4"></div>
									</div>
								</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="text-center">
			<div id="response"></div>
			<button type="submit" class="btn btn-success">Update</button>
		</div>
	</form>
</div>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?php echo $google_api_key;?>&callback=initMap");
function initMap() {
	var options = {
		types: ["geocode"],
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
		$('#editlocality').bootstrapValidator('revalidateField', 'latitude');
		$('#editlocality').bootstrapValidator('revalidateField', 'longitude');
	});
}
$('#editlocality').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	/*cityid: {
            validators: {
                notEmpty: {
                    message: 'City Name is required and cannot be empty'
                }
            }
        },*/
        name: {
            validators: {
                notEmpty: {
                    message: 'Locality Name is required and cannot be empty'
                }
            }
        },
        pincode: {
            validators: {
                notEmpty: {
                    message: 'Pincode is required and cannot be empty'
                }
            }
        }
        /* latitude: {
            validators: {
                notEmpty: {
                    message: 'Latitude is required and cannot be empty'
                },
                numeric: {
                    message: 'Invalid Latitude',
                    thousandsSeparator: '',
                    decimalSeparator: '.'
                }
            }
        },
        longitude: {
            validators: {
                notEmpty: {
                    message: 'Longitude is required and cannot be empty'
                },
                numeric: {
                    message: 'Invalid Longitude',
                    thousandsSeparator: '',
                    decimalSeparator: '.'
                }
            }
        } */
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateLocality();
});

function updateLocality() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/general/updatelocality',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#editlocality').ajaxSubmit(options);
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
        alert(resp.msg);
        window.location.href = base_url+"admin/general/localitylist/";
  	}
}


</script>