<link rel="stylesheet" href="<?php echo asset_url();?>css/pages/profile.css">
<div class="container signup-area" style="background-color:#f8f8f8;width:100%;margin-top:75px;">
	<div class="row">
		<div class="col-lg-3" style="padding:0px;">
			<div class="side-menu">
			    <nav class="navbar navbar-default" role="navigation" style="background-color: #f8f8f8 !important;padding-top: 0px;">
				    <div class="navbar-header">
				        <div class="brand-wrapper">
				            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#profile-bar">
				                <span class="sr-only">Toggle navigation</span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				            </button>
				        </div>
				    </div>
				    <div class="collapse navbar-collapse side-menu-container" id="profile-bar">
				        <ul class="nav navbar-nav">
				            <li class="active"><a href="<?php echo base_url();?>user/profile"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
				            <li class="active on"><a href=""><span class="glyphicon glyphicon-map-marker"></span> My Address</a></li>
				            <li class="active"><a href="<?php echo base_url();?>user/wallet"><span class="fa fa-money"></span> My Wallet</a></li>
				            <li class="active"><a href="<?php echo base_url();?>user/orders"><span class="glyphicon glyphicon-list"></span> My Orders</a></li>
				        </ul>
				    </div>
				</nav>
   			</div>
		</div>
		<div class="col-lg-9 profile-details" style="padding:0px;min-height:550px;">
			<form name="su_profile_frm" id="su_profile_frm" method="post" action="" class="sign-up-frm">
			<div class="panel panel-default">
  				<div class="panel-heading">Edit Address</div>
				<div class="panel-body">
					<div class="row col-md-8">
						<input type="hidden" name="userid" id="userid" value="<?php echo $olouserid;?>"/>
						<input type="hidden" name="address_id" id="address_id" value="<?php echo $address['id'];?>"/>
						<input type="hidden" name="areaid" id="areaid" value="1"/>
						<div class="col-md-12">
							<div class="form-group" id="error-load_title">
								<div>
									<input type="text" name="pro_address_name" id="pro_address_name" class="form-control" value="<?php echo $address['address_name'];?>" placeholder="Enter Address Name"/>
								</div>
								<div class="messageContainer"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<textarea name="pro_address" id="pro_address" class="form-control" placeholder="Enter Your Address"><?php echo $address['address'];?></textarea>
								</div>
								<div class="messageContainer"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<input type="text" name="pro_locality" id="pro_locality" class="form-control" value="<?php echo $address['locality'];?>" placeholder="Enter Your Locality"/>
								</div>
								<div class="messageContainer"></div>
							</div>
						</div>
						<input type="hidden" name="latitude" id="latitude" value="<?php echo $address['latitude'];?>"/>
						<input type="hidden" name="longitude" id="longitude" value="<?php echo $address['longitude'];?>"/>
						<div class="col-md-12">
							<div class="form-group">
								<div>
									<input type="text" name="pro_landmark" id="pro_landmark" class="form-control" value="<?php echo $address['landmark'];?>" placeholder="Enter Your Landmark"/>
								</div>
								<div class="messageContainer"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="alert alert-danger" id="profile_response" style="display:none;"></div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<button type="submit" name="update" id="update" class="btn btn-primary" >Update Address</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo asset_url();?>js/bootstrapValidator.min.js" ></script>
<script>
$(function () {
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        $('#search').removeClass('in').addClass('collapse').slideUp(200);
    });
   
   $('#search-trigger').click(function () {
        $('.navbar-nav').removeClass('slide-in');
        $('.side-body').removeClass('body-slide-in');
    });
});
$('#su_profile_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
  		pro_address_name: {
            validators: {
                notEmpty: {
                    message: 'Address Name is required and cannot be empty'
                }
            }
        },
        pro_address: {
            validators: {
                notEmpty: {
                    message: 'Address is required and cannot be empty'
                }
            }
        }, 
        pro_locality: {
            validators: {
            	notEmpty: {
                    message: 'Locality is required and cannot be empty'
                }
            }
        },
        pro_landmark: {
            validators: {
                notEmpty: {
                    message: 'Landmark is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	updateProfile();
});
$("#profile_response").hide();
function updateProfile() {
	$.post(base_url+"user/address/update", { userid: $("#userid").val(), areaid: $("#areaid").val(), id: $("#address_id").val(), address_name: $("#pro_address_name").val(), address: $("#pro_address").val(), landmark: $("#pro_landmark").val(), latitude: $("#latitude").val(), longitude: $("#longitude").val(), locality: $("#pro_locality").val() }, function(data){
		if(data.status == 1) {
			alert("Address Updated Successful.")
			window.location.href = base_url+"user/address";
		} else {
			$("#profile_response").show();
			$("#profile_response").html(data.msg);
		}
	},'json');
}
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?php echo $google_api_key;?>&callback=initMap");
function initMap() {
	var options = {
		types: ["geocode"],
	  	componentRestrictions: {country: 'in'}
	};
	var input =  document.getElementById('pro_locality');
	var autocomplete = new google.maps.places.Autocomplete(input,options);
	autocomplete.addListener('place_changed', function() {
		var place = autocomplete.getPlace();
	    if (!place.geometry) {
	      window.alert("Autocomplete's returned place contains no geometry");
	      return;
	    }
	    $('#latitude').val(place.geometry.location.lat());
	    $('#longitude').val(place.geometry.location.lng());
		$('#su_profile_frm').bootstrapValidator('revalidateField', 'latitude');
	});
}
</script>