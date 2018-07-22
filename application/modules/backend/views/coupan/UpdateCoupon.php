<style>
    <!--
    .margin-bottom-5{
        margin-bottom: 5px;
    }
    -->
</style>
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/selectize.bootstrap3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap-timepicker.min.css">

<div id="page-wrapper">
    <div class="row">
       	<div class="col-lg-12">
            <h3><center>Update Coupon</center></h3>

       	</div>
    </div>


    <form id="addrestaurant" name="addrestaurant" action="<?php echo base_url();?>admin/coupon/update/updateCoupon" method="post" novalidate>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#basic">Vendor Details</a></li>
            <li><a data-toggle="tab" href="#contacts">Discount Details</a></li>
            <li><a data-toggle="tab" href="#coupon">Coupon</a></li>

        </ul>
        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                Vendor 
                            </div>
                            <div class="panel-body">
                                <?php foreach ($vendors as $v) { ?>
                                    <input type="hidden" value="<?php echo $v['id']; ?>" id="vendorid" name="vendorid">
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-mstart_time">
                                                <label class="control-label col-sm-3"> Title <span class='text-danger'>*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="" name="tttt" value="<?php echo $v['title']; ?>" required />
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-eclose_time">
                                                <label class="control-label col-sm-3">From Date <span class='text-danger'>*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="trial_end_date" name="from_date" required value="<?php echo date('d-m-Y',strtotime($v['from_date'])); ?>"/>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-eclose_time">
                                                <label class="control-label col-sm-3">To Date <span class='text-danger'>*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="trial_start_date"  required name="to_date" value="<?php echo date('d-m-Y',strtotime($v['to_date'])); ?>"/>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-mstart_time">
                                                <label class="control-label col-sm-3">From Time <span class='text-danger'>*</span></label>
                                                   <div class="col-sm-2">
                                                <select name="hour" required class="form-control">
                                                    <option>Hour</option>
                                                   <?php 
                                                   $time=  explode(':', $v['from_time']);
                                                  // print_r($time[0]);
                                                   for($i=0;$i<24;$i++){
                                                       $selected="";
                                                    if($i<10)
                                                    {
                                                    if($time[0]=="0".$i)
                                                    { $selected="selected";
                                                    }
                                                        ?>
                                                    <option value="<?php echo "0".$i ?>" <?php echo $selected ?>> <?php echo "0".$i ?></option>
                                                    
                                                    <?php } else {
                                                        if($time[0]==$i)
                                                    { $selected="selected";
                                                    }?>
                                                     <option value="<?php echo $i; ?>" <?php echo $selected?>> <?php echo $i; ?></option>
                                                    
                                                   <?php }} ?>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select name="minute" required class="form-control">
                                                    <option>Minute</option>
                                                    
                                                   <?php 
                                                   $time=  explode(':', $v['from_time']);
                                                   for($i=0;$i<60;$i++){
                                                        $selected="";
                                                    if($i<10)
                                                    {
                                                     if($time[1]=="0".$i)
                                                    { $selected="selected";
                                                    }?>
                                                    
                                                    <option value="<?php echo "0".$i ?>" <?php echo $selected?>> <?php echo "0".$i ?></option>
                                                    
                                                     <?php } else {
                                                         if($time[1]==$i)
                                                    { $selected="selected";
                                                    }
                                                         ?>
                                                     <option value="<?php echo $i; ?>" <?php echo $selected?>> <?php echo $i; ?></option>
                                                    
                                                   <?php }} ?>
                                                    
                                                </select>
                                            </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-mstart_time">
                                                <label class="control-label col-sm-3"> To Time <span class='text-danger'>*</span></label>
                                                <div class="col-sm-2">
                                                <select name="thour" required class="form-control">
                                                    <option>Hour</option>
                                                   <?php 
                                                   $time=  explode(':', $v['to_time']);
                                                  // print_r($time[0]);
                                                   for($i=0;$i<24;$i++){
                                                       $selected="";
                                                    if($i<10)
                                                    {
                                                    if($time[0]=="0".$i)
                                                    { $selected="selected";
                                                    }
                                                        ?>
                                                    <option value="<?php echo "0".$i ?>" <?php echo $selected ?>> <?php echo "0".$i ?></option>
                                                    
                                                    <?php } else {
                                                        if($time[0]==$i)
                                                    { $selected="selected";
                                                    }?>
                                                     <option value="<?php echo $i; ?>" <?php echo $selected?>> <?php echo $i; ?></option>
                                                    
                                                   <?php }} ?>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select name="tminute" required class="form-control">
                                                    <option>Minute</option>
                                                    
                                                   <?php 
                                                   $time=  explode(':', $v['to_time']);
                                                   for($i=0;$i<60;$i++){
                                                        $selected="";
                                                    if($i<10)
                                                    {
                                                     if($time[1]=="0".$i)
                                                    { $selected="selected";
                                                    }?>
                                                    
                                                    <option value="<?php echo "0".$i ?>" <?php echo $selected?>> <?php echo "0".$i ?></option>
                                                    
                                                     <?php } else {
                                                         if($time[1]==$i)
                                                    { $selected="selected";
                                                    }
                                                         ?>
                                                     <option value="<?php echo $i; ?>" <?php echo $selected?>> <?php echo $i; ?></option>
                                                    
                                                   <?php }} ?>
                                                    
                                                </select>
                                            </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-online_payment">

                                                <label class="control-label col-sm-3">Is Multiple </label>
                                                <div class="col-sm-5">

                                                    <label class="radio-inline"><input type="radio" id="yes" value="1" name="is_multiple" >Yes</label>
                                                    <label class="radio-inline"><input type="radio" id="no" value ="0" name="is_multiple" checked>No</label>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
	                                    <div class="col-lg-12 margin-bottom-5">
	                                        <div class="form-group" id="error-is_single_uses">
	
	                                            <label class="control-label col-sm-3">Is Onetime Uses ? </label>
	                                            <div class="col-sm-5">
	                                                <label class="radio-inline"><input type="radio" id="is_single_uses" value="1" name="is_single_uses" <?php if ($v['is_single_uses'] == 1) { echo 'checked'; } ?>>Yes</label>
	                                                <label class="radio-inline"><input type="radio" id="is_single_uses" value ="0" name="is_single_uses" <?php if ($v['is_single_uses'] == 0) { echo 'checked'; } ?>>No</label>
	                                            </div>
	                                            <div class="messageContainer col-sm-4"></div>
	                                        </div>
	
	                                    </div>
	                                </div>
                                    <div class="row" id="cc">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-online_payment">

                                                <label class="control-label col-sm-3">No of Coupon </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="" name="no_of_coupon" value="" required placeholder="Enter No Of Coupon"/>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-online_payment">

                                                <label class="control-label col-sm-3">Is Specific </label>
                                                <div class="col-sm-5">
                                                    <label class="radio-inline"><input type="radio" id="yes2" value="1" name="spacific" <?php if ($v['is_specific'] == '1') { echo 'checked'; } ?> >Yes</label>
                                                    <label class="radio-inline"><input type="radio" id="no2" value ="0" name="spacific" <?php if ($v['is_specific'] == '0') { echo 'checked'; } ?> >No</label>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row" id="ff3">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-cityid">
                                                <label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
                                                <div class="col-sm-5">
                                                    <select name="cityid" id="cityid" class="form-control">
                                                        <option value="">Select City</option>
    													<?php foreach ($cities as $city) { ?>
                                                            <option value="<?php echo $city['id']; ?>" ><?php echo $city['name']; ?></option>
    													<?php } ?>
                                                    </select>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="ff2" >
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-areaid">
                                                <label class="control-label col-sm-3">Select Area <span class='text-danger'>*</span></label>
                                                <div class="col-sm-5">
                                                    <select name="areaid" id="areaid" class="form-control" onchange="getrestaurants()">
                                                        <option value="">Select Area</option>
    													<?php foreach ($areas as $area) { ?>
                                                            <option value="<?php echo $area['id']; ?>" ><?php echo $area['name']; ?></option>
    													<?php } ?>
                                                    </select>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="ff1" >
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-name">
                                                <label class="control-label col-sm-3">Restaurant Name <span class='text-danger'>*</span></label>
                                                <div class="col-sm-5" id="ras">xxxx

                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-name">
                                                <label class="control-label col-sm-3">Minimum Order Value <span class='text-danger'>*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="minimum_order_value" name="minimum_order_value" value="<?php echo $v['minimum_order_value']; ?>"/>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-online_payment">

                                                <label class="control-label col-sm-3">Is Day Specific </label>
                                                <div class="col-sm-5">
                                                    <label class="radio-inline"><input type="radio" id="yes1" value="1" name="ids" <?php if ($v['is_day_specific'] == '1') { echo 'checked'; } ?>>Yes</label>
                                                    <label class="radio-inline"><input type="radio" id="no1" value ="0" name="ids" <?php if ($v['is_day_specific'] == '0') { echo 'checked'; } ?>>No</label>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row" id="day">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-online_payment">

                                                <label class="control-label col-sm-3">Select Days</label>
                                                <div class="col-sm-5">
											    <?php
											    if ($v['is_day_specific'] == '1') {
											        $day = explode(',', $v['valid_days']);
											        $i = 0;
											        ?>
                                                        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="sun" <?php foreach ($day as $da) {
											            echo $da;
											            if ($da == 'sun') {
											                echo 'checked';
											            }$i++;
											        } ?>>Sunday</label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="mon" <?php $i = 0;
											        foreach ($day as $da) {
											            if ($da == 'mon') {
											                echo 'checked';
											            }$i++;
											        } ?>>Monday</label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="tue" <?php $i = 0;
											        foreach ($day as $da) {
											            if ($da == 'tue') {
											                echo 'checked';
											            }$i++;
											        } ?>>Tuesday</label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="wed" <?php $i = 0;
											        foreach ($day as $da) {
											            if ($da == 'wed') {
											                echo 'checked';
											            }$i++;
											        } ?>>Wednesday</label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="thu" <?php $i = 0;
											        foreach ($day as $da) {
											            if ($da == 'thu') {
											                echo 'checked';
											            }$i++;
											        } ?>>Thursday</label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="fri" <?php $i = 0;
											        foreach ($day as $da) {
											            if ($da == 'fri') {
											                echo 'checked';
											            }$i++;
											        } ?> >Friday</label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="sat" <?php foreach ($day as $da) {
											            if ($da == 'sat') {
											                echo 'checked';
											            }$i++;
											        } ?>>Saturday</label>
										    <?php } else
										    {?>
                                                    
                                                    <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="sun">Sunday</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="mon">Monday</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="tue">Tuesday</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="wed">Wednesday</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="thu">Thursday</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="fri">Friday</label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="sat">Satarday</label>
											  <?php  
											  
											  
											    }
											?>  
                                                    
                                                </div>

                                                <div class="messageContainer col-sm-4"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row" id="cc1">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-mstart_time">
                                                <label class="control-label col-sm-3"> Coupon Code<span class='text-danger'>*</span></label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="" name="coupon_code" value="<?php if($v['coupon_code']!='')echo $v['coupon_code'];?>" required />
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-economic_category">
                                                <label class="control-label col-sm-3">Applicable for</label>
                                                <div class="col-sm-5">
                                                    <select name="applicable_for" id="restaurant_id" class="form-control" required>
                                                        <option value="1" <?php if($v['applicable_for']==1)echo "selected";?>>Online</option>
                                                        <option value="2" <?php if($v['applicable_for']==2)echo "selected";?>>COD</option>
                                                        <option value="3" <?php if($v['applicable_for']==3)echo "selected";?>>Both</option>
                                                    </select>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        <div class="form-group" id="error-is_first_time">
                                            <label class="control-label col-sm-3">For First Time User ? </label>
                                            <div class="col-sm-5">
                                                <select name="is_first_time" id="is_first_time" class="form-control" required>
                                                    <option value="0" <?php if($v['is_first_time']==0)echo "selected";?>>All</option>
                                                    <option value="1" <?php if($v['is_first_time']==1)echo "selected";?>>First Time User</option>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-4"></div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-lg-12 margin-bottom-5">
                                            <div class="form-group" id="error-online_payment">

                                                <label class="control-label col-sm-3">Status</label>
                                                <div class="col-sm-5">
                                                    <label class="radio-inline"><input type="radio" id="yes1" value="1" name="status" <?php if($v['status']==1)echo "checked";?> >Active</label>
                                                    <label class="radio-inline"><input type="radio" id="no1" value ="0" name="status"  <?php if($v['status']==0)echo "checked";?>>Deactive</label>
                                                </div>
                                                <div class="messageContainer col-sm-4"></div>
                                            </div>

                                        </div>
                                    </div>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="contacts" class="tab-pane fade" >
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                Discount Type
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="panel-body" >
				<?php foreach ($discount as $d) { ?>
                            
                                <div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        
                                        <div class="form-group" id="error-online_payment">
                                            <h5 style="margin-bottom:30px;color:#ff0000"> <i>Discount By olotime</i></h5>
                                            <label class="control-label col-sm-3">Discount Type </label>
                                            <div class="col-sm-5">
                                                <select name="zkdiscount_type" id="online_payment" class="form-control" required>
                                                    <option value="1" <?php if($d['discount_type_zk'] == 1) echo "selected";?>>Flat</option>
                                                    <option value="2" <?php if($d['discount_type_zk'] == 2) echo "selected";?>>Percentage</option>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-4"></div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-3"> Discount Amount <span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="" name="zkamount" required value="<?php echo $d['discount_by_zk'];?>" />
                                            </div>
                                            <div class="messageContainer col-sm-4"></div>
                                        </div>

                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        
                                        <div class="form-group" id="error-online_payment">
                                            <h5 style="margin-bottom:30px;color:#ff0000"> <i>Discount By Restaurants</i></h5>
                                            <label class="control-label col-sm-3">Discount Type </label>
                                            <div class="col-sm-5">
                                                <select name="rdiscount_type" id="online_payment" class="form-control" required>
                                                    <option value="1" <?php if($d['discount_type_rest'] == 1) echo "selected";?>>Flat</option>
                                                    <option value="2" <?php if($d['discount_type_rest'] == 2) echo "selected";?>>Percentage</option>
                                                </select>
                                            </div>
                                            <div class="messageContainer col-sm-4"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-3"> Discount Amount <span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="" name="ramount" required value="<?php echo $d['discount_by_rest'];?>"  />
                                            </div>
                                            <div class="messageContainer col-sm-4"></div>
                                        </div>

                                    </div>
                                </div>
                            <div class="row">
                                    <div class="col-lg-12 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-3">Maximum Discount Value<span class='text-danger'>*</span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="" name="max_discount_value" value="<?php echo $d['max_discount_value'];?>" required />
                                            </div>
                                            <div class="messageContainer col-sm-4"></div>
                                        </div>

                                    </div>
                                </div>
                <?php } ?>
                </div>
            </div>

            <div id="coupon" class="tab-pane fade">
                <div class="row" >
                    <div>
                        <form action="" method="post">

                        </form>
                    </div>
                    <div class="col-lg-12" style="padding:0px">

                        <div class="panel panel-default" style="width:60%" >
                            <div class="panel-heading" >
                                Update Coupon
                            </div>
                            <div class="panel-body"  >

                                <div class="dataTable_wrapper" >
                                    <table class="table table-bordered table-hover" id="dataTables-example" >
                                        <thead class="bg-info">
                                            <tr>

                                                <th>Coupon Code</th>
                                                <th>Status</th>
                                                



                                            </tr>

                                        </thead>
                                        <tbody>
										<?php foreach ($coupon as $c) { ?>
                                                <tr>
                                                    <td> <?php echo $c['coupon_code']; ?> </td>
                                                    <td>    
                                                    	<?php if($c['status'] == 1) {?>
														<a href="javascript:onCoupon()" name="<?php echo $c['coupon_code'];?>" id="onCoupon">
															<i class="fa fa-cog text-success fa-lg"></i>
														</a>
														<?php }else{?>
														<a href="javascript:offCoupon()" name="<?php echo $c['coupon_code'];?>" id="offCoupon">
															<i class="fa fa-cog text-danger fa-lg"></i>
														</a>
														<?php }?>  
													</td> 
                                                </tr>
										<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div id="response"></div>
            <button type="submit" class="btn btn-success">Submit</button>
            <br>
            <br>
        </div>
    </form>
</div>
<script src="<?php echo asset_url(); ?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/selectize.min.js"></script>
<script src="<?php echo asset_url(); ?>js/jquery.form.js"></script>
<script>
$(document).ready(function () {                                                       
 	setrestro();
});
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$('#cycle_effective_date').datepicker().on('changeDate', function (ev) {
  	$('#addrestaurant').bootstrapValidator('revalidateField', 'cycle_effective_date');
});
$('#gateway_effective_date').datepicker().on('changeDate', function (ev) {
  	$('#addrestaurant').bootstrapValidator('revalidateField', 'gateway_effective_date');
});
$('#trial_start_date').datepicker().on('changeDate', function (ev) {
 	$('#addrestaurant').bootstrapValidator('revalidateField', 'trial_start_date');
});
$('#trial_end_date').datepicker().on('changeDate', function (ev) {
    $('#addrestaurant').bootstrapValidator('revalidateField', 'trial_end_date');
});

$('.resttime').timepicker();

var cuisine = $("#cuisines").selectize({
	plugins: ['remove_button'],
   	delimiter: ',',
    persist: false,
    create: function (input) {
      	return {
              	value: input,
             	text: input
     	}
 	}
});

cuisine.on('change', function () {
  	$('#addrestaurant').bootstrapValidator('revalidateField', 'cuisines[]');
});

function initMap() {
 	var options = {
   		types: ["geocode"],
       	componentRestrictions: {country: 'in'}
   	};
   	var input = document.getElementById('locality');
   	var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function () {
      	var place = autocomplete.getPlace();
        if (!place.geometry) {
         	window.alert("Autocomplete's returned place contains no geometry");
            return;
      	}
        $('#latitude').val(place.geometry.location.lat());
        $('#longitude').val(place.geometry.location.lng());
        $('#addrestaurant').bootstrapValidator('revalidateField', 'locality');
        $('#addrestaurant').bootstrapValidator('revalidateField', 'latitude');
        $('#addrestaurant').bootstrapValidator('revalidateField', 'longitude');
 	});
}
                                                    
function setrestro(){                                                       
  	$.get(base_url + "admin/general/restro", {cityid: $("#areaid").val(), vendorid: $("#vendorid").val()}, function (data) {
    	if(first==0){
          	$("#areaid").val(data.areaid); 
            $("#cityid").val(data.cityid);  
       	}
     	var html = "";
       	var i = 0;
       	var checked = "";
      	$.each(data, function (key, value) {   
         	if (value.reststatus == 1) {
             	checked = 'checked'; 
           	} else {
                checked = '';
          	}
          	if(value.restid !=undefined)                                                       
             	html = html + "<label class='checkbox-inline'><input type='checkbox' id='" + value.restid + "' name='rest[]' value='"+value.restid+"' " + checked + "  >" + value.restname + "</label>";
     	});                                                                    
        $("#ras").html(html);
   	}, 'json');
}
                                                    
$("#cityid").change(function () {
  	$.get(base_url + "admin/general/localities", { cityid: $("#cityid").val() }, function (data) {
    	var html = "<option value=''>Select Area</option>";
      	$.each(data, function (key, value) {
        	html = html + "<option value='" + value.id + "'>" + value.name + "</option>";
       	});
      	$("#areaid").html(html);
   	}, 'json');
});
                                                    
$("#areaid").change(function () {
  	$("#ras").html('');
    getrestaurants();
});
var first=0;
                                                    
function getrestaurants(){
  	$.get(base_url + "admin/general/getrestaurantbyarea", {areaid: $("#areaid").val()}, function (data) {
     	var ahtml = "";
        $.each(data, function (key, value) {                                                              
           	ahtml = ahtml + "<label class='checkbox-inline'><input type='checkbox' id='"+value.restid+"' name='rest[]' value='"+value.restid+"' >" + value.restname + "</label>";
       	});
        $("#ras").html(ahtml);
  	}, 'json');
}

function onCoupon() {
	var a=$("#onCoupon").attr('name');
   	$.get(base_url + "admin/coupan/statusoncoupon/"+a, {cityid: $("#cityid").val()}, function (data) {
     	var html = "<option value=''>Select Area</option>";
       	alert("Status Changed");
        $.each(data, function (key, value) {
         	html = html + "<option value='" + value.id + "'>" + value.name + "</option>";
        });
        $("#areaid").html(html);
  	}, 'json');
}

function offCoupon() {
	var a=$("#offCoupon").attr('name');
    $.get(base_url + "admin/coupan/statusoffcoupon/"+a, {cityid: $("#cityid").val()}, function (data) {
    	alert("Status Changed");
        var html = "<option value=''>Select Area</option>";
        $.each(data, function (key, value) {
        	html = html + "<option value='" + value.id + "'>" + value.name + "</option>";
       	});
        $("#areaid").html(html);
   	}, 'json');
}
                                                   
</script>
<script type="text/javascript">

    $(function () {
        showDiv();
        $("input[name='spacific']").click(function () {
            showDiv();
        });
    });

    function showDiv() {
        if ($("#yes2").is(":checked")) {
            $("#ff1").show();
            $("#ff2").show();
            $("#ff3").show();
        } else {
            $("#ff1").hide();
            $("#ff2").hide();
            $("#ff3").hide();
        }
    }
    $(function () {
        $("input[name='ids']").click(function () {

            if ($("#no1").is(":checked")) {
                $("#day").hide();

            } else {
                $("#day").show();

            }
        });
    });
    $(function () {
        $("#cc").hide();
        $("input[name='is_multiple']").click(function () {

            if ($("#no").is(":checked")) {
                $("#cc").hide();
                $("#cc1").show();


            } else {
                $("#cc").show();
                $("#cc1").hide();

            }
        });
    });
</script>