<div class="container">
  <div class="security-question">
     <h1>Verifying it's you</h1>
     <h3 class="confirmed-txt">PIN Confirmed</h3>
     <h2 class="sq-text">Security Question</h2>
     <h4>What is killed bahubali?</h4>
     <form>
       <div class="form-inline">
          <div class="form-group">
              <input type="text" class="form-control" id="" placeholder="Enter your answer" name="">
          </div>
        </div>
       <div class="form-inline"><br>
          <button type="submit" class="spl-btn">Verify</button>
       </div>
     </form>
     <a href="<?php echo base_url();?>set-new-password" class="spl-a">set new password page</a><br>
     <a href="<?php echo base_url();?>OTP-Confirmation-message" class="spl-a">OTP Confirmation Message Page</a>
     <br><hr>
     <div class="forgot-customer-id">
       <h2>Can't remember security question? </h2>
       <p>If you no longer remember the security question associated with your<br> Phynart account, you can help restoring access to your account.</p>
       <a href="<?php echo base_url();?>forgot-customer-ID" class="spl-a">Forgot PIN</a>
     </div>
   </div>
</div>