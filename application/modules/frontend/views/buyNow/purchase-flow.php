<div class="container">
	<div class="row">
		<section>
        <div class="wizard">
            <div class="wizard-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active">
                        <a href="#ShoppingCart" data-toggle="tab" aria-controls="ShoppingCart" data-placement="bottom" role="tab" title="Shopping Cart">
                            <span class="round-tab round-tab1">
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#ShippingDetails" data-toggle="tab" aria-controls="ShippingDetails" data-placement="bottom" role="tab" title="Shipping Details">
                            <span class="round-tab round-tab2">
                            </span>
                        </a>
                    </li>
                    
                    <li role="presentation" class="disabled">
                        <a href="#OrderSummary" data-toggle="tab" aria-controls="OrderSummary"  data-placement="bottom" role="tab" title="Order Summary">
                            <span class="round-tab round-tab3">
                            </span>
                        </a>
                    </li>

                    <li role="presentation" class="disabled">
                        <a href="#PaymentDetails" data-toggle="tab" aria-controls="PaymentDetails" data-placement="bottom" role="tab" title="Payment Details">
                            <span class="round-tab round-tab4">
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
		<?php //print_r($cart);?>
                <div class="tab-content">
                
                <!-- Shopping Cart -->
                    <div class="tab-pane active" role="tabpanel" id="ShoppingCart">
                       <h3>Shopping Cart</h3>
                       <?php if(!empty($cart['cartitems'])){ ?>
                       
                       <!-- cart details-1 starts -->
                       <?php foreach($cart['cartitems'] as $productcart) { ?>
                         <div class="row cart-section1">
                             <div class="col-md-2 col-sm-3">
                     			 <img src="<?php echo asset_url();?><?php echo $productcart['image'];?>" alt="phynart_logo" class="cart-img img-responsive" />
                             </div>
                             
                             <div class="col-md-4 col-sm-5 col-md-4-custom">
                                <h3><?php echo $productcart['name']; ?></h3>
                                <p><?php echo $productcart['long_description'];?></p>
                                <p class="inline"><img src="<?php echo asset_url();?>images/karma.png" alt="karma" class="karma-img img-responsive" /><?php if(!empty($productcart['karma_points'])) { ?>You are earning <?php echo $productcart['karma_points'];?> Karma Points<?php } ?></p>
                                	  
                             </div>
                             
                             <div class="col-md-2 col-sm-2 col-md-2-custom">
                                <div class="inline">
                                  	<h4 class="qty">QTY</h4>
                                  	<input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $productcart['cartquantity']; ?>" readonly/>
                                </div>   
                                <button type="button" class="remove" onclick="deleteItemFromCart(<?php echo $productcart['product_id']; ?>,<?php echo $productcart['option_id']; ?>);">REMOVE</button>  
                             </div>
                             <div class="col-md-2 col-sm-1 col-md-2-custom">
                                <h5>(&#8377; <?php echo $productcart['cartprice']; ?>)</h5>
                                <!--<p>Refundable <br>deposit</p>-->
                             </div>
                             <div class="col-md-2 col-sm-1 col-md-2-custom">
                                <h5>(&#8377; <?php echo $productcart['totalprice']; ?>)</h5>
                               <!-- <h6 class="line-through">&#8377; 50,000</h6>-->
                             </div>
                        </div>
                        <?php } ?>
                        <!-- cart details-1 ends -->
                        
                        <!-- total of cart -->
                        <div class="cart-section row">
                            <div class="col-md-9 col-sm-8">
                            
                               <!-- gift section starts-->
                                 <div class="inline">
                                   <label class="lmargin"  onclick="checkIsGift();">
                                      <input type="checkbox" class="input1" name="is_gift" id="is_gift">
                                      <span class="checkmark" id="is_forgift"></span>
                                    </label>
                                    
                                    <h5>This is a Gift</h5>
                                  </div>  
                                <p class="fmargin">Your purchases are linked with your account for security reasons<br> If you are planning to gift this to some please tell us now.</p>
                                <!-- Gift Wrapping checkbox-->
                                  <div class="gift">
                                    <div class="inline">
                                       <label class="lmargin1">
                                         <input type="checkbox" name="is_wraping" class="input1" id="is_wraping" /><span class="checkmark1"></span>
                                       </label> 
                                        <p><b>Gift Wrapping</b></p><br>
                                     </div>   
                                     <p class="fmargin">Remove price tags and wrap in a nice gift paper</p>
                                   </div>
                                <!-- Gift Wrapping checkbox ends-->
                              <!-- gift section ends-->  
                              
                            </div>
                            <div class="col-md-3 col-sm-4 right">
                               <!-- <h5 class="green yousave ">You saved &#8377;15,000</h5>-->
                                 <div class="total row">
                                    <div class="col-sm-6 col-xs-6">
                                        <p>Subtotal</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                         <!-- <p class="line-through">&#8377; 50,000/-</p>-->
                                         <p>&#8377; <?php echo $cart['subtotal']; ?>/-</p>
                                    </div>
                                 </div>
                                 <div class="total row">
                                    <div class="col-sm-6 col-xs-6">
                                        <p>Shipping (Free)</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                         <p>&#8377; 0/-</p>
                                    </div>
                                 </div>
                                 <div class="total row">
                                    <div class="col-sm-6 col-xs-6">
                                        <p>GST</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                         <p>&#8377; 0/-</p>
                                    </div>
                                 </div>
                                 <div class="total row">
                                    <div class="col-sm-6 col-xs-6">
                                        <p><b>Total</b></p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                         <p><b>&#8377; <?php echo $cart['subtotal']; ?>/-</b></p>
                                    </div>
                                </div>
                               <span class="green">*All the prices are inclusive of Taxes</span>
                            </div>
                        </div>
                        <!-- total of cart -->
                        
                        <ul class="list-inline pull-right main-section">
                            <li><button type="button" class="next-step next" id="shoppingcartbutton" >Next</button></li>
                        </ul>
                        
                        <?php } else { ?>
                        	<div class="row cart-section1">
                        		 <div class="transaction-failed">
                                       <div class="center">
                                          <img src="<?php echo asset_url();?>images/failed.png" alt="Cart Empty"  class="failed-img"/>
                                          <h3>Sorry your cart is empty!</h3>
                                          <!--<h5>Transaction/Order ID: 2001234432</h5><br>
                                          <h4>Your card was declined for following reason:</h4>
                                       <ul class="list-style-type">
                                         <li>You have entered a wrong card number.</li>
                                         <li> >Your card type is not accepted by our payment gateway.</li>
                                         <li> >Incorrect expiry card expiry date or COther exceptions - In which case you would need to check with the card issuing bank.</li>
                                         <li> Please check, if you have entered the correct billing address corresponding to the credit/debit card used.</li>
                                       </ul> -->
                                        <a href="<?php echo base_url()?>buynow" class="next1">Continue Shopping</a>
                                       </div>
                                    </div>
                       		</div>
                        <?php } ?>
                        
                    </div>
                <!-- Shopping Cart Ends-->  
                
                <!-- Shipping Details --> 
                    <div class="tab-pane" role="tabpanel" id="ShippingDetails">
                         <div class="row">
                            <div class="col-md-8 address">
                          		<div id="shipping_address">
                          			<h3>Shipping Details</h3>
                                	<!-- address section starts -->
	                             	<ul class="nav nav-pills">
	                                    <li id="tabsave_add" class="active"><a data-toggle="pill" href="#SavedAddress">Saved Address</a></li>
	                                    <li id="tabadd_add"><a data-toggle="pill" href="#AddNewAddress">Add New Address</a></li>
	                              	</ul>
                                 	<div class="tab-content">
	                                    <div id="SavedAddress" class="tab-pane fade in active">
	                                      <!-- address 1 --> 
	                                     <div id="saveduseraddress"></div>
	                                     <div id="saveduseraddressdisplay">
	                                      <?php if(!empty($useraddress)){ ?>
	                                      <?php $i=0; ?>
	                                      <?php foreach($useraddress as $address){ ?>
	                                         <div class="row indivisual-address-div">
	                                            <div class="col-sm-1">
	                                                <input type="radio" name="saveaddress" id="add1" value="<?php echo $address['id'];?>" onClick="selectMyAddress(<?php echo $address['id'];?>);" />
	                                             </div>  
	                                            <div class="col-sm-4">
	                                                <h4><?php echo $address['address_name'];?></h4>
	                                                <p><?php echo $address['address'];?>,<?php echo $address['apt_no'];?>,
	                                                   <?php echo $address['locality'];?>,
	                                                   <?php echo $address['landmark'];?>,<?php echo $address['pincode'];?>
	                                                 <p>
	                                            </div>
	                                            <div class="col-sm-3">
	                                               <h5>Mobile Number</h5>
	                                               <h4><b id="mobile-<?php echo $address['id'];?>"><?php echo $olousermobile; ?></b></h4>
	                                            </div>
	                                            <div class="col-sm-4">
	                                               <h5>Email Address</h5>
	                                               <h4><b><?php echo $olouseremail; ?></b></h4>
	                                            </div>
	                                        </div>
	                                        <?php $i++; 
	                                        if($i==2) break;
											}  ?>
	                                        
	                                        <?php if(count($useraddress) > 2){?>
	                                          <button class="viewalladdress">View all <?php echo count($useraddress)-2; ?> addresses</button>
	                                       <?php } ?>
	                                         <div class="showalladdress">
	                                              
	                                                <?php $i=0; ?>
				                                      <?php foreach($useraddress as $address){ ?>
				                                      <?php if($i > 1) { ?>
				                                         <div class="row indivisual-address-div">
				                                            <div class="col-sm-1">
				                                                <input type="radio" name="saveaddress" id="add1" value="<?php echo $address['id'];?>">
				                                             </div>  
				                                            <div class="col-sm-4">
				                                                <h4><?php echo $address['address_name'];?></h4>
				                                                <p><?php echo $address['address'];?>,<?php echo $address['apt_no'];?>,
				                                                   <?php echo $address['locality'];?>,
				                                                   <?php echo $address['landmark'];?>,<?php echo $address['pincode'];?>
				                                                 <p>
				                                            </div>
				                                            <div class="col-sm-3">
				                                               <h5>Mobile Number</h5>
				                                               <h4><b id="mobile-<?php echo $address['id'];?>"><?php echo $olousermobile; ?></b></h4>
				                                            </div>
				                                            <div class="col-sm-4">
				                                               <h5>Email Address</h5>
				                                               <h4><b><?php echo $olouseremail; ?></b></h4>
				                                            </div>
				                                        </div>
				                                        <?php } ?>
				                                        <?php $i++; }  ?>
	                                         </div>
	                                         <?php } else { ?>
	                                         	<h4 class="text-center">No Saved address </h4>
	                                         <?php }  ?>
	                                         </div>
	                                      </div>
                                      
	                                     <div id="AddNewAddress" class="tab-pane fade">
	                                          <a class="current-location" data-toggle="modal" data-target="#confirm-address">Use my current location</a>
	                                       <!-- new address form -->
	                                          <form class="form-horizontal AddNewAddress" method="post" id="new_add_frm" name="new_add_frm" action="#">
	                                              <input type="hidden" id="userid" value="<?php echo $olouserid; ?>" name="userid">
	                                             <?php $olousername;
	                                              		$user = explode(" ",$olousername);
	                                              		$fname = $user[0];
	                                              		$lname = $user[1];
	                                              ?>
	                                              
	                                            <div class="form-group">
	                                              <div class="col-sm-4">
	                                                <input type="text" class="form-control" id="fname" value="<?php echo $fname;?>" placeholder="First Name" name="fname">
	                                              </div>
	                                              <div class="col-sm-4">
	                                                <input type="text" class="form-control" id="lname" value="<?php echo $lname;?>" placeholder="Last Name" name="lname">
	                                              </div>
	                                            </div>
	                                            
	                                            <div class="form-group is-empty">
	                                              <div class="col-sm-4">  
	                                                <div>
	                                                  <input type="text" class="form-control" id="address_name" placeholder="Address Name" name="address_name">
	                                                </div>
	                                               <div class="messageContainer"></div>
	                                              </div>
	                                            </div>
	                                            
	                                            <div class="form-group">
	                                              <div class="col-sm-4">
	                                              	<div>
	                                                  <input type="text" class="form-control" id="address" placeholder="Address line 1" name="address">
	                                              	</div>
	                                              	<div class="messageContainer"></div>
	                                              </div>
	                                               <div class="col-sm-4">          
	                                                <input type="text" class="form-control" id="apt_no" placeholder="Apt No" name="apt_no">
	                                               </div>
	                                            </div>
	                                            
	                                            <div class="form-group">
	                                              <div class="col-sm-4">
	                                                <div>
	                                              	<input type="hidden" name="latitude" id="latitude" value="" />
													<input type="hidden" name="longitude" id="longitude" value="" class="form-control"/>     
	                                                <input type="text" class="form-control" id="locality" placeholder="Address line 2" name="locality">
	                                              	</div>
	                                               <div class="messageContainer"></div>
	                                              </div>
	                                               <div class="col-sm-4">          
	                                                <input type="text" class="form-control" id="landmark" placeholder="(Landmark)" name="landmark">
	                                               </div>
	                                            </div>
	                                            
	                                            <div class="form-group">
	                                              <div class="col-sm-4">          
	                                                <input type="text" class="form-control" id="pincode" placeholder="Pincode" maxlength="6" value="" name="pincode">
	                                              </div>
	                                               <div class="col-sm-4">          
	                                                <input type="text" class="form-control" id="city" placeholder="City" name="city">
	                                               </div>
	                                               <div class="col-sm-4">          
	                                                <input type="text" class="form-control" id="state" placeholder="State" name="state">
	                                               </div>
	                                            </div>
	                                            
	                                            <div class="form-group">
	                                              <div class="col-sm-4">          
	                                                <input type="text" class="form-control" id="mobile" value="<?php echo $olousermobile; ?>" placeholder="Mobile No" name="mobile">
	                                              </div>
	                                               <div class="col-sm-4">          
	                                                <input type="text" class="form-control" id="email" value="<?php echo $olouseremail; ?>" placeholder="Email" name="email">
	                                               </div>
	                                            </div>
	                                            
	                                            <div class="form-group"> 
	                                              <div class="radio"> 
	                                                <div class="col-sm-4">  
	                                                  <label><input type="radio" value="0" id="address_opt" name="address_opt"><p>This is a Business Address</p><span>Delivery between 10am and 5pm</span></label>
	                                                </div>
	                                                <div class="col-sm-4">  
	                                                  <label><input type="radio" value="1" id="address_opt" name="address_opt"><p>This is a Home Address</p><span>All day delivery</span></label>
	                                                </div>
	                                             </div>
	                                            </div>
	                                            
	                                            <div class="form-group">        
	                                              <div class="col-sm-10">
	                                                <button type="submit" class="save-add-button">Save</button>
	                                              </div>
	                                            </div>
	                                            
	                                          </form>
	                                       <!-- new address form -->
	                                    </div>
                                 	</div> 
                                 </div>
                                  <!-- gift section starts-->
                                  <div class="gifteesdetails" id="gifteesdetails" style="display:none;">
                                    <h3>This is a Gift</h3>
                                    <h4>Enter the giftee's details</h4>
                                       <div class="form-horizontal AddNewAddress">
                                            <div class="form-group">
                                              <div class="col-sm-4">
                                                <input type="text" class="form-control" id="gi_fname" placeholder="First Name" name="gi_fname">
                                              </div>
                                              <div class="col-sm-4">
                                                <input type="text" class="form-control" id="gi_lname" placeholder="Last Name" name="gi_lname">
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <div class="col-sm-4">
                                                <input type="text" class="form-control" id="gi_email" placeholder="Email" name="gi_email">
                                              </div>
                                              <div class="col-sm-4">
                                                <input type="text" class="form-control" id="gi_mobile" placeholder="Mobile" name="gi_mobile">
                                              </div>
                                            </div>
                                        </div>    
                                   </div>   
                                  <!-- gift section ends-->
                                 
                              </div>
                            
                           <!-- address section ends --> 
                           
                             <div class="col-md-4 cart1">
                               
                                 <div class="row">
                                   <h3>Cart</h3>
                                   <div class="col-sm-6 col-xs-6">
                                        <p><b>Order Total</b></p>
                                        <!-- p>Refundable Deposit</p>
                                        <p>(&#8377; 35,500)</p-->
                                    </div>
                                    <div class="col-sm-6 col-xs-6 right">
                                         <p><b>&#8377; <?php echo $cart['subtotal']; ?>/-</b></p>
                                         <?php if($cart['savings'] > 0) { ?>
                                         <p class="green">You saved &#8377; <?php echo $cart['savings'];?></p>
                                         <?php } ?>
                                    </div>
                                  </div>
                                 <?php foreach($cart['cartitems'] as $productcart) { ?>
                                  <div class="row margin-topp1 font-style1">
                                    <div class="col-sm-6 col-xs-6">
                                        <p><?php echo $productcart['name']; ?></p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 right">
                                         <p>(&#8377; <?php echo $productcart['totalprice']; ?>)</p>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-6 col-xs-6">
                                      <p><?php echo $productcart['cartquantity']; ?></p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                    </div>
                                 </div>  
                                 <!--<div class="row">
                                    <div class="col-sm-6 col-xs-6">
                                     <p>Rental plan - Monthly</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 right">
                                    <p>&#8377; 1,500</p>
                                    </div>
                                 </div>--> 
                               <?php } ?>
                            </div>
                       </div>  
                         <div class="row order-summary">
                            <div class="col-md-8">
                              <h4>Understand ownership</h4>
                              <p>The ownership of this product will belongs to user account making the product purchase.<br>
                               Only the owner of the devices can register and use the product.</p>
                              <p> In order for someone else to register or user the product to ufo, the owner will <br>transfer the product ownership.</p>
                            </div>
                             <div class="col-md-4">
                                <ul class="list-inline pull-right">
                                    <!-- <li><button type="button" class="btn btn-default prev-step">Previous</button></li> -->
                                    <li><button type="button" class="next next-step" id="shippingdetailsbutton">Order Summary</button></li>
                                </ul>
                            </div>
                         </div>
                     </div>
                <!-- Shipping Details ends --> 
                 
                <!-- Order Summary -->   
                    <div class="tab-pane" role="tabpanel" id="OrderSummary">
                        <h3>Review &#38; Confirm</h3>
                          <div class="row OrderSummary">
                             <div class="col-sm-8">
                                <h4 class="font-size-25">Cart</h4>
                                     <!-- cart details-1 starts -->
                                   <?php foreach($cart['cartitems'] as $productcart) { ?>
                                         <div class="row cart-section1">
                                             <div class="col-md-3 col-sm-3 custom-col-3">
                                     			 <img src="<?php echo asset_url();?><?php echo $productcart['image'];?>" alt="phynart_logo" class="cart-img1 img-responsive" />
                                             </div>
                                             <div class="col-md-9 col-sm-9 custom-col-9">
                                                <div class="row">
                                                  <div class="col-md-8 col-sm-5">
                                                    <h5><?php echo $productcart['name']; ?></h5>
                                                    <p><?php echo $productcart['cartquantity']; ?></p>
                                                    <p class="custom-p"><?php echo $productcart['long_description'];?></p>
                                                    <input type="hidden" name="karmapoint" value="20">
                                                    <?php if($productcart['karma_points'] > 0) { ?>
                                                    <p class="inline"><img src="<?php echo asset_url();?>images/karma.png" alt="karma" class="karma-img img-responsive" />You are earning <?php echo $productcart['karma_points'];?> Karma Points</p>
                                                    <?php } ?>
                                                  </div>
                                                  <div class="col-md-2 col-sm-3">
                                                     <!--<h5>(&#8377; 7500)</h5>
                                                     <p>Refundable <br>deposit</p>-->
                                                     <p>QTY <?php echo $productcart['cartquantity']; ?></p>
                                                  </div>
                                                  <div class="col-md-2 col-sm-3">
                                                    <h5>(&#8377; <?php echo $productcart['totalprice'];?>)</h5>
                                                    <!--<h6 class="line-through">&#8377; <?php echo $productcart['totalprice'];?></h6>-->
                                                  </div>
                                                </div>
											 <!--<div class="row">
                                                 <div class="col-md-8 col-sm-5">
                                                    <h5>Rental Plan</h5>
                                                    <p>Monthly plan</p>
                                                 </div>
                                                 <div class="col-md-2 col-sm-3">
                                                    <h5>&#8377; 1100</h5>
                                                 </div>
                                                 <div class="col-md-2 col-sm-3">
                                                    <h5>&#8377; 5,000</h5>
                                                 </div>
                                             </div>-->
                                           </div>
                                         </div>
                                    <?php } ?>
                                   <!-- total amount-->
                                      <div class="fright margin-custom-4"> 
                                         <h4>Total  <span class="fright">&#8377; <?php echo $cart['subtotal']; ?>/-</span></h4>
                                         <!--<h4 class="green">You saved &#8377;15,000</h4>-->
                                      </div>
                                   <!-- total amount ends-->
                               </div> 
                                 
                             <div class="col-sm-4 add-display">
                                <h4 class="font-size-25">Shipping Details</h4>  
                                <h5 class="custom-margin-12">Address</h5>
                                <div id="shippingaddressdetails"></div>
                                
                                <!-- <p><b>Ashish Sharma</b></p>
                                <p>Plot no 10, Karishma Society Kothrud Colony,
                                   (Opp to the petrol pump)</p>
                                <p>Pune 311038 Maharashtra</p> 
                                <p><b>+91-9876-654321</b></p>  
                                <p><b>ashish.sharma@gmail.com </b></p>-->
                                
                                <p class="blue">Dispatched in 2-3 business days from date of Purchase.</p>
                                <div style="display:none;" id="gifty_address">
                                 <!-- gift section starts-->
                                   	<h5 class="custom-margin-12 pink">This is a gift</h5>
                                   	<h5>Giftee Details</h5>
                                   	<div style="font-weight:bold;">
                                   		<span id="gifname"></span>&nbsp;<span id="gilname"></span>
                                   	</div>
                                   	<div>
                                   		<span id="gifemail"></span><br>
                                   		<span id="gilmobile"></span>
                                   	</div>
                                   <p id="giaddress"></p>
                                   <br>
                                   <p>Giftee fills out the address</p>
                                   <a href="" class="blue">Understand ownership Here</a>
                                 <!-- gift section ends-->
                              	</div>
                              </div>
                          </div>
                         <ul class="list-inline pull-right main-section">
                            <li><button type="button" class="next next-step" id="proceedtopaybutton">Proceed to Pay</button></li>
                        </ul>
                    </div>
                 <!-- Order Summary ends --> 
                   
                 <!-- Payment Details -->
                    <div class="tab-pane" role="tabpanel" id="PaymentDetails">
                        <h3>Payment Method</h3>
                          <div class="row PaymentDetails">
                             <div class="col-sm-8">
                                 <!-- Payment Methods -->
                                    <div class="row">
                                       <div class="col-sm-3">
                                          <ul class="nav nav-pills payment-method-tab">
                                              <li class="active"><a data-toggle="pill" data-id="1" href="#SavedCard">Saved Card</a></li>
                                              <li><a data-toggle="pill" data-id="1" href="#Cardpayment">Card payment</a></li>
                                              <li><a data-toggle="pill" data-id="1" href="#EMI">EMI</a></li>
                                              <li><a data-toggle="pill" data-id="1" href="#NetBanking">Net Banking</a></li>
                                              <li><a data-toggle="pill" data-id="1" href="#E-wallets">E-wallets</a></li>
                                              <li><a data-toggle="pill" data-id="0" href="#CashOnDelivery">Cash On Delivery</a>
                                                  <!-- span class="applied"><img src="<?php echo asset_url();?>images/check.png" alt="Applied" class="Applied-img img-responsive" />Applied</span>
                                                  <a href="#" class="cancel"> Cancel</a-->
                                              </li>
                                              <li><a data-toggle="pill" data-id="2" href="#karmaPoints">Karma Points<span class="block"><?php if(!empty($wallet[0]['amount'])) { echo $wallet[0]['amount']; } else { ?>0<?php } ?> Points</span> </a>
                                                  <!-- span  class="applied"><img src="<?php echo asset_url();?>images/check.png" alt="Applied" class="Applied-img img-responsive" />100 Applied</span>
                                                  <span class="cancel">Remove</span-->
                                              </li>
                                           </ul>
                                       </div>
                                       <div class="col-sm-9">
                                           <div class="tab-content payment">
                                              <div id="SavedCard" class="tab-pane fade in active">
                                                 <!-- <form>-->
                                                    <div class="radio">
                                                      <label><input type="radio" name="SavedCard">HDFC Bank Debit Card - (Mastercard) 67xx xxxx xxxx xx29</label><br>
                                                      <input type="text" placeholder="CVV" class="cvv"/>
                                                    </div>
                                                    <div class="radio">
                                                      <label><input type="radio" name="SavedCard">ICICI Bank Credit Card - (Visa) 48xx xxxx xxxx xx10</label><br>
                                                      <input type="text" placeholder="CVV" class="cvv" />
                                                    </div>
                                                  <!--</form>-->
                                              </div>
                                              <div id="Cardpayment" class="tab-pane fade">  
                                                 <!--<form>-->
                                                  <label class="radio-inline"><input type="radio" name="Cardpayment">Credit Card</label>
          										 <label class="radio-inline"><input type="radio" name="Cardpayment">Debit card</label>
          										   <select class="form-control  style-1" id="">
                                                        <option> Select Card issuer </option>
                                                        <option>ICICI Bank Credit Card</option>
                                                        <option>HDFC Bank Visa Credit Card</option>
                                                        <option>ICICI Bank Credit Card</option>
                                                      </select>
                                                      <input type="text" placeholder="Card number" class="input11"/>
          										     <div class="inline width100">
          										       <input type="text" placeholder="Mm/Year" class="cvv1"/>
          										       <input type="text" placeholder="CVV" class="cvv1"/>
          										     </div> 
          										<!-- </form>-->
          										<br>
          										<p>We automatically save this Card for future Purchases <span class="blue">Know more</span></p>
          									</div>
                                              <div id="EMI" class="tab-pane fade">
                                                 <ul class="nav nav-pills emi-tap">
                                                    <li class="active "><a data-toggle="pill" href="#CreditCard">Credit Card</a></li>
                                                    <li><a data-toggle="pill" href="#CardlessEMI">Cardless EMI</a></li>
                                                  </ul> 
                                                  <br>
                                                  <div class="tab-content">
                                                     <div id="CreditCard" class="tab-pane fade in active">
                                                       <p class="blue">Phynart offers No cost EMI</p>
                                                         <!-- <form>-->
                  										   <select class="form-control style-1" id="">
                                                                <option> Select Card issuer </option>
                                                                <option>ICICI Bank Credit Card</option>
                                                                <option>HDFC Bank Visa Credit Card</option>
                                                                <option>ICICI Bank Credit Card</option>
                                                              </select>
                                                              <input type="text" placeholder="Card number"/>
                  										     <div class="inline width100">
                  										       <input type="text" placeholder="Mm/Year" class="cvv1"/>
                  										       <input type="text" placeholder="CVV" class="cvv1"/>
                  										     </div> 
                  										<!--</form>-->
                  										<p>Pay with Easy montly installments from any of these options below</p>
                  										<!-- EMI options -->
                  										   <table class="custom-table">
                  										      <tbody>
                  										        <tr><td><input type="radio" name="EMIbyMONTHS"></td><td>&#8377; 10,000 for 9 months</td><td>@ 12% p.a.</td></tr>
                  										        <tr><td><input type="radio" name="EMIbyMONTHS"></td><td>&#8377; 15,000 for 6 months</td><td>@ 12% p.a.</td></tr>
                  										        <tr><td><input type="radio" name="EMIbyMONTHS"></td><td>&#8377; 20,000 for 3 months</td><td>@ 12% p.a.</td></tr>
                  										      </tbody>
                  										   </table>
                  										<!-- EMI options ends-->
                  									<p>Phynart does not levy any charges for using EMI. If there are any charges they are placed by your bank not us. Please check with your bank for any additional information regarding this.</p>	
                                                      </div>
                                                      <div id="CardlessEMI" class="tab-pane fade"><br>
                                                        <h4>Available options</h4>
                                                        <button type="button" class="blue-border">Zestmoney</button><br>
                                                        <button type="button" class="blue-border">Snapmint</button>
                                                        <h4 class="pink">Your cart value is below 5000,<br>
                                                            To use this option the cart value has <br>to be more than 5000</h4>
                                                      </div>
                                                   </div> 
                                               </div>
                                               <div id="NetBanking" class="tab-pane fade">
                                                  <select class="form-control style-1" id="">
                                                      <option>Select Bank </option>
                                                      <option>ICICI Bank</option>
                                                      <option>HDFC Bank</option>
                                                      <option>SBI</option>
                                                      <option>Panjab National Bank</option>
                                                      <option>Axis Bank</option>
                                                      <option>Yes Bank</option>
                                                  </select>
                                                  <p><b>You'll be securely redirected to your Bank to enter <br>your password and complete your purchase.</b></p>
                                              </div>
                                              <div id="E-wallets" class="tab-pane fade">
                                            
                                              </div>
                                               <div id="CashOnDelivery" class="tab-pane fade">
                                                <!-- Confirm mobile number -->
                                                  <div class="confirmation" id="confirm_mobile_1">
                                                     <h4>Confirm mobile number</h4>
                                                     <p><b>+91 <span id="selected_mobile"></span></b></p>
                                                     <button type="button" class="blue-border" onclick="sendMobileVerification();">Send Verification code</button>
                                                  </div>  
                                                 <!-- Confirm mobile number ends -->
                                                 <!-- otp section -->
                                               	<div class="otp" id="confirm_mobile_2">
                                                	<h4>Enter 6 Digit OTP sent <a href="javascript:resendMobileVerification();" class="blue custom-a">Resend Verification code</a> to your mobile number +91 <span id="selected_mobile1"></span> <a href="#" class="blue custom-a">Edit Number</a></h4>
                                                  	<input type="text" placeholder="Enter OTP here" id="orderotp" name="orderotp"/><br>
                                                 	<button type="button" class="blue-border" onclick="validateMobile();">Confirm</button>
                                               	</div>   
                                                 <!-- otp section ends-->
                                                 <!-- mobile no Verified -->
                                              	<div class="verified" id="confirm_mobile_3">
                                                 	<p><b>Mobile number</b></p>
                                                  	<h4>+91 <span id="selected_mobile2"></span></h4>
                                                   	<h4 class="blue">Verified</h4><br>
                                              	</div>
                                              	<div style="display:none;">
                                                    <br>
                                                    <h4>To process Cash on Delivery, You need to pay &#8377;1,000/-</h4> <br>
                                                    <button type="button" class="blue-border">Apply</button><br><br>
                                                    <p class="pink">This will not be refundable once product is shipped.
													 Refund will available only if you cancel the order before it is dispatched</p>
												</div>
                                                 <!-- mobile no Verified ends-->
                                           	</div>
                                          	<div id="karmaPoints" class="tab-pane fade"> 
                                              	<div class="row Current-balance">
                                                  	<div class="col-sm-6">
                                                       	<p><b>Current Balance</b></p>
                                                        <h2><?php if(!empty($wallet[0]['amount'])) { echo $wallet[0]['amount']; } else { ?>0<?php } ?> <span class="karma-points">Karma &#10;Points</span></h2>
                                                  	</div>
                                                   	<div class="col-sm-6">
                                                        <p class="blue"><img src="<?php echo asset_url();?>images/info.png" alt="info" class="info"/>know more about Karma Points.</p>
                                                   	</div>
                                              	</div><br>
                                              	<div id="enter_karma">
                                                   	<p>1 Karma point = Rs 1/-</p>
                                                  	<h4>Enter the karma points you want to use</h4>
                                                   	<h2><input type="text" name="available_wallet_points" id="available_wallet_points" value="<?php if(!empty($wallet[0]['amount'])) { if($cart['subtotal'] > $wallet[0]['amount']) { echo $wallet[0]['amount'];} else { echo $cart['subtotal'];} } else { ?>0<?php } ?>" /></h2>
                                                   	<button type="button" class="blue-border" onclick="applyKarmaPoint();">Use</button>
                                              	</div>
                                               	<!-- Applied karma points -->
                                             	<div id="karma_applied" style="display:none;">
                                                 	<h4 class="blue">Karma points applied</h4>
                                                  	<div class="inline">
                                                     	<h4><span id="karma_redeemed"></span> Points ( &#8377; <span id="karma_redeemed_price"></span> ) </h4>
                                                      	<a href="javascript:editKarmaPoint();" class="blue custom-a">Edit</a>
                                                      	<a href="javascript:removeKarmaPoint();" class="blue custom-a">Remove</a>
                                                   	</div>
                                               	</div>    
                                              	<!-- Applied karma points -->
                                              	<br><br>
                                              	<p class="pink">karma points and EMI <br>can't be used together.</p>
                                          	</div>
                                       	</div>
                                   	</div>
                              	</div>
                              	<!-- Payment Methods end -->
                                 
                                 <!--  Promotional code -->
                                 	         <div class="row border-top-style">
          										   <div class="col-sm-6">
          										      <a href="#" class="blue"><b> + Add Promotional code</b></a>
          										        <div><br>
          										          <h4 class="font-size-25">Got a Promotional code ?</h4>
          										            <!-- <form>-->
          										               <input type="text" id="coupon_code" name="coupon_code" placeholder=" Enter Promo Code"/>
          										               <button type="button" name="redeem" id="redeem" class="blue-border" onclick="applyCoupon();">APPLY</button>
          										           <!-- </form>-->
          										        </div>
          										   </div>
          										   <div class="col-sm-6">
          										      <a  href="#" class="blue"><b> + Add Referral code </b></a>
          										       <div><br>
          										          <h4 class="font-size-25">Got a Referral code ?</h4>
          										            <!-- <form>-->
          										               <input type="text" name="referral_code" id="referral_code" placeholder=" Enter Referral Code"/>
          										               <button type="button" class="blue-border" onclick="applyReferralCode();">APPLY</button>
          										           <!-- </form>-->
          										        </div>
          										   </div>
          										</div>
          						<!--  Promotional code -->			
                                 
                                 <!--  transaction has failed!
                                    <div class="transaction-failed">
                                       <div class="center">
                                          <img src="<?php echo asset_url();?>images/failed.png" alt="transaction-failed"  class="failed-img"/>
                                          <h3>Sorry your transaction has failed!</h3>
                                          <h5>Transaction/Order ID: 2001234432</h5><br>
                                          <h4>Your card was declined for following reason:</h4>
                                       <ul class="list-style-type">
                                         <li>You have entered a wrong card number.</li>
                                         <li> >Your card type is not accepted by our payment gateway.</li>
                                         <li> >Incorrect expiry card expiry date or COther exceptions - In which case you would need to check with the card issuing bank.</li>
                                         <li> Please check, if you have entered the correct billing address corresponding to the credit/debit card used.</li>
                                       </ul>
                                        <button type="button" class="next1">Choose a different payment method</button>
                                       </div>
                                    </div>
                                  transaction has failed!-->
                             </div>
                             
                            <form id="checkout_form"  name="checkout_form" method="post" action="">
	                            <input type="hidden" id="userid" name="userid" value="<?php if(!empty($olouserid)) { echo $olouserid; }?>" /> 
	                            <input type="hidden" id="name" name="name" value="<?php if(!empty($olousername)) { echo $olousername;}?>" />
								<input type="hidden" id="email" name="email" value="<?php if(!empty($olouseremail)) { echo $olouseremail;}?>" />
								<input type="hidden" id="mobile" name="mobile" value="<?php if(!empty($olousermobile)) { echo $olousermobile;}?>" />
								<input type="hidden" name="shippingaddressid" id="shippingaddressid" />
								<input type="hidden" name="payment_mode" id="payment_mode" value="0" />
								<input type="hidden" name="karma_points" id="karma_points" value="0" />
								<input type="hidden" name="valid_mobile" id="valid_mobile" value="0"/>
								<input type="hidden" name="giftee_id" id="giftee_id" value="0"/>
                             <div class="col-md-4 add-display">
                               <!-- cart details -->
                                 <div class="cart-custom-space" id="cart_area">
                                     <div class="row">
                                       <h4 class="font-size-25 space1">Cart</h4>
                                      </div>
                                     <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $cart['subtotal']; ?>" />
                                    <?php foreach($cart['cartitems'] as $productcart) { ?>
                                     <div class="row margin-topp1 font-style1">
                                        <div class="col-sm-6 col-xs-6">
                                            <p><?php echo $productcart['name']; ?></p>
                                        </div>
                                        <div class="col-sm-6 col-xs-6 right">
                                             <p>(&#8377; <?php echo $productcart['totalprice']; ?>)</p>
                                        </div>
                                     </div>
                                     <div class="row">
                                        <div class="col-sm-6 col-xs-6">
                                          <p>QTY <?php echo $productcart['cartquantity']; ?></p>
                                        </div>
                                        <div class="col-sm-6 col-xs-6">
                                        </div>
                                     </div>  
                                     <?php } ?>
                                     <?php if($cart['discount'] > 0) { ?>
                                      <div class="row blue  margin-topp1">
                                        <div class="col-sm-6 col-xs-6">
                                            <p>Promotion Code</p>
                                            <p><?php echo $cart['coupon_code'];?></p>
                                        </div>
                                        <div class="col-sm-6 col-xs-6 right">
                                             <p>- &#8377; <?php echo $cart['discount'];?>/-</p>
                                        </div>
                                     </div>
                                     <?php } ?>
                                     <div class="row">
                                     	<div class="col-sm-6 col-xs-6">
                                            <p><b>Order Total</b></p>
                                            <!--<p>Refundable Deposit</p>
                                            <p>(&#8377; 35,500)</p>-->
                                        </div>
                                        <div class="col-sm-6 col-xs-6 right">
                                             <p><b>&#8377; <?php echo $cart['subtotal']; ?>/-</b></p>
                                             <!-- <p class="green">You saved &#8377; 15,000</p>
                                             <p class="blue">Promotion code applied</p>-->
                                        </div>
                                     </div>
                                </div>
                               <!-- cart details ends -->
                                  <div>
                                        <h4 class="font-size-25 custom-margin-12">Shipping Details</h4>
                                        <h5>Address</h5>
                                        <div id="shippingaddressdetailspay"></div>
                                       <!--  <p><b>Ashish Sharma</b></p>
                                        <p>Plot no 10, Karishma Society Kothrud Colony,
                                           (Opp to the petrol pump)</p>
                                        <p>Pune 311038 Maharashtra</p> 
                                        <p><b>+91-9876-654321</b></p>  
                                        <p><b>ashish.sharma@gmail.com </b></p>--> 
                                        
                                        <p class="blue">Dispatched in 2-3 business days from date of Purchase.</p>
                                   </div>
                             </div>
                            </form>
                          </div>
                         <div class="row main-section">
                            <div class="col-md-9 col-sm-9">
                                <p>EMI available across HDFC Bank, Citibank, ICICI Bank, SBI Card, Kotak Mahindra Bank, <br> Standard Chartered Bank, Axis Bank, and HSBC credit cards.Details</p>
                            </div>
                            <div class="col-sm-3 col-ms-3">
                               <button type="button" class="next margin-button" onClick="checkoutOrder();">Pay</button>
                               <p><b>Rest of the amount would be paid by Cash on delivery</b></p>
                            </div>
                          </div>
                    </div>
                 <!-- Payment Details ends-->   
                 
                </div>
        </div>
    </section>
   </div>
</div>
<!-- confirm address modal -->

  <!-- Modal -->
  <div class="modal fade" id="confirm-address" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">Detect current location</button>
          <h4 class="modal-title">Please confirm the Details</h4>
        </div>
        <div class="modal-body AddNewAddress ">
          <form>
              <div class="form-group row">
                 <div class="col-sm-4">          
                     <input type="text" class="form-control" id="" placeholder="Address Name" name="">
                 </div>
              </div>
               <div class="form-group row">
                   <div class="col-sm-4">          
                        <input type="text" class="form-control" id="" placeholder="Address line 1" name="">
                    </div>
                    <div class="col-sm-4">          
                        <input type="text" class="form-control" id="" placeholder="Apt No" name="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">          
                         <input type="text" class="form-control" id="" placeholder="Address line 2" name="">
                    </div>
                    <div class="col-sm-4">          
                          <input type="text" class="form-control" id="" placeholder="(Landmark)" name="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">          
                          <input type="text" class="form-control" id="" placeholder="Pincode" name="">
                     </div>
                     <div class="col-sm-4">          
                           <input type="text" class="form-control" id="" placeholder="City" name="">
                      </div>
                      <div class="col-sm-4">          
                           <input type="text" class="form-control" id="" placeholder="State" name="">
                      </div>
                </div> 
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="save-add-button">Confirm</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- confirm address modal ends-->  

 <div class="modal fade" id="save_address" role="dialog">
    <div class="modal-dialog modal-md">
    
      <!-- Modal content-->
      <div class="modal-content">
        <!--<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">X</button>
        </div>-->
        <div class="modal-body">
         	<h4 class="text-center">Address save succesfully</h4>
         	 <button type="button" class="close" data-dismiss="modal" >OK</button>
        </div>
        <!--<div class="modal-footer">
           <button type="button" class="save-add-button">Close</button>
        </div>-->
      </div>
      
    </div>
  </div>
<script>
    $(".Monthlyplan-button").click(function(){
        $(".collapse1").show();
    });
    $(".update").click(function(){
        $(".collapse1").hide();
        $(".update").hide();
        $(".Monthlyplan-button").show();
    });
    $(".remove1").click(function(){
       alert("Do you want to remove this item from the cart ?");
    });
    jQuery(".viewalladdress").click(function(){
        jQuery(".showalladdress").show();
	});

	
    function selectMyAddress(addressid) {
    	jQuery.get(base_url + "getsaveaddressById/"+addressid, function (data) {
    		jQuery("#shippingaddressdetails").html(data);
    		jQuery("#shippingaddressdetailspay").html(data);
    		var mobile = jQuery("#mobile-"+addressid).html();
    		jQuery("#selected_mobile").html(mobile);
    		jQuery("#selected_mobile1").html(mobile);
    		jQuery("#selected_mobile2").html(mobile);
    	});
    }
</script>

<script type="text/javascript">
/*$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'optradio1' || $(this).attr('id') == 'optradio2' || $(this).attr('id') == 'optradio3' || $(this).attr('id') == 'optradio4R') {
            $('.Monthlyplan-button').hide();        
            $('.update').show();   
       } else {
    	        
       }
   });
});*/
</script>
<script>
$(document).ready(function () {
    //Initialize tooltips
    jQuery('.nav-tabs > li a[title]').tooltip();
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        var $target = $(e.target);
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

});

function nextTab(elem) {
    jQuery(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
	jQuery(elem).prev().find('a[data-toggle="tab"]').click();
};

$("#shoppingcartbutton").click(function (e) {
	 var $active = $('.wizard .nav-tabs li.active');
     $active.next().removeClass('disabled');
     nextTab($active);
     jQuery("#ShoppingCart").hide();
     jQuery("#ShippingDetails").show();
     jQuery('html,body').scrollTop(0);
     jQuery("#ShoppingCart").removeAttr('style');
     checkIsGift();
});

$("#shippingdetailsbutton").click(function (e) {

	if($("#is_gift").prop("checked") == true) {
		if($('#gi_fname').val() == "" || !validateEmail($('#gi_email').val()) || !phonenumber($('#gi_mobile').val())) {
			if(!validateEmail($('#gi_email').val())) {
				alert("Invalid giftee email.");
			} else if(!phonenumber($('#gi_mobile').val())) {
				alert("Invalid mobile.");
			} else {
				alert("Giftee name required.");
			}
			return true;
		} else {
			jQuery.get(base_url+"giftee/validate",{ first_name: $('#gi_fname').val(), last_name: $('#gi_lname').val(), mobile: $('#gi_mobile').val(), email: $('#gi_email').val()},function(data) {
				if(data.status == 1) {
					jQuery("#gifty_address").show();
					jQuery("#giftee_id").val(data.userid);
					if(!$("input[name='saveaddress']").is(':checked')) 
					{
						 alert("please select address");
						 return false;
					}
					var addressid =  $("input[name='saveaddress']:checked").val();
					var $active = $('.wizard .nav-tabs li.active');
				    $active.next().removeClass('disabled');
				    nextTab($active);
				    jQuery("#ShippingDetails").hide();
				    jQuery("#OrderSummary").show();
				    jQuery('html,body').scrollTop(0);
				    jQuery("#ShippingDetails").removeAttr('style');

				    $('#shippingaddressid').val(addressid);

				    var gfname = $('#gi_fname').val();
				    var glname = $('#gi_lname').val();
				    var gemail = $('#gi_email').val();
				    var gmobile = $('#gi_mobile').val();

				    $("#gifname").html(gfname);
				    $("#gilname").html(glname);
				    $("#gifemail").html(gemail);
				    $("#gilmobile").html(gmobile);
				} else {
					alert(data.msg);
					return true;
				}
			},'json');
		}
	} else {
		jQuery("#gifty_address").hide();
		if(!$("input[name='saveaddress']").is(':checked')) 
		{
			 alert("please select address");
			 return false;
		}
		var addressid =  $("input[name='saveaddress']:checked").val();
		var $active = $('.wizard .nav-tabs li.active');
	    $active.next().removeClass('disabled');
	    nextTab($active);
	    jQuery("#ShippingDetails").hide();
	    jQuery("#OrderSummary").show();
	    jQuery('html,body').scrollTop(0);
	    jQuery("#ShippingDetails").removeAttr('style');

	    $('#shippingaddressid').val(addressid);

	    var gfname = $('#gi_fname').val();
	    var glname = $('#gi_lname').val();
	    var gemail = $('#gi_email').val();
	    var gmobile = $('#gi_mobile').val();

	    $("#gifname").html(gfname);
	    $("#gilname").html(glname);
	    $("#gifemail").html(gemail);
	    $("#gilmobile").html(gmobile);
	}
     
});

$("#proceedtopaybutton").click(function (e) {
	 var $active = $('.wizard .nav-tabs li.active');
     $active.next().removeClass('disabled');
     nextTab($active);
     jQuery("#ShippingDetails").hide();
     jQuery("#PaymentDetails").show();
     jQuery('html,body').scrollTop(0);
     jQuery("#ShippingDetails").removeAttr('style');
     jQuery("#confirm_mobile_1").show();
     jQuery("#confirm_mobile_2").hide();
     jQuery("#confirm_mobile_3").hide();
});
</script>
<script>
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
		 $("#cart-li").html(html);
		 $("#cart-limo").html(html);
	},'json');
}

function deleteItemFromCart(itemid,option_id) {
	
	jQuery.post(base_url+"deleteitemfromcart",{itemid: itemid, option_id: option_id },function(data) {
		if(data.status == 1) {
			window.location.href = base_url+"purchase-flow";
		}
	},'json');
}
</script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script>

$('#new_add_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        address_name: {
            validators: {
                notEmpty: {
                    message: 'Address name is required.'
                }
            }
        },
        address: {
            validators: {
                notEmpty: {
                    message: 'Address is required.'
                }
            }
        },
        locality: {
            validators: {
                notEmpty: {
                    message: 'Locality is required.'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	addnewAddress();
});

function addnewAddress() {
	var addressopt = $('input[name=address_opt]:checked').val();
	var userid = $("#userid").val();
	jQuery.post(base_url+"addnewaddress",{ userid: $("#userid").val(), address_name: $("#address_name").val(), address: $("#address").val(), apt_no: $("#apt_no").val(), locality: $("#locality").val(), latitude: $("#latitude").val(), longitude: $("#longitude").val(), landmark: $("#landmark").val(), pincode: $("#pincode").val(), city: $("#city").val(), state: $("#state").val(), address_opt: addressopt }, function(data) {
		if(data.status == 1) {
			jQuery.get(base_url + "getusersavedaddress/"+userid, function (data) {
					jQuery("#saveduseraddress").html(data);
					jQuery('#saveduseraddressdisplay').replaceWith('#saveduseraddress');
					jQuery("#AddNewAddress").hide();
				    jQuery("#SavedAddress").show();
				    jQuery("#SavedAddress").addClass('active in');
				    jQuery("#AddNewAddress").removeClass('active in');
				    jQuery("#tabsave_add").addClass('active');
				    jQuery("#tabadd_add").removeClass('active');
				    jQuery('html,body').scrollTop(0);
			  });
		}
	},'json');
}

function applyCoupon() {
	var coupon_code = jQuery('#coupon_code').val();
	var mobile = jQuery('#mobile').val();
	var email = jQuery('#email').val();
	var subtotal = parseInt(jQuery("#subtotal").val());
	var payment_mode = jQuery("#payment_mode").val();
	var karma_point = jQuery("#karma_points").val();
	if(coupon_code != "") {
		jQuery.get(base_url+"applycoupon",{coupon_code: coupon_code, is_checkout: 1, subtotal: $("#subtotal").val(), email: email, mobile: mobile, payment_mode: payment_mode, karma_point: karma_point },function(data) {
			if (data.status == 1) {
				jQuery("#response").removeClass('alert alert-danger');
				jQuery("#response").addClass('alert alert-success');
				jQuery("#response").html(data.msg);
				jQuery("#response").hide();
				jQuery("#cart_area").html(data.cart);
				jQuery("#available_wallet_points").val(data.karma_discount);
				jQuery("#karma_redeemed").html(data.karma_discount);
				jQuery("#karma_redeemed_price").html(data.karma_discount);
				alert("Coupon applied successfully.");
			} else {
				jQuery("#response").removeClass('alert alert-success');
				jQuery("#response").addClass('alert alert-danger');
				jQuery("#response").html(data.msg);
				jQuery("#response").show();
				alert(data.msg);
			}
		},'json');
	} else {
		alert("Please Enter Coupon Code");
	}
}

function applyKarmaPoint() {
	var coupon_code = jQuery('#coupon_code').val();
	var karma_point = jQuery('#available_wallet_points').val();
	var mobile = jQuery('#mobile').val();
	var email = jQuery('#email').val();
	var subtotal = parseInt(jQuery("#subtotal").val());
	var payment_mode = jQuery("#payment_type").val();
	if(parseInt(karma_point) > 0) {
		jQuery.get(base_url+"applykarmapoint",{coupon_code: coupon_code, is_checkout: 1, subtotal: $("#subtotal").val(), email: email, mobile: mobile, payment_mode: payment_mode, karma_point: karma_point },function(data) {
			if (data.status == 1) {
				jQuery("#response").removeClass('alert alert-danger');
				jQuery("#response").addClass('alert alert-success');
				jQuery("#response").html(data.msg);
				jQuery("#response").hide();
				jQuery("#cart_area").html(data.cart);
				jQuery("#karma_redeemed").html(data.karma_discount);
				jQuery("#karma_redeemed_price").html(data.karma_discount);
				jQuery("#karma_points").val(data.karma_discount);
				jQuery("#enter_karma").hide();
				jQuery("#karma_applied").show();
				alert("Karma point applied successfully.");
			} else {
				jQuery("#response").removeClass('alert alert-success');
				jQuery("#response").addClass('alert alert-danger');
				jQuery("#response").html(data.msg);
				jQuery("#response").show();
				alert(data.msg);
			}
		},'json');
	} else {
		alert("Please Enter Karma Points");
	}
}

function editKarmaPoint() {
	jQuery("#karma_redeemed").html(0);
	jQuery("#karma_redeemed_price").html(0);
	jQuery("#enter_karma").show();
	jQuery("#karma_applied").hide();
}

function removeKarmaPoint() {
	var coupon_code = jQuery('#coupon_code').val();
	var karma_point = jQuery('#available_wallet_points').val();
	var mobile = jQuery('#mobile').val();
	var email = jQuery('#email').val();
	var subtotal = parseInt(jQuery("#subtotal").val());
	var payment_mode = jQuery("#payment_type").val();
	jQuery.get(base_url+"applykarmapoint",{coupon_code: coupon_code, is_checkout: 1, subtotal: $("#subtotal").val(), email: email, mobile: mobile, payment_mode: payment_mode, karma_point: 0 },function(data) {
		if (data.status == 1) {
			jQuery("#response").removeClass('alert alert-danger');
			jQuery("#response").addClass('alert alert-success');
			jQuery("#response").html(data.msg);
			jQuery("#response").hide();
			jQuery("#cart_area").html(data.cart);
			jQuery("#karma_redeemed").html(data.karma_discount);
			jQuery("#karma_redeemed_price").html(data.karma_discount);
			jQuery("#enter_karma").show();
			jQuery("#karma_applied").hide();
			jQuery("#karma_points").val(0);
			alert("Karma point removed successfully.");
		} else {
			jQuery("#response").removeClass('alert alert-success');
			jQuery("#response").addClass('alert alert-danger');
			jQuery("#response").html(data.msg);
			jQuery("#response").show();
			alert(data.msg);
		}
	},'json');
}

function sendMobileVerification() {
	jQuery.post(base_url+"order/otp/send",{mobile: jQuery("#mobile").val()},function(data){
		if(data.status == 1) {
			jQuery("#confirm_mobile_1").hide();
			jQuery("#confirm_mobile_2").show();
		} else {
			alert(data.msg);
		}
	},'json');
}

function resendMobileVerification() {
	jQuery.post(base_url+"order/otp/resend",{ mobile: jQuery("#mobile").val()},function(data){
		if(data.status == 1) {
			jQuery("#confirm_mobile_1").hide();
			jQuery("#confirm_mobile_2").show();
		} else {
			alert(data.msg);
		}
	},'json');
}

function validateMobile() {
	jQuery.post(base_url+"order/otp/confirm",{ otp: jQuery("#orderotp").val()},function(data){
		if(data.status == 1) {
			jQuery("#confirm_mobile_1").hide();
			jQuery("#confirm_mobile_2").hide();
			jQuery("#confirm_mobile_3").show();
			$("#valid_mobile").val(1);
		} else {
			alert(data.msg);
		}
	},'json');
}

function checkIsGift() {
	if($("#is_gift").prop("checked") == true) {
		jQuery("#gifteesdetails").show();
		jQuery("input:radio[name='saveaddress']:first").prop("checked","checked");
		jQuery("#shipping_address").hide();
		var addressid = jQuery("input:radio[name='saveaddress']:first").val();
		jQuery.get(base_url + "getsaveaddressById/"+addressid, function (data) {
    		jQuery("#shippingaddressdetails").html(data);
    		jQuery("#shippingaddressdetailspay").html(data);
    		var mobile = jQuery("#mobile-"+addressid).html();
    		jQuery("#selected_mobile").html(mobile);
    		jQuery("#selected_mobile1").html(mobile);
    		jQuery("#selected_mobile2").html(mobile);
    	});
    	jQuery("#gifty_address").show();
	} else {
		jQuery("input:radio[name='saveaddress']:first").prop("checked",false);
		jQuery("#gifteesdetails").hide();
		jQuery("#shipping_address").show();
	}
}

jQuery(".payment-method-tab li a").click(function(){
	var id = jQuery(this).attr("data-id");
	jQuery("#payment_type").val(id);
	if(id != 0) {
		jQuery("#valid_mobile").val(1);
	}
});

function checkoutOrder() {
	if(jQuery("#payment_mode").val() == 0 && jQuery("#valid_mobile").val()) {
		jQuery.post(base_url+"order/checkout", {address_id: jQuery("#shippingaddressid").val(), payment_mode: jQuery("#payment_mode").val(), coupon_code: jQuery("#coupon_code").val(), referral_code: jQuery("#referral_code").val(), karma_points: jQuery("#karma_points").val(), is_gift: jQuery("#is_gift").prop("checked"), is_wraping: jQuery("#is_gift").prop("is_wraping"), gi_fname: jQuery("#gi_fname").val(), gi_lname: jQuery("#gi_lname").val(), gi_email: jQuery("#gi_email").val(), gi_mobile: jQuery("#gi_mobile").val(), gi_userid: jQuery("#giftee_id").val()}, function(data){
			if(data.status == 1) {
				window.location.href= base_url+"order/placed/"+data.ordercode;
			} else {
				alert(data.msg);
			}
		},'json');
	} else {
		alert("Please verify your mobile number.");
	}
}

function phonenumber(inputtxt)
{
  	var phoneno = /^\d{10}$/;
  	if(inputtxt.match(phoneno)) {
      	return true;
	} else {
        return false;
  	}
}
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
$(".nav li.disabled").on( "click", function(e) {
	if($(this).attr("class") == "disabled") {
	    e.preventDefault();
	    return false;
	}
});

</script>