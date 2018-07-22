<div class="container">
   <div class="error-msg text-center">
      <div class="error-box">
         <h3>Hi <?php echo $name;?>,</h3>
         <h4>You should know this,</h4>
         <img src="<?php echo asset_url();?>images/warning.png" alt="Phynart" /> 
         <h5>Someone tried to access your account<br> using wrong password <?php echo $attempts;?> times</h5>
         <h6>We suggest you change your password</h6><br><br>
         <a href="<?php echo base_url();?>account/my-profile" class="spl-btn">Continue to account</a>
      </div>
   </div>
</div>