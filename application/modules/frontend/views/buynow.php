<div class="pincode-section pincode-section-grey">
   <div class="container">
      <div class="row">
         <div class="col-md-5 col-sm-5">
           <p>Currently Offering services in limited parts of pune</p>
           <h6>you can check availability in your area here</h6>
         </div>
         <div class="col-md-6 col-sm-6">
           <!--<form>
             <input type="text" placeholder="Enter Pincode">
             <button type="submit">Check Availability</button>
           </form>-->
           <form>
                 <div class="input-append">
				    <input type="text" placeholder="PIN CODE" name="pincode" maxlength="6" id="pincode">  
				    <button type="button" class="btn" onclick="checkPincode();">Check Availability</button>
				 </div>
				 <div id="checkresponse" style="display:none;color:red"></div>
		   </form>
         </div>
         <div class="col-md-1 col-sm-1">
            <img src="<?php echo asset_url();?>images/product-close.png" alt="product-images" class="img-responsive" class="cross"/>
         </div>
      </div>
   </div>
 </div>
 <div class="spacer">
 
 </div>
 <div class="container">
   <div class="product-section">
      <h1>Buy Now</h1>
       <ul class="nav nav-pills">
        <li class="active"><a data-toggle="pill" href="#home">Devices</a></li>
        <li><a data-toggle="pill" href="#menu1">Kits</a></li>
        <li><a data-toggle="pill" href="#menu2">Subscriptions</a></li>
      </ul>
      
      <div class="tab-content">
      
        <div id="home" class="tab-pane fade in active">
           <div class="product-list">
           <?php //print_r($products['individuals']);?>
          <?php if(!empty($products['individuals'])) { ?>
            <div class="row">
			<?php $i = 0; ?>
	        <?php foreach($products['individuals'] as $product) { ?>
	         <?php if ($i == 0) {  ?>           
               <div class="col-md-12 col-sm-12 product-show1">
                  <div class="col-md-6 col-sm-6">
                      <img src="<?php echo base_url();?><?php echo $product['image'];?>" alt="product-images" class="img-responsive"/>
                  </div>
                  <div class="col-md-6 col-sm-6">
                  <?php //print_r($products);?>
                      <h3><?php echo $product['name'];?></h3>
                       <p><?php echo $product['short_description'];?></p>
                      <a href="<?php echo base_url();?>product/<?php echo $product['product_id']?>">Know More</a>
                  </div>
               </div>
               <?php } else { ?>
                   <div class="col-md-6 col-sm-6">
                      <div class="row product-show">
                        <div class="col-md-6 col-sm-6">
                          <img src="<?php echo base_url();?><?php echo $product['image'];?>" alt="product-images" class="img-responsive" />
                    	</div>
	                    <div class="col-md-6 col-sm-6">
	                          <h3><?php echo $product['name'];?></h3>
	                           <p><?php echo $product['short_description'];?></p>
	                          <a href="<?php echo base_url();?>product/<?php echo $product['product_id']?>">Know More</a>
	                    </div>
                     </div>
                   </div>
				<?php }   $i++; } ?>
                   <div class="col-md-6 col-sm-6">
                     <div class="row center enquiry-div product-show">
                        <h3>Not Sure what to buy?</h3>
                        <h3>let us help you</h3>
                        <button>Submit enquiry</button>
                     </div>
                   </div>
                   
                </div> <!-- end of the row -->
                 <?php } else { ?>
		           	  <div class="row text-center">No Products Display </div>
		         <?php } ?>
           </div> <!-- end of product list -->
        </div> <!-- end of tab home -->
       
       
        <div id="menu1" class="tab-pane fade">
           
           <div class="product-list">
           <?php if(!empty($products['kits'])) { ?>
            <div class="row">
			<?php $i = 0; ?>
	        <?php foreach($products['kits'] as $product) { ?>
	         <?php if ($i == 0) {  ?>           
               <div class="col-md-12 col-sm-12 product-show1">
                  <div class="col-md-6 col-sm-6">
                      <img src="<?php echo base_url();?><?php echo $product['image'];?>" alt="product-images" class="img-responsive" />
                  </div>
                  <div class="col-md-6 col-sm-6">
                  <?php //print_r($products);?>
                      <h3><?php echo $product['name'];?></h3>
                       <p><?php echo $product['short_description'];?></p>
                      <a href="<?php echo base_url();?>product/<?php echo $product['product_id']?>">Know More</a>
                  </div>
               </div>
               <?php } else { ?>
                   <div class="col-md-6 col-sm-6">
                      <div class="row product-show">
                        <div class="col-md-6 col-sm-6">
                           <img src="<?php echo base_url();?><?php echo $product['image'];?>" alt="product-images" class="img-responsive" />
                    	</div>
	                    <div class="col-md-6 col-sm-6">
	                          <h3><?php echo $product['name'];?></h3>
	                           <p><?php echo $product['short_description'];?></p>
	                          <a href="<?php echo base_url();?>product/<?php echo $product['product_id']?>">Know More</a>
	                    </div>
                     </div>
                   </div>
				<?php }   $i++; } ?>
                </div> <!-- end of the row -->
                <?php } else { ?>
                  <div class="row text-center">No products to display for kits </div>
         		<?php } ?>
           </div> <!-- end of product list -->
        </div>  <!-- end of tab menu1 -->
        
        <div id="menu2" class="tab-pane fade">
            <div class="product-list">
            
            <?php if(!empty($products['subscription'])) { ?>
            <div class="row">
	           <?php foreach($products['subscription'] as $product) { ?>
                   <div class="col-md-6 col-sm-6">
                      <div class="row product-show">
                        <div class="col-md-6 col-sm-6">
                           <img src="<?php echo base_url();?><?php echo $product['image'];?>" alt="product-images" class="img-responsive" />
                    	</div>
                        <div class="col-md-6 col-sm-6">
                          <h3>product name</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolor.  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                          <a href="<?php echo base_url();?>product/<?php echo $product['product_id']?>">Know More</a>
                       </div>
                     </div>
                   </div>
                   <?php } ?>
              </div> <!-- End of row -->
               <?php } else { ?>
                  <div class="row text-center">No products to display for subscription </div>
               <?php } ?> 
           </div><!-- End of product list -->
        </div> <!-- end of tab menu 2-->
     
      </div> <!-- end of tab content-->
      
   </div>  <!-- end of product-section-->
</div>  <!-- end of Container-->

<script>
jQuery(document).ready(function(){
	jQuery(".cross").click(function(){
		jQuery(".pincode-section").hide();
		jQuery(".spacer").show();
    });
   
});

function checkPincode(){
    if(jQuery("#pincode").val()=='')
	  {
        //alert("Please fill Pincode");
        jQuery("#checkresponse").show();
        jQuery("#checkresponse").html("Please Fill Pincode");
	  }
	  else
	  { 
		  jQuery.post("<?php echo base_url();?>product/checkpincode",{pincode: jQuery("#pincode").val() },function(data){
			//alert(data.msg);
				if(data.status == 1)
				{
					//alert(data.msg);
					jQuery("#checkresponse").show();
					jQuery("#checkresponse").html("Product is available in your area");
					jQuery("#checkresponse").setAttribute("style", "color:green");
				} else {
					//alert(data.msg);
					jQuery("#checkresponse").show();
					jQuery("#checkresponse").html("Product is Not available in your area");
				}   
				
			},'json');  
	  }
}
</script>