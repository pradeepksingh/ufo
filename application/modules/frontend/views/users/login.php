<div class="login">
  <div class="container">
     <div class="text-center">
     <h1 id="login_main_msg" style="display:none;">Log in failed</h1>
     <h3 id="login_attempts" style="display:none;">Only 5 more times are remaining</h3>
        <div class="login-box">
             <form>
                <div class="form-inline">
                   <div class="form-group">
                      <input type="text" class="form-control" id="user_name" placeholder="Username / Email" name="user_name" />
                   </div>
               </div>
               <div class="form-inline">
                  <div class="form-group">
                      <input type="password" class="form-control" id="user_password" placeholder="Password" name="user_password" />
                  </div>
              </div>
              <p class="error-message" id="login_error_msg" style="display:none;">Name &#38; password do not match</p>
              <a href="<?php echo base_url(); ?>unable-to-login" class="cannot-login-txt">I cannot Log in </a>
              <div class="row row1 form-inline">
                 <a href="<?php echo base_url(); ?>register" class="spl-btn fleft">Register</a>
                 <button type="button" class="spl-btn fright" id="login_btn" onClick="loginUser(1);">Sign in</button>
              </div>
            </form>
        </div>
     </div>
  </div>
</div>
<script>
function loginUser(have_referer) {
	jQuery.post(base_url+"userlogin", { username: $("#user_name").val(), password: $("#user_password").val(), have_referer: have_referer}, function(data) {
		if(data.status == 1) {
			if(have_referer == 1) {
				window.location.href = data.url;
			} else {
				//
			}
		} else if(data.status == 2) {
			window.location.href = data.url;
		} else {
			jQuery("#login_main_msg").show();
			jQuery("#login_attempts").html(data.login_attempts);
			jQuery("#login_error_msg").html(data.login_error_msg);
			jQuery("#login_attempts").show();
			jQuery("#login_error_msg").show();
		}
	},'json');
}
</script>