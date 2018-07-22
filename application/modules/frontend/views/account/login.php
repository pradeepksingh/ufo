<<style>
.loginbox{  
	margin-left: 35%;
    padding-bottom: 5%;
    padding-top: 5%;
    margin-top: 2%;
    border: 2px solid #d7d3d3;
    width: 30%;
    height: 10%;
    box-sizing: border-box;
    text-align: center;
 }
.logininput{
	width: 80%;
    height: 50px;
}
</style>
<div class="container login">
	<div class="row">
			<div class="col-md-12 col-sm-12 text-center">
				<h2 style="margin-top:11%">You need to logged in to your phyart account<br>to complete the purchase</h2>
				<div class="loginbox">
					<form name="lg_login_frm" id="lg_login_frm" method="post" action="" >
					  <div class="form-group is-empty formgroupmargin">
					    <div>
					       <input type="text" name="lg_email" class="logininput" id="lg_email" placeholder="Username"/>
					    </div>
					    <div class="messageContainer"></div>
					  </div>
					  <div class="form-group is-empty formgroupmargin">
					    <div>
					       <input type="password" name="lg_password" class="logininput" id="lg_password" placeholder="Password"/>
					     </div>  
					     <div class="messageContainer"></div>
					  </div>
					  
					   <div class="form-group is-empty formgroupmargin" style="margin: 10px 21% 0px 21%;">
							<div style="color: red;"  id="lg_response" style="display:none;"></div>
					   </div>
					  
					  <div class="forgot-link">
		      			<a href="" data-toggle="modal" data-target="#fogetModal" style="text-decoration:underline;">Forgot Password ?</a>
		      		 </div><br>
		      		 <div class="inline">
		      		   <a href="<?php echo base_url();?>signup"><button type="button" class="btn btn-primary" id="lg_login_btn" style="margin-right: 37%;">Register</button></a>
					   <button type="submit" class="btn btn-primary" id="lg_login_btn">Sign in</button>
					   
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
        		Verify Your Email/Mobile
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
$('#lg_login_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        lg_email: {
            validators: {
                notEmpty: {
                    message: 'Email is required and cannot be empty'
                }
            }
        },
        lg_password: {
            validators: {
                notEmpty: {
                    message: 'Password is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	userLogin();
});
$("#lg_response").hide();

function userLogin() {
	ajaxindicatorstart("Please wait.. while we submit your query...");
	jQuery.post(base_url+"userlogin", { username: jQuery("#lg_email").val(), password: jQuery("#lg_password").val() }, function(data){
		if(data.status == 1) {
			//window.location.reload();
			ajaxindicatorstop();
			alert(data.msg);
			window.location.href = base_url;
		} else {
			if(data.otp_verify == 0) {
				ajaxindicatorstop();
				jQuery("#lg_response").show();
				jQuery("#lg_response").html(data.msg);
				jQuery("#lg_uid").val(data.id);
				jQuery("#otpModal").modal("show");
			}else {
				ajaxindicatorstop();
				jQuery("#lg_response").show();
				jQuery("#lg_response").html(data.msg);
			}
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

jQuery("#otp_verify_btn").click(function(){
	ajaxindicatorstart("Please wait.. while we submit your query...");
	jQuery.get(base_url+"verifyotp/"+$("#lg_uid").val()+"/"+$("#lg_otp").val(), { }, function(data){
		if(data.status == 1) {
			ajaxindicatorstop();
			alert("Login successful continue with shopping");
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
