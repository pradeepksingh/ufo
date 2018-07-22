<div class="container">
 <nav class="navbar navbar-inverse transparent-bg border-none navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand a1" href="<?php echo base_url(); ?>" ><img src="<?php echo asset_url();?>images/logo.png" alt="phynart_logo" class="img-responsive"/></a>
    </div>
    <div class="collapse navbar-collapse padding-navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right header">
        <li><a href="<?php echo base_url(); ?>.#caseStudy" class="a1">product</a></li>
        <li><a href="<?php echo base_url(); ?>.#forth" class="a1">features</a></li>
        <li><a href="<?php echo base_url(); ?>.#fifth" class="a1">installation</a></li>
        <li><a href="<?php echo base_url(); ?>story">story</a></li>
        <li><a href="<?php echo base_url(); ?>support">support</a></li>
        <?php if(!empty($olouserid)) { ?>
        	<li><a href="<?php echo base_url(); ?>account">account</a></li>
        <?php } else { ?>
         	<li><a href="<?php echo base_url(); ?>login">login</a></li>
        <?php } ?>
        <li><a href="<?php echo base_url(); ?>buynow" class="Buy-Now">Buy Now</a></li>
      </ul>
    </div>
  </div>
 </nav>
</div>