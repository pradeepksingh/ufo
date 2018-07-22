<div class="container">
   <div class="error-msg text-center">
      <div class="error-box">
         <h3>Hi <?php echo $name;?>,</h3>
         <img src="<?php echo asset_url();?>images/rounded-block-sign.png" alt="Phynart" /> 
         <h5>Your account is suspended</h5>
         <h6>Because, your mobile number is missing </h6>
         <h6>Enter a valid mobile number to resume </h6>
         <br><br>
         <a href="<?php echo base_url();?>account/reactivate/pin" class="spl-btn">Reactivate Now</a>
      </div>
   </div>
</div>