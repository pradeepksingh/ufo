        <?php if(!empty($useraddress)){ ?>
                                      <?php $i=0; ?>
                                      <?php foreach($useraddress as $address){ ?>
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
                                               <h4><b><?php echo $olousermobile; ?></b></h4>
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
			                                               <h4><b><?php echo $olousermobile; ?></b></h4>
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
                                         <?php } ?>