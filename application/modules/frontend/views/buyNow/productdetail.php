<div class="pincode-section pincode-section-grey">
   <div class="container">
      <div class="row">
         <div class="col-md-5 col-sm-5">
           <p>Currently Offering services in limited parts of pune</p>
           <h6>you can check availability in your area here</h6>
         </div>
         <div class="col-md-6 col-sm-6">
           <form>
             <input type="text" placeholder="Enter Pincode">
             <button type="submit">Check Availability</button>
           </form>
         </div>
         <div class="col-md-1 col-sm-1">
            <img src="<?php echo asset_url();?>images/product-close.png" alt="phynart_logo" class="cross"/>
         </div>
      </div>
   </div>
 </div>
 <!--pincode available in your area -->
	 <div class="pincode-section-green pincode-section-green">
	   <div class="container">
	      <div class="row">
	         <div class="col-md-5 col-sm-5">
	           <h3>Yay. Service is available in your area</h3>
	         </div>
	         <div class="col-md-6 col-sm-6">
	         <p>Area code you entered is<br>
                411038 - Pune Kothrud <a href="#">Edit</a> <b> <a href="<?php echo base_url();?>availability">Show all areas</a></b></p>
	         </div>
	         <div class="col-md-1 col-sm-1">
	            <img src="<?php echo asset_url();?>images/product-close.png" alt="phynart_logo" class="cross1"/>
	         </div>
	      </div>
	   </div>
	 </div>
 <!--pincode available in your area -->
 <div class="spacer">
 
 </div>
  <div class="container">
     <div class="product-details">
     <?php //print_r($products);  ?>
     <input type="hidden" id="option_id" value="<?php echo $products[0]['type'];?>">
     <?php if(!empty($products[0]['image'])){?>
        <a href="<?php echo base_url();?>buynow"> <img src="<?php echo asset_url();?>images/back-1.png" alt="back" class="back-image img-responsive" />Back to Buy Now</a>
       <?php } ?>
         <div class="row">
              <div class="col-md-6 col-sm-6">
                 <div id="myCarousel" class="carousel slide" data-ride="carousel">
                   <!-- Wrapper for slides -->
                   <?php if(count($product_images) > 0){ ?>
                    <div class="carousel-inner">
               		 <?php $i=0;
               		 foreach($product_images as $image) {  ?>
                      <div class="item <?php if($i==0){ ?> active <?php }?>">
                        <img src="<?php echo asset_url().$image['image'];?>" alt=""  class="img-responsive main-product-img">
                      </div>
                    <?php $i++;} ?>
                    </div>
                <?php } ?>
                    <!-- Left and right controls -->
                    <!-- a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                    </a>
                    <ol class="carousel-indicators">
                    	<?php 
                    	$i=0;
                    	foreach($product_images as $image) { ?>
	                      <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php if($i==0){?>class="active" <?php }?>>
	                        <img src="<?php echo asset_url().$image['image'];?>" alt=""  class="img-responsive">
	                       </li>
                       <?php $i++;} ?>
                    </ol-->
                  </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <h2><?php echo $products[0]['name'];?></h2>
                <p><?php echo $products[0]['short_description'];?></p>
                 <?php   if($products[0]['type']==2) { 
                 	if(count($product_devices) > 0){
                 		foreach($product_devices as $kit){
                 	?>
                 	<p><b> <?php echo $kit['quantity']." ".$kit['name'];?></b></p>
                 	<?php }}}?> 
                  <!-- select plan ends -->
                 <?php if(($products[0]['type']==1) || ($products[0]['type']==2)) { ?>
                   <ul class="nav nav-pills">
                     <li class="active"><a data-toggle="pill" href="#detail1">One time purchase</a></li>
                     <!-- li><a data-toggle="pill" href="#detail2">Rental plan</a></li-->
                   </ul>
                   <div class="tab-content">
                      <div id="detail1" class="tab-pane fade in active">
                          <div class="row row1">
                             <div class="col-sm-5">
                                <div class="form-group space">
                                  <label for="sel1">Select Quantity</label>
                                  <input type="number" id="quantity" name="quantity" onblur="checkProductavailibility(this)" />
                                </div>
                             </div>
                             <div class="col-sm-7">
                             <?php if(count($product_offers) > 0) { 
                                             	$i=0; ?>
                               <div class="offers  row1">
                               		
                                    <h5>Offers</h5>
                                    <table>
                                        <tbody>
                                             <?php 
                                             	foreach($product_offers as $offers ){
                                             		$i++;
                                             	?>
                                             	
                                             	 <tr>
                                            		<td><?php echo $offers['title'];?></td>
                                             		 <td>&#8377; <?php echo $offers['price'];?>/-</td>
                                             	    <td class="percent">You save <?php echo getPercentage($offers['quantity'],$products[0]['unit_price'],$offers['price'])."%"; ?></td>
                                           		 </tr>
                                           		 <tr class="tr1">
                                           		 <?php if($offers['is_recommended']==1 ){?>
                                           		 	<td></td>
		                                              <td class="line-through">&#8377;<?php echo $products[0]['unit_price']*$offers['quantity'];?>/</td>
		                                              <td class="discount">Recommended</td>
                                           		 <?php } else {?>
                                           		 	<td></td>
		                                              <td class="line-through">&#8377;<?php echo $products[0]['unit_price']*$offers['quantity'];?>/</td>
		                                              <td></td>
                                           		 <?php }?>
                                           		 </tr>
                                             <?php } ?>
                                            
                                       </tbody>
                                    </table>
                                </div>
                                <?php }?>
                             </div>
                          </div>
                      </div>
                     <div id="detail2" class="tab-pane fade">
                    	 <h2> Coming Soon</h2>
                        </div>
                      </div>
                      <?php } elseif($products[0]['type']==3) {?>
		                 <!-- select plan -->
		                 	<input type="hidden" name="quantity" id="quantity" value="0"/>
		                   <div class="select-plan">
		                     <h5>Select Plan</h5>
		                          <table>
		                             <tbody>
		                             <?php foreach($product_offers as $subscription) {?>
		                               <tr><td><input type="radio" name="quantity_select" id="quantity_select" value="<?php echo $subscription['quantity'];?>" onclick="updateQuantity(<?php echo $subscription['quantity'];?>);"></td><td><?php echo $subscription['title'];?></td><td> <?php echo "Rs ".$subscription['price'];?>/-</td></tr>
		                            <?php } ?>
		                             </tbody>
		                           </table>
		                       <!-- div class="row row1 select-plan-space">
		                         <div class="col-sm-6 col-xs-6">
		                           <h5>Select UFO Controller</h5>
		                           <p>to link the subscription</p>
		                         </div>
		                         <div class="col-sm-6 col-xs-6">
		                                <div class="form-group">
		                                  <select class="form-control" id="">
		                                    <option>Home UFO - #hgsgaytdyjhgff </option>
		                                    <option>Home UFO - #hgsgaytdyjhgff</option>
		                                    <option>Home UFO - #hgsgaytdyjhgff</option>
		                                    <option>Home UFO - #hgsgaytdyjhgff</option>
		                                  </select>
		                            </div>
		                         </div>
		                      </div-->        
		                    </div> 
                    <?php } ?> 
                    
                      <!-- add to cart -->
                         <div class="row row1 bottom-row1">
                           <div class="col-sm-8 col-xs-8">
                            <?php if(($products['0']['is_instock']==1)){ ?>
                             <h4>Total <span>&#8377; <?php echo $products['0']['unit_price']; ?></span></h4>
                             <input type="hidden" id="itemprice" value="<?php echo $products['0']['unit_price']; ?>" >
                             <h6>Prices are inclusive of Taxes</h6>
                             <?php }else {?>
	                             <div class="col-sm-8 col-xs-8">
	                             	<h4>Out of Stock</h4>
	                          	 </div>
                          	 <?php }?>
                           </div>
                           <?php if(($products['0']['is_instock']==1)){ ?>
	                           <div class="col-sm-4 col-xs-4">
	                              <button class="add-to-cart-button " onclick="addItemToCart('<?php echo $products['0']['id']; ?>')";>Add to cart</button>
	                           </div>
                           <?php } else{?>
	                            <div class="col-sm-4 col-xs-4">
	                              <button class="notify-button" data-toggle="modal" data-target="#notifyme" > NOTIFY ME</button>
	                           </div>
                           <?php }?>
                        </div>
                        <!-- add to cart ends -->
                        <div class="row emi">
                        	<?php if($products['0']['karma_points'] > 0) { ?>
  						    <div class="col-sm-5 col-xs-5 inline">
  						       <img alt="icon" src="<?php echo asset_url();?>images/emi-img.png">
                                <p>Earn <?php echo $products['0']['karma_points']; ?>  karma Points</p>
  						    </div>
  						    <?php } ?>
  						    <!-- div class="col-sm-7 col-xs-7">
  						       	<p>No Cost EMIs from Rs 1,834/month
                                    Other EMIs from Rs 534/month
                                </p>
                            	<button data-toggle="modal" data-target="#emiplan" class="view-plan-button">View Plans</button>
  						    </div-->
  						</div>
  					  <!-- Get help -->
  					  	<div class="get-help">
                            <h5>Get help buying. <a href="">Chat now</a> or call <a href="tel:1-800-12-4545">1-800-12-4545</a>.</h5><br>
                            <h5>Not sure what to select?</h5>
                            <a href="<?php echo base_url();?>buynow">Buy the starter kit</a>
                        </div>    
                      <!-- Get help ends -->
                   </div>
         </div>
     </div>
     <?php 
     if($products[0]['type'] == 2){
	     if(count($product_devices) > 0) {?>
	     <!-- what's include -->
	     <div class="whats-include">
	          <div class="row">
	             <h3>What's included</h3>
	              <?php foreach($product_devices as $kit) { ?>
	            	<div class="col-md-3 col-sm-3">
	               		<a href="<?php echo base_url();?>product/<?php echo $kit['main_product_id'];?>">
	                 		<img src="<?php echo asset_url();?><?php echo $kit['image'];?>" alt="product-image" class="img-responsive"/>
	                 	</a>
	                 	<p><b> <?php echo $kit['quantity']." ".$kit['name'];?></b></p>
	               	</div>
                <?php }?>
	          </div>
	     </div>
	     <?php } ?>
     <!-- what's include ends-->
     <div class="row description">
        <div class="col-md-7">
          <h3>Description</h3>
          <p>
          <?php echo $products[0]['long_description']; ?>
           </p>
        </div>
         <div class="col-md-5">
           <h4>Please understand ownership</h4>
           <p>
             <b>
            The ownership of this product will belongs to user account making
            the product purchase. Only the owner of the devices can register
            and use the product.<br><br>
			In order for someone else to register or user the product to ufo, the
			owner will transfer the product ownership.
             </b>
           </p>
        </div>
     </div>
     <div class="row"><br/></div>
     <?php } else {?>
     <!-- what's include ends-->
     <div class="row description">
        <div class="col-md-7">
          <h3>Description</h3>
          <p>
          <?php echo $products[0]['long_description']; ?>
           </p>
        </div>
         <div class="col-md-5">
           <h4>Please understand ownership</h4>
           <p>
             <b>
            The ownership of this product will belongs to user account making
            the product purchase. Only the owner of the devices can register
            and use the product.<br><br>
			In order for someone else to register or user the product to ufo, the
			owner will transfer the product ownership.
             </b>
           </p>
        </div>
     </div>
     <?php if($products[0]['type'] == 1){ ?>
      <div class="row description">
        <div class="col-md-6">
          <h3>Product Details</h3>
          <span class="style-font1"><b>What's in the Box</b></span>
            <ul class="list-style">
            	<?php foreach ($product_components as $component) { ?>
               <li><img alt="product" src="<?php echo asset_url();?><?php echo $component['image'];?>"><p><?php echo $component['name'];?></p></li>
               <?php } ?>
            </ul>
        </div>
        <div class="col-md-6">
         <h4>Technical Specification</h4>
           <table>
             <tbody>
             	<?php foreach ($product_specs as $spec) { ?>
               	<tr>
                 	<td style="padding-right:10px;"><?php echo $spec['attr_name'];?></td>
                 	<td><?php echo $spec['attr_value'];?></td>
               	</tr>
               	<?php } ?>
             </tbody>
           </table>
        </div>
     </div> 
     <?php } ?> 
     <?php }?> 
  </div>

 <!-- EMI  MODAL -->
	<div class="modal fade" id="emiplan" role="dialog">
		 <div class="modal-dialog">
			<!-- Modal content-->
			   <div class="modal-content emi-modal">
				  <div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">EMI Options</h4>
				  </div>
				  <div class="modal-body">
					 <ul class="nav nav-pills">
					   <li class="active"><a data-toggle="pill" href="#nocostemi">No Cost EMI</a></li>
					   <li><a data-toggle="pill" href="#standardemi">Standard EMI</a></li>
					 </ul>
				   <div class="tab-content">
					 <div id="nocostemi" class="tab-pane fade in active">
					  <div class="row">
					    <div class="col-sm-4">	
						 <ul class="nav nav-pills bankemi">
						   <li class="active"><a data-toggle="pill" href="#Axis">Axis Bank</a></li>
						   <li><a data-toggle="pill" href="#Bajaj">Bajaj Finserv</a></li>
						   <li><a data-toggle="pill" href="#Citibank">Citibank</a></li>
						   <li><a data-toggle="pill" href="#HDFC">HDFC Bank</a></li>
						   <li><a data-toggle="pill" href="#HSBC">HSBC</a></li>
						   <li><a data-toggle="pill" href="#ICICI">ICICI Bank</a></li>
						   <li><a data-toggle="pill" href="#IndusInd">IndusInd Bank</a></li>
						   <li><a data-toggle="pill" href="#Kotak">Kotak Bank</a></li>
						   <li><a data-toggle="pill" href="#Standard">Standard Chartered Bank</a></li>
						   <li><a data-toggle="pill" href="#Statebankofindia">State Bank of India</a></li>
						 </ul>
					   </div>
					   <div class="col-sm-8">	 
					     <div class="tab-content">
					       <div id="Axis" class="tab-pane fade in active">
					          <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div>
					       <div id="Bajaj" class="tab-pane fade">
					         <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div>
					        <div id="Citibank" class="tab-pane fade">
					          <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div>
					        <div id="HDFC" class="tab-pane fade">
					           <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					        </div>
					        <div id="HSBC" class="tab-pane fade">
					           <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div> 
					       <div id="ICICI" class="tab-pane fade">
					          <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div>
					        <div id="IndusInd" class="tab-pane fade">
					         <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div>
					        <div id="Kotak" class="tab-pane fade">
					         <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div>
					        <div id="Standard" class="tab-pane fade">
					         <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div>
					        <div id="Statebankofindia" class="tab-pane fade">
					         <h5>AXIS BANK EMI PLANS</h5>
					             <table>
					                <tbody>
					                    <tr><th>Months</th><th>Monthly EMI</th><th>Overall Cost</th></tr>
               							<tr><td>3</td><td>â‚¹5000 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>6</td><td>â‚¹2500 @ No Cost</td><td>â‚¹14999</td></tr>
               							<tr><td>9</td><td>â‚¹1667 @ No Cost</td><td>â‚¹14999</td></tr>
               					    </tbody>		
					             </table>
					       </div>
					      </div>   
					    </div>
					  </div>
					 </div>
					  <div id="standardemi" class="tab-pane fade">
					  </div>
				     </div>
				   </div>
			   </div>
		 </div>
     </div>
<!-- EMI  MODAL ENDS-->
	
<!--NOTIFY MODAL	-->		
	<div class="modal fade notifyme" id="notifyme" role="dialog">
		 <div class="modal-dialog">
			<!-- Modal content-->
			   <div class="modal-content emi-modal">
				  <div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Enter your details</h4>
				  </div>
				  <div class="modal-body notifyme-modal">
					  <form>
						  <div class="form-group">
						    <input type="text" class="form-control" id="" placeholder="Name">
						  </div>
						  <div class="form-group">
						    <input type="email" class="form-control" id="" placeholder="Email">
						  </div>
						   <div class="form-group">
						    <input type="text" class="form-control" id="" placeholder="Phone Number">
						   </div>
						  <button type="submit" class="notify-modal-button">Notify Me</button>
					  </form>
				  </div>
			   </div>
		 </div>
     </div>			 
<!--NOTIFY MODAL ENDS -->	

<!--Rental - Terms and Conditions Modal-->
	<div id="TermsandConditions" class="modal fade terms-modal" role="dialog">
	   <div class="modal-dialog">
	      <!-- Modal content-->
	         <div class="modal-content">
				  <div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Rental - Terms and Conditions</h4>
				  </div>
				<ol>
				  <li>If minimum contract period is not completed, amount will cut from deposit on return of the product.</li>
				  <li>If amount is not paid for rent months, it shall be cut from the deposit a week after its overdue in every month.</li>
				  <li>If deposit amount goes below x amount, device will be suspended. To start the device again, penalty charges will
					  apply (1000 rs), also user will need to refill deposit amount for all the months for which deposit was cut for rent to
					  continue to use the device.</li>
				  <li>On return of product. 14 working days will be required to process, deposit refund. Product will checked for
					  damages.</li>
				  <li>Product will be returned with the complete packaging and materials given at the start of the plan. Otherwise a
					  certain amount of the deposit will be chargeable.</li>
				  <li>On return of the product. All ufo configurations will be reset for ufo, for devices all device configurations will be
					  reset.</li>
				  <li>One re-installation free every year per device. Charges for installation when moving house will be paid upfront
				      when there is no free re-installation.</li>
				  <li>If device stops working while in use, device shall be taken back and assessed. If it is customerâ€™s fault due to
					  tampering or water damage, amount shall be cut from deposit for repair and service cost and device will be
					  returned to user, after user recharges deposit amount, if user still wants to use device, otherwise balance amount
					  of deposit shall be refunded. If itâ€™s not the customers fault, no deposit or service cost shall be charged and the
					  device will be replaced, also number of days will be extended for time taken to replace.</li>
				  <li>Free re-installation once every year, after which charges will apply. Free re-installations will not carry forward into
					  the next year. It will expire every year.</li>
				  <li>Customer can convert this plan into a purchase anytime, but in this case rent already paid will not be refunded.</li>
				          
				</ol>  
			  </div>	  
		  </div> 
	 </div>  				 
<!--Rental - Terms and Conditions Modal ends -->	
<?php 
function getPercentage($qty, $productprice, $optPrice){
	$data =0;
	$product_price = $productprice*$qty;
	$diff_price = $product_price - $optPrice;
	if($diff_price != 0 && $product_price != 0){
		$data = round(($diff_price/$product_price)*100,2);
	}
	return $data;
}

?>
<script>
jQuery(document).ready(function(){
	jQuery(".cross").click(function(){
		jQuery(".pincode-section").hide();
		jQuery(".spacer").show();
   });
  
});
jQuery(document).ready(function(){
	jQuery(".cross1").click(function(){
		jQuery(".pincode-section-green").hide();
		jQuery(".spacer").show();
   });
  
});
</script>

<script>
function updateQuantity(qty) {
	$('#quantity').val(qty);
}
function addItemToCart(itemid) {
	var option_id = $('#option_id').val();
	var price = $('#itemprice').val();
	var quantity = $('#quantity').val();
	
	if(quantity == 0)
	{
 		alert("Please select quantity");
 		jQuery("#qtyresponse").show();
 		jQuery("#qtyresponse").html("Quantity should be greater than zero");
	     return false;
	}
	jQuery.post(base_url+"additemtocart",{itemid: itemid, option_id: option_id, quantity: quantity, price: price },function(data) {
		getCartCount();
		if(data.status == 1) {
			<?php if(!empty($_SESSION['olouserid'])) { ?>
				alert("Product added to cart");
				window.location.href = base_url+"purchase-flow";
			<?php } else { ?>
				window.location.href = base_url+"login";
			<?php } ?>
		} else {
			$("#su_response").show();
			$("#su_response").html(data.msg);
		}
	},'json');
}

function getCartCount() {
	jQuery.get(base_url+"getcartcount",{ },function(data) {
		if(data.cart_cnt > 0) {
				//alert(data.cart_cnt);
				//$("#cart_count").html(data.cart_cnt);
				//$("#cart_countmo").html(data.cart_cnt);
				var html = '<span class="cart-no" id="cart_count">'+data.cart_cnt+'</span>';
			} else {
				//$("#cart_count").html(0);
				//$("#cart_countmo").html(0);
				var html = '';
			}
		jQuery("#cart-li").html(html);
		jQuery("#cart-limo").html(html);
	},'json');
}
</script>