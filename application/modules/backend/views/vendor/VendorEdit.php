<style>
<!--
.margin-bottom-5{
	margin-bottom: 5px;
}
.progress {
	background-color:#ccc;
	border:1px solid gold;
	padding:0px;
	margin-top:5px;
}
.progress-text {
	background-color:#fff;
	padding:0px;
	margin-bottom:5px;
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
        	<h3>Update Vendor</h3>
       	</div> <!--<h4 style="color:blue;float:left;padding-left:20px;"><?php echo $basic[0]['name'];?> </h4>-->
   	</div>
		<ul class="nav nav-tabs">
		  	<li class="active"><a data-toggle="tab" href="#basic">Basic Details</a></li>
		  	<li><a data-toggle="tab" href="#billing">Billing Settings</a></li>
		</ul>
		<div class="tab-content">
			<div id="response"></div>
		  	<div id="basic" class="tab-pane fade in active">
		  		<form id="rest_details" name="rest_details" action="" method="post">
		  		<input type="hidden" name="restid" value="<?php echo $basic[0]['id'];?>"/>
		  		<div class="row">
	                <div class="col-lg-12">
	                    <div class="panel panel-default">
	                        <div class="panel-body"> 
	                          	<div class="row">
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-name">
                                            <label class="control-label col-sm-5">Vendor Name <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $basic[0]['name'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
									<div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-landmark">
                                            <label class="control-label col-sm-5">Email <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $basic[0]['email'];?>"/>
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
	                                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $basic[0]['mobile'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-landline_2">
                                            <label class="control-label col-sm-5">Landline </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="landline" name="landline" value="<?php echo $basic[0]['landline'];?>"/>
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
	                                            <textarea class="form-control" rows="3" id="address" name="address"><?php echo $basic[0]['address'];?></textarea>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-pincode">
                                            <label class="control-label col-sm-5">Pincode </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo $basic[0]['pincode'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
								</div>	
	                          	<!--<div class="row">
	                                <div class="col-lg-12 margin-bottom-5">
	                                	<div class="form-group" id="error-logo">
                                            <label class="control-label col-sm-3">Comments<span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
	                                            <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>        
											</div>
											<div class="messageContainer col-sm-4"></div>
                                        </div>
	                              	</div>
	                          	</div>-->
								<div class="text-center">
									<?php if($_SESSION['adminsession']['user_role']==1){?>
									<button type="submit" class="btn btn-success">Update</button>
									<?php } else {?>
									<button type="submit" class="btn btn-success" disabled>Update</button>
									<?php }?>
								</div>
	                      	</div>
	                  	</div>
	                  	<!--<?php if($_SESSION['adminsession']['user_role']==1){?>
						<button type="submit" class="btn btn-success">Update</button>
						<?php } else {?>
						<button type="submit" class="btn btn-success" disabled>Update</button>
						<?php }?>-->
	                  	
	               	</div>
	            </form>
	        	</div>
		  	</div>
		
		  	<div id="billing" class="tab-pane fade">
		  	<form id="restbilling" name="restbilling" action="" method="post">
		  		<input type="hidden" name="restid" value="<?php echo $basic[0]['id'];?>"/>
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
													<option value="1" <?php if(isset($bconfig[0]['billing_cycle']) && $bconfig[0]['billing_cycle'] == 1) {?>selected<?php }?>>Weekly</option>
													<option value="2" <?php if(isset($bconfig[0]['billing_cycle']) && $bconfig[0]['billing_cycle'] == 2) {?>selected<?php }?>>Fortnightly</option>
													<option value="3" <?php if(isset($bconfig[0]['billing_cycle']) && $bconfig[0]['billing_cycle'] == 3) {?>selected<?php }?>>Monthly</option>
												</select>
												<input type="text" id="cycle_effective_date" name="cycle_effective_date" class="form-control" value="<?php if($cycle) {echo date('d-m-Y',strtotime($cycle[0]['from_date']));}?>" placeholder="Effective Date" style="display:inline;width:49%;"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                            <!--<div>
                                            	<a target="new_blank"  class="btn btn-success btn-sm" href="<?php echo base_url();?>admin/billing/addconfig/<?php echo $basic[0]['id']?>"><i class="fa fa-plus-square">&nbsp;Commission</i></a>
                                            </div>-->
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-with_service_tax">
                                            <label class="control-label col-sm-5">Inclusive Service Tax </label>
                                            <div class="col-sm-10">
	                                            <select name="with_service_tax" id="with_service_tax" class="form-control">
													<option value="1" <?php if(isset($bconfig[0]['with_service_tax']) && $bconfig[0]['with_service_tax'] == 1) {?>selected<?php }?>>Yes</option>
													<option value="0" <?php if(isset($bconfig[0]['with_service_tax']) && $bconfig[0]['with_service_tax'] == 0) {?>selected<?php }?>>No</option>
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
													<option value="1" <?php if(isset($bconfig[0]['payment_mode']) && $bconfig[0]['payment_mode'] == 1) {?>selected<?php }?>>Online</option>
													<option value="2" <?php if(isset($bconfig[0]['payment_mode']) && $bconfig[0]['payment_mode'] == 2) {?>selected<?php }?>>Cheque</option>
													<option value="0" <?php if(isset($bconfig[0]['payment_mode']) && $bconfig[0]['payment_mode'] == 0) {?>selected<?php }?>>Cash</option>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
                                	<div class="col-lg-6 margin-bottom-5">
                                    	<div class="form-group" id="error-company_name">
                                          	<label class="control-label col-sm-5">Billing Company Name </label>
                                         	<div class="col-sm-10">
                                             	<input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $bconfig[0]['company_name']; ?>"/>
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
                                              	<input type="text" class="form-control" id="cheque_favour_of" name="cheque_favour_of" value="<?php echo $bconfig[0]['cheque_favour_of']; ?>"/>
                                           	</div>
                                           	<div class="messageContainer col-sm-10"></div>
                                       	</div>
                                  	</div>
									<div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-account_name">
                                            <label class="control-label col-sm-5">Account Name <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="account_name" name="account_name" value="<?php if(isset($bconfig[0]['account_name']))echo $bconfig[0]['account_name'];?>"/>
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
	                                            <input type="text" class="form-control" id="account_number" name="account_number" value="<?php if(isset($bconfig[0]['account_number'])) echo $bconfig[0]['account_number'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
									<div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-bank_name">
                                            <label class="control-label col-sm-5">Bank Name </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php if(isset($bconfig[0]['bank_name'])) echo $bconfig[0]['bank_name'];?>"/>
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
	                                            <input type="text" class="form-control" id="branch_name" name="branch_name" value="<?php if(isset($bconfig[0]['branch_name'])) echo $bconfig[0]['branch_name'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                                <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-ifsc_code">
                                            <label class="control-label col-sm-5">IFSC Code </label>
                                            <div class="col-sm-10">
	                                            <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="<?php if(isset($bconfig[0]['ifsc_code'])) echo $bconfig[0]['ifsc_code'];?>"/>
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
	                                            <input type="text" class="form-control" id="min_amount" name="min_amount" value="<?php  if(isset($bconfig[0]['min_amount']))echo $bconfig[0]['min_amount'];?>"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	    <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-is_official">
                                            <label class="control-label col-sm-5">Is Official ? </label>
                                            <div class="col-sm-10">
	                                            <select name="is_official" id="is_official" class="form-control">
                                                        <option value="1" <?php if(isset($bconfig[0]['is_official']) && $bconfig[0]['is_official'] == 1) {?>selected<?php }?>>Official</option>
                                                        <option value="0" <?php if(isset($bconfig[0]['is_official']) && $bconfig[0]['is_official'] == 0) {?>selected<?php }?>>UnOfficial</option>
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
													<option value="1" <?php if(isset($bconfig[0]['hard_copy']) && $bconfig[0]['hard_copy'] == 1) {?>selected<?php }?>>Yes</option>
													<option value="0" <?php if(isset($bconfig[0]['hard_copy']) && $bconfig[0]['hard_copy'] == 0) {?>selected<?php }?>>No</option>
												</select>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	    <div class="col-lg-6 margin-bottom-5">
	                                	<div class="form-group" id="error-invoice_notify_mobile">
                                            <label class="control-label col-sm-5">Gateway Charge <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
	                                            <input type="text" id="gateway_charge" name="gateway_charge" class="form-control" value="<?php if($gateway){ echo $gateway[0]['value'];}?>" placeholder="Gateway Charge" style="width:37%;display:inline;"/>
	                                            <input type="text" id="gateway_effective_date" name="gateway_effective_date" value="<?php if($gateway){ echo date('d-m-Y',strtotime($gateway[0]['from_date']));}?>" placeholder="Effective Date" class="form-control" style="width:60%;display:inline;"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
                                        </div>
	                              	</div>
	                          	</div>
	                      	</div>
	                      	<!--<div class="row">
	                                <div class="col-lg-12 margin-bottom-5">
	                                	<div class="form-group" id="error-logo">
                                            <label class="control-label col-sm-3">Comments<span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
	                                            <textarea class="form-control" rows="3" id="comment" name="comment"></textarea>        
											</div>
											<div class="messageContainer col-sm-4"></div>
                                        </div>
	                              	</div>
	                        </div>-->
							<div class="text-center">
								<?php if($_SESSION['adminsession']['user_role']==1){?>
								<button type="submit" class="btn btn-success">Update</button>
								<?php } else {?>
								<button type="submit" class="btn btn-success" disabled>Update</button>
								<?php } ?>
							</div>
	                  	</div>
	              
	               	</div>
	        	</div>
	        </form>
		  	</div>
		  	
		  	<div id="response"></div>
		  	<br>
		  	<br>
		</div>
	</div>	
</div>
<input type="hidden" id="map_load_count" value="0"/>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/selectize.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
<?php if($cycle) {?>
var cycleDate = '<?php echo date('d-m-Y',strtotime($cycle[0]['from_date']));?>'
<?php } else {?>
var cycleDate = new Date();
cycleDate.setDate(cycleDate.getDate()-90);
<?php }?>
<?php if($gateway) {?>
var gatewayDate = '<?php echo date('d-m-Y',strtotime($gateway[0]['from_date']));?>'
<?php } else {?>
var gatewayDate = new Date();
gatewayDate.setDate(gatewayDate.getDate()-90);
<?php }?>

$(document).ready(function() {
        showCustomTime();
	<?php if(isset($bconfig[0]['is_trial']) && $bconfig[0]['is_trial'] == 0) {?>
            $('#restbilling').bootstrapValidator('enableFieldValidators', 'trial_start_date', true);
            $('#restbilling').bootstrapValidator('enableFieldValidators', 'trial_end_date', true);
	<?php } ?>
});
/*$(document).ready(function (){

	
	$("#map-canvas").hide();
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		  var target = $(e.target).attr("href") // activated tab
		  if(target=="#delivery")
		  {
			lati= $('#latitude').val();
			longi= $('#longitude').val();
			 $('#lat').val(lati);
			 $('#lon').val(longi);
			  var gfance = <?php echo $basic[0]['is_geofancy'];?>;
		  if( gfance ==0)
		  {
			  showGEOadd(lati,longi,$('#radius').val());
		  }
		  
			  
				$.get(base_url + "admin/vendor/getgeofance/"+<?php echo $basic[0]['id'];?>, {}, function (data) {
					$.each(data, function (key, value) {
						
						$('#fenceid').val(value.fenceid);
						  showGEO(lati,longi,value.fence_pos);
					
						
			       	});
				}, 'json');
			
		  }
		  else
		  {
			  $("#map-canvas").hide();
		  }
		});
	
});*/
	
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$('#cycle_effective_date').datepicker({startDate: cycleDate}).on('changeDate', function(ev){
	$('#restbilling').bootstrapValidator('revalidateField', 'cycle_effective_date');
});
$('#gateway_effective_date').datepicker({startDate: gatewayDate}).on('changeDate', function(ev){
	$('#restbilling').bootstrapValidator('revalidateField', 'gateway_effective_date');
});
$('#trial_start_date').datepicker().on('changeDate', function(ev){
	$('#restbilling').bootstrapValidator('revalidateField', 'trial_start_date');
});
$('#trial_end_date').datepicker().on('changeDate', function(ev){
	$('#restbilling').bootstrapValidator('revalidateField', 'trial_end_date');
});
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

cuisine.on('change', function() {
	$('#rest_details').bootstrapValidator('revalidateField', 'cuisines[]');
});


/*function initMap() {
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
		$('#rest_details').bootstrapValidator('revalidateField', 'locality');
		$('#rest_details').bootstrapValidator('revalidateField', 'latitude');
		$('#rest_details').bootstrapValidator('revalidateField', 'longitude');
	});
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
		$('#restbilling').bootstrapValidator('enableFieldValidators', 'trial_start_date', true);
    	$('#restbilling').bootstrapValidator('enableFieldValidators', 'trial_end_date', true);
	} else {
		$("#trial_dates").hide();
		$('#restbilling').bootstrapValidator('enableFieldValidators', 'trial_start_date', false);
    	$('#restbilling').bootstrapValidator('enableFieldValidators', 'trial_end_date', false);
	}
});

$('#rest_details').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'vendor Name is required and cannot be empty'
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
       /* comment: {
        	validators: {
                notEmpty: {
                    message: 'Comment is required and cannot be empty'
                }
            }
        },*/
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateRestaurantDetails();
});


$('#restbilling').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
   // excluded: ':disabled',
    fields: {
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
        gateway_charge: {
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
        },
        comment: {
        	validators: {
                notEmpty: {
                    message: 'Comment is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	updateRestaurantBilling();
});

function updateRestaurantDetails() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showEditRequest,
	 		success :  showEditResponse,
	 		url : base_url+'admin/vendor/updatebasic',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#rest_details').ajaxSubmit(options);
}

function updateRestaurantBilling() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showEditRequest,
	 		success :  showEditResponse,
	 		url : base_url+'admin/vendor/updatebilling',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#restbilling').ajaxSubmit(options);
}

function showEditRequest(formData, jqForm, options){
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showEditResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.msg);
		$("#response").show();
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
  	}
}

function addMoreSlabs() {
	var slabcount = parseInt($("#slabcount").val());
	slabcount++;
	var slab_html = '<tr id="slabrow'+slabcount+'">'+
					'<td><input type="text" name="lower_limit[]" class="form-control" placeholder="From Amount"/></td>'+
					'<td><input type="text" name="upper_limit[]" class="form-control" placeholder="To Amount"/></td>'+
					'<td><input type="text" name="from_rad[]" class="form-control" placeholder="From Radius"/></td>'+
					'<td><input type="text" name="to_rad[]" id="to_rad-'+slabcount+'" class="form-control" placeholder="To Radius"/></td>'+
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
					'<td colspan=3><input type="text" name="to_time_rad[]" id="to_time_rad_'+timecount+'" class="form-control" placeholder="To Radius"/></td>'+
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

function verifyRestaurant(id) {
	$.get(base_url+"admin/vendor/verify/"+id,{},function(data) {
		$("#response").hide();
		if(data.status == '0') {
			$("#response").removeClass('alert-success');
	       	$("#response").addClass('alert-danger');
			$("#response").html(data.msg);
			$("#response").show();
			alert(data.msg);
	  	} else {
	  		$("#response").removeClass('alert-danger');
	        $("#response").addClass('alert-success');
	        $("#response").html(data.msg);
	        $("#response").show();
	        alert(data.msg);
	        window.location.reload();
	  	}
	},'json');
}

function liveRestaurant(id) {
	$.get(base_url+"admin/vendor/madelive/"+id,{},function(data) {
		$("#response").hide();
		if(data.status == '0') {
			$("#response").removeClass('alert-success');
	       	$("#response").addClass('alert-danger');
			$("#response").html(data.msg);
			$("#response").show();
			alert(data.msg);
	  	} else {
	  		$("#response").removeClass('alert-danger');
	        $("#response").addClass('alert-success');
	        $("#response").html(data.msg);
	        $("#response").show();
	        alert(data.msg);
	        window.location.reload();
	  	}
	},'json');
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
   /* var bermudaTriangle;
    var lat,long;
    var jsonArr = [];
    function successFunctionUpdate(lat,lon,pos) 
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
    	        var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
    	        
    	        var marker = new google.maps.Marker({
    	          position: myLatLng,
    	          map: map,
    	          title: 'Hello World!',
    	          center:myLatLng,
    	          icon:image
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
    }

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
            strokeColor: '#ff0000',
            strokeOpacity: 0.3,
            strokeWeight: 3,
            fillColor: '#ff0000',
            fillOpacity: 0.35
        });

        bermudaTriangle.setMap(map);
        getPolygonCoords();
        google.maps.event.addListener(bermudaTriangle, "dragend", getPolygonCoords);
        google.maps.event.addListener(bermudaTriangle.getPath(), "insert_at", getPolygonCoords);
        google.maps.event.addListener(bermudaTriangle.getPath(), "remove_at", getPolygonCoords);
        google.maps.event.addListener(bermudaTriangle.getPath(), "set_at", getPolygonCoords);
    }

    
    function showGEOadd()
    {
        $("#map-canvas").show();
        successFunction($('#latitude').val(),$('#longitude').val(),$('#radius').val());
    }
    function showGEO(lat,lon,pos)
    {
    	
        $("#map-canvas").show();
        successFunctionUpdate(lat,lon,pos);
    }*/
</script>
<script>
function initMap() {
	$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places,drawing&key=AIzaSyCH-u-UD2bz6cfPEAe8mCVyrnnI7ONx9ro&callback=displayMap");
}
function DeleteControl(controlDiv, map) {
	controlDiv.style.padding = '5px';
	var controlUI = document.createElement('div');
	controlUI.style.backgroundColor = 'white';
	controlUI.style.borderStyle = 'solid';
	controlUI.style.borderWidth = '2px';
	controlUI.style.cursor = 'pointer';
	controlUI.style.textAlign = 'center';
	controlUI.title = 'Click to clear polygon';
	controlDiv.appendChild(controlUI);

	var controlText = document.createElement('div');
	controlText.style.fontFamily = 'Arial,sans-serif';
	controlText.style.fontSize = '12px';
	controlText.style.paddingLeft = '4px';
	controlText.style.paddingRight = '4px';
	controlText.innerHTML = '<b>DELETE</b>';
	controlUI.appendChild(controlText);

	google.maps.event.addDomListener(controlUI, 'click', function() {
		deleteSelectedShape();
		clearSelection();
	});
}

var drawingManager;
	var selectedShape;
	var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
	var selectedColor;
	var colorButtons = {};
	<?php if(!empty($basic[0]['radius'])) { ?>
	var radius = <?php echo $basic[0]['radius'];?>;
	<?php } else { ?>
	var radius = 0;
	<?php } ?>
	<?php if(!empty($basic[0]['latitude'])) { ?>
	var latitude = <?php echo $basic[0]['latitude'];?>;
	<?php } else { ?>
	var latitude = 0;
	<?php } ?>
	<?php if(!empty($basic[0]['longitude'])) { ?>
	var longitude = <?php echo $basic[0]['longitude'];?>;
	<?php } else { ?>
	var longitude = 0;
	<?php } ?>
	var fence_points = [];
	function clearSelection() {
		if (selectedShape) {
	  	selectedShape.setEditable(false);
	  	selectedShape = null;
	}
}

function setSelection(shape) {
	clearSelection();
	selectedShape = shape;
	shape.setEditable(true);
	selectColor(shape.get('fillColor') || shape.get('strokeColor'));
}

function deleteSelectedShape() {
	if (selectedShape) {
	  	selectedShape.setMap(null);
	  	drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
	}
}

function selectColor(color) {
	selectedColor = color;
	
	var polylineOptions = drawingManager.get('polylineOptions');
	polylineOptions.strokeColor = color;
	drawingManager.set('polylineOptions', polylineOptions);
	
	var rectangleOptions = drawingManager.get('rectangleOptions');
	rectangleOptions.fillColor = color;
	drawingManager.set('rectangleOptions', rectangleOptions);
	
	var circleOptions = drawingManager.get('circleOptions');
	circleOptions.fillColor = color;
	drawingManager.set('circleOptions', circleOptions);
	
	var polygonOptions = drawingManager.get('polygonOptions');
	polygonOptions.fillColor = color;
	drawingManager.set('polygonOptions', polygonOptions);
}
var map;
var polyOptions = {
  		strokeWeight: 0,
  		fillOpacity: 0.45,
  		editable: true,
  		fillColor:'#1E90FF'
	};
function displayMap() {
	var is_map_loaded = $("#map_load_count").val();
	if(is_map_loaded == 0) {
		map = new google.maps.Map(document.getElementById('map-canvas'), {
		      zoom: 13,
		      center: new google.maps.LatLng(<?php echo $basic[0]['latitude'];?>, <?php echo $basic[0]['longitude'];?>),
		      mapTypeId: google.maps.MapTypeId.ROADMAP,
		      zoomControl: true,
		      scrollwheel: false,
		      disableDefaultUI: true
		    });
		    var marker = new google.maps.Marker({
			    position: new google.maps.LatLng(<?php echo $basic[0]['latitude'];?>, <?php echo $basic[0]['longitude'];?>),
			    map: map,
			    draggable:true,
				animation: google.maps.Animation.DROP,
			    title: "<?php echo $basic[0]['name'];?>"
			});
		    var deleteControlDiv = document.createElement('div');
			var homeControl = new DeleteControl(deleteControlDiv, map);

			deleteControlDiv.index = 1;
			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(deleteControlDiv);
				polyOptions = {
		      		strokeWeight: 0,
		      		fillOpacity: 0.45,
		      		editable: true,
		      		fillColor:'#1E90FF'
		    	};
		    	// markers, lines, and shapes.
		    	drawingManager = new google.maps.drawing.DrawingManager({
		      		drawingControl: false,
		      		drawingMode: google.maps.drawing.OverlayType.POLYGON,
		      		markerOptions: {
		        		draggable: true
		      		},
		      		polylineOptions: {
		        		editable: true
		      		},
		      		rectangleOptions: polyOptions,
		      		circleOptions: polyOptions,
		      		polygonOptions: polyOptions,
		      		map: map
		    	});

		    	<?php if (count($coords) > 0) { ?>
		        	var lats = [];
					var lat_size = <?php echo count($coords);?>;
					<?php foreach ($coords as $coord) { ?>
					<?php if(!empty($coord['latitude']) && !empty($coord['longitude'])) { ?>
						fence_points.push('<?php echo $coord['latitude'];?>#<?php echo $coord['longitude'];?>');
						lats.push(new google.maps.LatLng(<?php echo $coord['latitude'];?>, <?php echo $coord['longitude'];?>));
		    		<?php } ?>
					<?php } ?>
		    		polyOptions.paths = lats;
		        	polygon = new google.maps.Polygon(polyOptions);
		        	polygon.setMap(map);
		        	clearSelection();
		        	selectedShape = polygon;
		        	drawingManager.setDrawingMode(null);
		        <?php } else { ?>
		        	var lat = <?php echo $basic[0]['latitude'];?>;
		        	var lng = <?php echo $basic[0]['longitude'];?>;
		      	  	polyOptions.paths = getFences(lat,lng,radius);
		      		polygon = new google.maps.Polygon(polyOptions);
		      		polygon.setMap(map);
		      		clearSelection();
		      		selectedShape = polygon;
		      		drawingManager.setDrawingMode(null);
		    	<?php } ?>
			
		    	google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
		        	if (e.type != google.maps.drawing.OverlayType.MARKER) {
		        		var newShape = e.overlay;
		        		drawingManager.setDrawingMode(null);
		        		newShape.setEditable(true);
		        		newShape.type = e.type;
		        		google.maps.event.addListener(newShape, 'click', function() {
		          			setSelection(newShape);
		        		});
		        		setSelection(newShape);
		      		}
		    	});
			var options = {
				types: [],
				componentRestrictions: {country: 'in'}
			};

			var input = (document.getElementById('locality'));
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

			var autocomplete = new google.maps.places.Autocomplete(input,options);

			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				var place = autocomplete.getPlace();
				map.panTo(place.geometry.location);
				marker.setPosition(place.geometry.location);
				document.getElementById("latitude").value = place.geometry.location.lat();
			    document.getElementById("longitude").value = place.geometry.location.lng(); 
				if (!place.geometry) {
					return;
				}
				if(document.getElementById("have_gf").value == 0){
					polyOptions.paths = changeFences(latitude,longitude,place.geometry.location.lat(),place.geometry.location.lng());
		      		polygon.setOptions(polyOptions);
		      		clearSelection();
		      		selectedShape = polygon;
		      		drawingManager.setDrawingMode(null);
		      		polygon.setEditable(true);
				}
			});
		  
			google.maps.event.addListener(marker, 'dragend', function(){
			
			    document.getElementById("latitude").value = marker.getPosition().lat();
			    document.getElementById("longitude").value = marker.getPosition().lng();
			    if(document.getElementById("have_gf").value == 0){
				    polyOptions.paths = changeFences(latitude,longitude,marker.getPosition().lat(),marker.getPosition().lng());
		      		polygon.setOptions(polyOptions);
		      		clearSelection();
		      		selectedShape = polygon;
		      		drawingManager.setDrawingMode(null);
		      		polygon.setEditable(true);
			    }
			});
		$("#map_load_count").val(1);
	}
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
	var ex1;
	for (var i=0; i < points+1; i++)
	{
	  	var theta = Math.PI * (i / (points/2));
	  	ex = parseFloat(lng) + parseFloat((rlng * Math.cos(theta)));
	  	ey = parseFloat(lat) + parseFloat((rlat * Math.sin(theta)));
	  	ey = Math.round(ey*1000000000)/1000000000;
	  	ex = Math.round(ex*1000000000)/1000000000;
	  	extp.push(new google.maps.LatLng(ey,ex));
	  	fence_points.push(ey+'#'+ex);
	}
	return extp;
}

$("#radius").focusout(function() {
	var fence_radius = parseInt($("#radius").val());
	var new_lat = parseFloat(document.getElementById("latitude").value);
	var new_lng = parseFloat(document.getElementById("longitude").value);
	var polyOptions = {
	  		strokeWeight: 0,
	  		fillOpacity: 0.45,
	  		editable: true,
	  		fillColor:'#1E90FF'
		};
	polyOptions.paths = getFences(new_lat,new_lng,fence_radius);
	deleteSelectedShape();
	polygon = new google.maps.Polygon(polyOptions);
	polygon.setMap(map);
	clearSelection();
	selectedShape = polygon;
	drawingManager.setDrawingMode(null);
	
});

function changeFences(l1,l2,l3,l4){
	latitude = l3;
	longitude = l4;
	var x_diff = parseFloat(l3) - parseFloat(l1);
	var y_diff = parseFloat(l4) - parseFloat(l2);
	var fpoints = new Array();
	var points = fence_points.length;
	var extp = new Array();
	for (var i=0; i < points; i++)
	{
		var geopoints = fence_points[i].split('#');
		ex = x_diff + parseFloat(geopoints[0]);
		ey = y_diff + parseFloat(geopoints[1]);
		fpoints.push(ex+'#'+ey);
		extp.push(new google.maps.LatLng(ex, ey));
	}
	fence_points = fpoints;
	return extp;
}

function storeFence(){
	var maxdist = 0;
	if(selectedShape){
		var vertices = selectedShape.getPath();
	  	var contentString = '';
	  	for (var i =0; i < vertices.getLength(); i++) {
	    	var xy = vertices.getAt(i);
	    	if(contentString != '')
	    		contentString += '#'+xy.lat() + ',' + xy.lng();
	    	else
	    		contentString = xy.lat() + ',' + xy.lng();
			var rest_dist = getGoePointDistance(document.getElementById("latitude").value,document.getElementById("longitude").value,xy.lat(),xy.lng());
			if(parseInt(rest_dist) > parseInt(maxdist)){
				maxdist = rest_dist;
			}
	  	}
	  	var itemcount = $("#slabcount").val();
	  	var timeitemcount = $("#timecount").val();
	  	document.getElementById("to_rad-"+itemcount).value = Math.ceil(maxdist);
	  	document.getElementById("to_time_rad_"+timeitemcount).value = Math.ceil(maxdist);
	  	$("#radius").val(Math.ceil(maxdist));
		return contentString;
	}else{
		return '';
	}
}

//radius calculation by pradeep singh

function getGoePointDistance(lat1,lon1,lat2,lon2) {
	var R = 6371000;
	var dLat = deg2rad(lat2-lat1);
	var dLon = deg2rad(lon2-lon1); 
	var a = 
	    Math.sin(dLat/2) * Math.sin(dLat/2) +
	    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
	    Math.sin(dLon/2) * Math.sin(dLon/2); 
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
	var d = R * c;
	return d;
}

function deg2rad(deg) {
	return deg * (Math.PI/180)
}
$(document).ready(function(){
    $('#tblRestos').DataTable();
});

</script>
