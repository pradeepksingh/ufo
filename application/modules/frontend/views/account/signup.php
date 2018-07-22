<<style>
.signupbox{  
	margin-left: 35%;
    padding-bottom: 2%;
    padding-top: 2%;
    margin-top: 2%;
    border: 2px solid #d7d3d3;
    width: 30%;
    height: 10%;
    box-sizing: border-box;
    text-align: center;
 }
.signupinput{
	width: 80%;
    height: 40px;
}
</style>
<div class="container login">
	<div class="row">
			<div class="col-md-12 col-sm-12 text-center">
				<h2 style="margin-top:5%">You need to sign up to your phynart account<br>to complete the purchase</h2>
				<div class="signupbox">
				
				<form name="su_sign_frm" id="su_sign_frm" method="post" action="" >
					  
						  <div class="form-group is-empty formgroupmargin">
						    <div>
						       <input type="text" class="signupinput" name="su_name" id="su_name" placeholder="Full Name"/>
						    </div>
						    <div class="messageContainer"></div>
						  </div>
						  
						  <!--<div class="form-group is-empty formgroupmargin">
						    <div>
						       <input type="text" class="signupinput" name="su_lname" id="su_lname" placeholder="Last Name"/>
						     </div>  
						     <div class="messageContainer"></div>
						  </div>-->
						  
						  <div class="form-group is-empty formgroupmargin">
						    <div>
						       <input type="text" class="signupinput" name="su_email" id="su_email"  placeholder="Email"/>
						    </div>
						    <div class="messageContainer"></div>
						  </div>
						  
						  <div class="form-group is-empty formgroupmargin">
						    <div>
						       <input type="text" class="signupinput" name="su_mobile" id="su_mobile" placeholder="Mobile"/>
						     </div>  
						     <div class="messageContainer"></div>
						  </div>
						  
						   <div class="form-group is-empty formgroupmargin">
						    <div>
						       <input type="password" class="signupinput" name="su_password" id="su_password" placeholder="Password"/>
						    </div>
						    <div class="messageContainer"></div>
						  </div>
						  
						  <div class="form-group is-empty formgroupmargin">
						    <div>
						       <input type="password" class="signupinput" name="su_password_confirm" id="su_password_confirm" placeholder="Confirm Password"/>
						     </div>  
						     <div class="messageContainer"></div>
						  </div>
						  
					   <div class="form-group is-empty formgroupmargin" style="margin: 10px 21% 0px 21%;">
							<div style="color: red;"  id="su_response" style="display:none;"></div>
					   </div>
					  
					 <!--<div class="forgot-link">
		      			<a href="" data-toggle="modal" data-target="#fogetModal" style="text-decoration:underline;">Forgot Password ?</a>
		      		 </div><br>-->
		      		 <div class="inline">
		      		   <a href="<?php echo base_url();?>login"><button type="button" class="btn btn-primary" id="lg_login_btn" style="margin-right: 37%;">Sign in</button></a>
					   <button type="submit" class="btn btn-primary" id="lg_login_btn">Register</button>
					 </div>
					 					 
				  </form>
			 </div>				
	  	  </div>
	</div>
</div>

<div id="fogetModal" class="modal fade" role="dialog" style="color:#555;">
  	<div class="modal-dialog">
    	<div class="modal-content">
    		<form action="" name="forget_frm" id="forget_frm">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Recover Password</h4>
      		</div>
	      	<div class="modal-body">
              	<div class="row" style="padding:0px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="name" class="control-label">Enter Email</label>
                       		<input type="text" name="forget_email" id="forget_email" class="form-control" value=""/>
                  		</div>
                  		<div class="messageContainer"></div>
              		</div>
              	</div>
	      	</div>
	      	<div class="modal-footer">
	      		<button type="submit">SUBMIT</button>
	        	<button type="button" data-dismiss="modal">Close</button>
	      	</div>
	      	</form>
    	</div>
  	</div>
</div>

<div id="otpModal" class="modal fade" role="dialog">
  	<div class="modal-dialog custom-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		Verify Your Email Id
      		</div>
      		<div class="modal-body">
        		<div class="form-body pal">
					<div class="row">
						<div class="col-md-12" style="margin-bottom:5px;">
							<input type="hidden" name="lg_uid" id="lg_uid" value=""/>
							<div class="form-group" id="error-load_title">
								<label class="control-label label-green"> OTP <span class='require'>*</span></label>
								<div>
									<input type="text" name="lg_otp" id="lg_otp" class="form-control" placeholder="Enter Your OTP"/>
								</div>
								<div class="messageContainer"></div>
							</div>
						</div>
						<div class="col-md-12">
							<div style="color: red;"  id="otp_response" style="display:none;"></div>
						</div>
					</div>
				</div>
      		</div>
      		<div class="modal-footer">
      			<button type="submit" id="otp_verify_btn" >Verify</button>
      		</div>
    	</div>
  	</div>
</div>

<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script type="text/javascript">
$('#su_sign_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	su_name: {
            validators: {
                notEmpty: {
                    message: 'Name is required and cannot be empty'
                }
            }
        },
        su_email: {
            validators: {
                notEmpty: {
                    message: 'Email is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a email address'
                }
        		
            }
        },
        su_mobile: {
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
        su_password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                }
            }
        },
        su_password_confirm: {
            validators: {
            	notEmpty: {
                    message: 'Confirm Password is required and cannot be empty'
                },
                identical: {
                    field: 'su_password',
                    message: 'Passwords do not match.'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	userSignUp();
});
$("#lg_response").hide();
$("#su_response").hide();
$("#en_response").hide();
function userSignUp() {
	//var agree = $('input[name=agree]:checked').val();
	//alert(agree);
	ajaxindicatorstart("Please wait.. while we submit your query...");
	jQuery.post(base_url+"register", { name: $("#su_name").val(), email: $("#su_email").val(), mobile: $("#su_mobile").val(), password: $("#su_password").val() }, function(data){
		if(data.is_register == 1) {
			ajaxindicatorstop();
			alert("SignUp Successful Enter OTP to Verify User");
			//$("#signInModal").modal("hide");
			jQuery("#otpModal").modal("show");
			jQuery("#lg_uid").val(data.id);
		} else {
			ajaxindicatorstop();
			jQuery("#su_response").show();
			jQuery("#su_response").html(data.msg);
		}
	},'json');
}



$('#forget_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	forget_email: {
            validators: {
                notEmpty: {
                    message: 'Email is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a email address'
                }
        		
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	resendPassword();
});

function resendPassword() {
	ajaxindicatorstart("Please wait.. while we submit your query...");
	jQuery.post(base_url+"resendpassword",{email: $("#forget_email").val()},function(data) {
		if(data.status == 1) {
			alert(data.msg);
			ajaxindicatorstop();
			jQuery("#fogetModal").modal('hide');
		} else {
			ajaxindicatorstop();
			alert(data.msg);
		}
	},'json');
}

$("#otp_response").hide();
jQuery("#otp_verify_btn").click(function(){
	ajaxindicatorstart("Please wait.. while we submit your query...");
	jQuery.get(base_url+"verifyotp/"+$("#lg_uid").val()+"/"+$("#lg_otp").val(), { }, function(data){
		if(data.status == 1) {
			ajaxindicatorstop();
			alert("Signup successful continue with shopping");
			//window.location.reload();
			window.location.href = base_url;
		} else {
			ajaxindicatorstop();
			jQuery("#otp_response").show();
			jQuery("#otp_response").html(data.msg);
		}
	},'json');
});

</script>
