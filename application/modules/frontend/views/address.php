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
		<?php if(count($addresses) > 0) { ?>
			<?php foreach ($addresses as $address) { ?>
			<div class="panel panel-default">
  				<div class="panel-heading"><?php echo $address['address_name'];?></div>
				<div class="panel-body">
					<div class="row profile-row">
						<div class="col-lg-4">
							Address
						</div>
						<div class="col-lg-8">
							<?php echo $address['address'];?>
						</div>
					</div>
					<div class="row profile-row">
						<div class="col-lg-4">
							Locality
						</div>
						<div class="col-lg-8">
							<?php echo $address['locality'];?>
						</div>
					</div>
					<div class="row profile-row">
						<div class="col-lg-4">
							Landmark
						</div>
						<div class="col-lg-8">
							<?php echo $address['landmark'];?>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="<?php echo base_url();?>user/address/edit/<?php echo $address['id'];?>" class="btn btn-primary" >Edit Address</a>
				</div>
			</div>
			<?php } ?>
			<?php } else { ?>
			<form id="new_add_frm" name="new_add_frm" action="" method="post"> 	
				<input type="hidden" name="userid" id="userid" value="<?php echo $olouserid;?>" /> 
				<div class="panel panel-default">
  					<div class="panel-heading">Add New Address</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group" id="error-uaddress_name">
									<label class="control-label label-green"> Address Name <span class='require'>*</span></label>
									<div>
										<input type="text" name="uaddress_name" id="uaddress_name" class="form-control" placeholder="e.g. Home, Office etc."/>
									</div>
									<div class="messageContainer"></div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label class="control-label label-green"> Address <span class='require'>*</span></label>
									<div>
										<textarea name="uaddress" id="uaddress" class="form-control" placeholder="Enter Your Address"></textarea>
									</div>
									<div class="messageContainer"></div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label class="control-label label-green"> Locality <span class='require'>*</span></label>
									<div>
										<input type="hidden" name="uareaid" id="uareaid" value="3"/>
										<input type="hidden" name="ulatitude" id="ulatitude" value="" />
										<input type="hidden" name="ulongitude" id="ulongitude" value="" class="form-control"/>
										<input type="text" name="ulocality" id="ulocality" class="form-control" value="" placeholder="Enter Your Location" />
									</div>
									<div class="messageContainer"></div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group" id="error-uaddress_name">
									<label class="control-label label-green"> Landmark</label>
									<div>
										<input type="text" name="ulandmark" id="ulandmark" class="form-control" placeholder="Enter Your Landmark"/>
									</div>
									<div class="messageContainer"></div>
								</div>
							</div>
							<div class="col-md-8">
								<div class="alert alert-danger" id="su_response" style="display:none;"></div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
		      			<button type="submit" class="btn btn-primary" id="address_add_btn" >SAVE</button>
		      		</div>
	      		</div>
			</form>
			<?php } ?>
		</div>
	</div>
</div>
<script>
$(function () {
    $('.navbar-toggle').click(function () {
        $('.navbar-nav').toggleClass('slide-in');
        $('.side-body').toggleClass('body-slide-in');
        $('#search').removeClass('in').addClass('collapse').slideUp(200);

        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').toggleClass('slide-in');
        
    });
   
   // Remove menu for searching
   $('#search-trigger').click(function () {
        $('.navbar-nav').removeClass('slide-in');
        $('.side-body').removeClass('body-slide-in');

        /// uncomment code for absolute positioning tweek see top comment in css
        //$('.absolute-wrapper').removeClass('slide-in');

    });
});
$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?php echo $google_api_key;?>&callback=initMap");
function initMap() {
	var options = {
		types: ["geocode"],
	  	componentRestrictions: {country: 'in'}
	};
	var input =  document.getElementById('ulocality');
	var autocomplete = new google.maps.places.Autocomplete(input,options);
	autocomplete.addListener('place_changed', function() {
		var place = autocomplete.getPlace();
	    if (!place.geometry) {
	      window.alert("Autocomplete's returned place contains no geometry");
	      return;
	    }
	    $('#ulatitude').val(place.geometry.location.lat());
	    $('#ulongitude').val(place.geometry.location.lng());
		$('#new_add_frm').bootstrapValidator('revalidateField', 'ulatitude');
	});
}
$('#new_add_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	uareaid: {
            validators: {
                notEmpty: {
                    message: 'Area is required.'
                },
                integer: {
                    message: 'Invalid Area.'
           		}
            }
        },
        uaddress_name: {
            validators: {
                notEmpty: {
                    message: 'Address name is required.'
                }
            }
        },
        uaddress: {
            validators: {
                notEmpty: {
                    message: 'Address is required.'
                }
            }
        },
        ulatitude: {
            validators: {
                notEmpty: {
                    message: 'Locality is required.'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	addnewAddress();
});
function addnewAddress() {
	$.post(base_url+"addnewaddress",{ userid: $("#userid").val(), address_name: $("#uaddress_name").val(), address: $("#uaddress").val(), locality: $("#ulocality").val(), latitude: $("#ulatitude").val(), longitude: $("#ulongitude").val(), landmark: $("#ulandmark").val(), areaid: $("#uareaid").val()}, function(data) {
		if(data.status == 1) {
			window.location.reload();
		}
	},'json');
}
</script>