<!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
			  <?php //print_r($adminsession); 
			        // print_r($_SESSION ['adminsession']);
					// echo $_SESSION ['adminsession']['first_name']; ?>
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div><img src="<?php echo asset_url();?>backend/images/users/varun.jpg" alt="user-img" class="img-circle"></div>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION ['adminsession']['first_name'] .' '. $_SESSION ['adminsession']['last_name']; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu animated flipInY">
							<li><a href="<?php echo base_url();?>admin/users"><i class="ti-user"></i> Users </a></li>
                            <!--<li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                            <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>-->
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
							   <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
							</span> 
						</div>
                        <!-- /input-group -->
                    </li>
                   <!-- <li>
                        <div class="hide-menu t-earning">
                            <div id="sparkline2dash" class="m-b-10"></div><small class="db">TOTAL EARNINGS - JUNE 2017</small>
                            <h3 class="m-t-0 m-b-0">$2,478.00</h3></div>
                    </li>-->
                    <!--<li class="nav-small-cap m-t-10">--- Main Menu</li>-->
					<li><a href="<?php echo base_url();?>admin/dashboard" class="waves-effect"><i class="fa fa-desktop"></i> <span class="hide-menu"> Dashboard</span></a></li>
					<li><a href="<?php echo base_url();?>admin/order/dashboard" class="waves-effect"><i class="fa fa-opera"></i><span class="hide-menu"> General<span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">4</span></span></a>
						<ul class="nav nav-second-level">
							<li> <a href="<?php echo base_url()?>admin/user/new">Add Employee</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/users">Manage Employee</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/status/new">Add Status</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/status/new#status-list">Manage Status</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/property/size/new">Add Property Size</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/property/size/new#property-list">Manage Property Size</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/source/new">Add Source</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/source/new#source-list">Manage Source</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/customer/new">Add Client</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/customer">Manage Client</a> </li>
                            
                        </ul>
					</li>
					<li><a href="<?php echo base_url();?>admin/order/dashboard" class="waves-effect"><i class="fa fa-opera"></i><span class="hide-menu"> Pre Sales <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">4</span></span></a>
						<ul class="nav nav-second-level">
							<li> <a href="<?php echo base_url()?>admin/lead/new">Create Lead</a> </li>
                            <li> <a href="<?php echo base_url()?>admin/leads"> Manage Leads</a> </li>
                        </ul>
					</li>
					<li><a href="<?php echo base_url();?>admin/order/dashboard" class="waves-effect"><i class="fa fa-opera"></i><span class="hide-menu"> Sales <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">4</span></span></a>
						<ul class="nav nav-second-level">
							<li><a href="<?php echo base_url();?>admin/order/dashboard" class="waves-effect active"><i class="fa fa-opera"></i><span class="hide-menu"> Orders <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">4</span></span></a>
								<ul class="nav nav-second-level">
		                           <!-- <li> <a href="<?php echo base_url()?>admin/order/pendingorders">New Orders</a> </li>
		                            <li> <a href="<?php echo base_url()?>admin/order/completedorders">Completed Orders</a> </li>
		                            <li> <a href="<?php echo base_url()?>admin/order/cancelledorders">Cancelled Orders</a> </li>
									<li> <a href="<?php echo base_url()?>admin/order/neworder">Create Orders</a> </li>-->
									<li> <a href="<?php echo base_url()?>admin/customer/order/">Manage Orders</a> </li>
									<li> <a href="<?php echo base_url()?>admin/customer/order/new">Create Orders</a> </li>
		                        </ul>
							</li>
		                    <li> <a href="index.html" class="waves-effect active"><i class="fa fa-product-hunt" data-icon="v"></i> <span class="hide-menu"> Product <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">4</span></span></a>
		                        <ul class="nav nav-second-level">
									<li><a href="<?php echo base_url()?>admin/vendor/list">Vendor</a></li>
		                            <li><a href="<?php echo base_url()?>admin/category/list">Category</a></li>
		                            <!--<li><a href="<?php echo base_url()?>admin/subcategory/list/0">SubCategory</a></li>-->
		                            <li><a href="<?php echo base_url()?>admin/manufacture/list">Manufacture</a> </li>
									<li><a href="<?php echo base_url()?>admin/attribute_group/list">Attribute Group</a></li>
		                            <li><a href="<?php echo base_url()?>admin/attribute/list">Attribute</a></li>
		                            <li><a href="<?php echo base_url()?>admin/product/list">Products</a> </li>
		                            <!--<li> <a href="product-detail.html">Product Detail</a> </li>
		                            <li> <a href="product-edit.html">Product Edit</a> </li>-->
		                        </ul>
		                    </li>
	                    </ul>
                    </li>
					<!--<li><a href="<?php echo base_url();?>admin/customerlist" class="waves-effect active"><i class="fa fa-users"></i><span class="hide-menu"> Customers </span></a></li>-->
					<li><a href="" class="waves-effect active"><i class="fa fa-registered"></i><span class="hide-menu"> Reports </span></a></li>
					<li> <a href="" class="waves-effect active"><i class="ti-settings" data-icon="v"></i> <span class="hide-menu"> Discounts <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">1</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url()?>admin/coupon/list">Coupon</a> </li>
                            <!--<li> <a href="<?php echo base_url()?>admin/restaurantoffers">Offer</a> </li>-->  
                        </ul>
                    </li>
					<li> <a href="" class="waves-effect active"><i class="ti-settings" data-icon="v"></i> <span class="hide-menu"> Settings <span class="fa arrow"></span> <span class="label label-rouded label-custom pull-right">2</span></span></a>
                        <ul class="nav nav-second-level">
							<li> <a href="<?php echo base_url()?>admin/general/tickets">Tickets</a></li>
                            <li> <a href="<?php echo base_url()?>admin/general/reasonlist">Cancel Reasons</a></li>
                        </ul>
                    </li>
                 
                   <!-- <li><a href="inbox.html" class="waves-effect"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Apps <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="chat.html">Chat-message</a></li>
                            <li><a href="javascript:void(0)" class="waves-effect">Inbox<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="inbox.html">Mail box</a></li>
                                    <li> <a href="inbox-detail.html">Inbox detail</a></li>
                                    <li> <a href="compose.html">Compose mail</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)" class="waves-effect">Contacts<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li> <a href="contact.html">Contact1</a></li>
                                    <li> <a href="contact2.html">Contact2</a></li>
                                    <li> <a href="contact-detail.html">Contact Detail</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                   <li><a href="<?php echo base_url();?>admin/logout" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                   <!-- <li class="nav-small-cap">--- Support</li>
                    <li><a href="documentation.html" class="waves-effect"><i class="fa fa-circle-o text-danger"></i> <span class="hide-menu">Documentation</span></a></li>
                    <li><a href="gallery.html" class="waves-effect"><i class="fa fa-circle-o text-info"></i> <span class="hide-menu">Gallery</span></a></li>
                    <li><a href="faq.html" class="waves-effect"><i class="fa fa-circle-o text-success"></i> <span class="hide-menu">Faqs</span></a></li>-->
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->