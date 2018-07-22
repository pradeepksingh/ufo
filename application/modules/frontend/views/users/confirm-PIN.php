<div class="container">
  <div class="confirm-PIN">
     <h1>Verifying it's you</h1>
     <h2>PIN</h2>
     <p>For your security, we need to verify your identity. <br>Please enter the PIN you set. </p>
     <form>
       <div class="form-inline">
          <div class="form-group">
              <input type="text" class="form-control" id="" placeholder="Enter PIN" name="">
          </div>
        </div>
       <div class="form-inline"><br>
          <button type="submit" class="spl-btn">Verify</button>
       </div>
     </form>
     <a href="<?php echo base_url();?>security-question" class="spl-a">security question page</a>
     <br><hr>
     <div class="forgot-customer-id">
       <h2>Can't remember 4 Digit PIN?</h2>
       <p>If you no longer remember the PIN associated with your<br> Phynart account, you can help restoring access to your account.</p>
       <a href="<?php echo base_url();?>forgot-customer-ID" class="spl-a">Forgot PIN</a>
     </div>
   </div>
</div>