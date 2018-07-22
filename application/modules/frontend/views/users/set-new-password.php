<div class="container">
  <div class="set-new-password">
     <h3 class="confirmed-txt">PIN Confirmed</h3>
     <h3 class="confirmed-txt">Security Answer Confirmed</h3>
     <h2 class="sq-text">Identity Verified</h2>
     <h4>Hi Ashish</h4>
     <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5">
          <form>
          <h2>Set New Password </h2>
           <div class="form-inline">
              <div class="form-group">
                  <input type="password" class="form-control" id="" placeholder="Enter new password" name="">
              </div>
              <p class="error-message">Password has been used in the last one year, choose a new password</p>
            </div>
            <div class="form-inline">
              <div class="form-group">
                  <input type="password" class="form-control" id="" placeholder="Confirm new password" name="">
              </div>
            </div>
           <div class="form-inline"><br>
              <button type="submit" class="spl-btn">Save</button>
           </div>
         </form>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7">
           <ul>
             <li>+ Be a minimum of eight(8) characters in length.</li>
             <li>+ Contain at least one uppercase letter(A-Z)</li>
             <li>+ Contain at least one lowercase letter(a-z)</li>
             <li>+ Contain at least one Digit(0-9)</li>
             <li>+ Contain at least one special character(!@#$%^&*()+_=)</li>
           </ul>
        </div>
     </div>
     <a href="<?php echo base_url();?>password-reset-successfull" class="spl-a">password reset successfull page</a>
   </div>
</div>