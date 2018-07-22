<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/datepicker3.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-timepicker.min.css">
<link href="<?php echo asset_url();?>css/selectize.bootstrap3.css" rel="stylesheet">
<style>
.pmlabel {
	display:none;
}
</style>
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title" style="margin-bottom:5px;">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Product Add</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Product Add</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row" style="margin:0 -30px;">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="" id="addProduct" enctype='multipart/form-data' method="post" name="addProduct">
                                        <div class="form-body">
                                            <ul class="nav customtab nav-tabs" role="tablist">
				                                <li role="presentation" class="nav-item"><a href="#basic" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Basic Info</span></a></li>
				                                <li role="presentation" class="nav-item" id="sub-typehead" style="display:none"><a href="#subTab" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Subscription</span></a></li>
				                                <li role="presentation" class="nav-item"><a href="#image" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Image</span></a></li>
				                                <li role="presentation" class="nav-item"><a href="#meta_info" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">SEO</span></a></li>
												<li role="presentation" class="nav-item"><a href="#custom_option" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Custom Offers</span></a></li>
												<li role="presentation" class="nav-item" id="product_spec"><a href="#product_detail" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Product Specification</span></a></li>
												<li role="presentation" class="nav-item" id="tech_spec"><a href="#tech_specification" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Technical Specification</span></a></li>
				                            	
				                            </ul>
                                          	<div class="tab-content">
		  										<div id="basic"  role="tabpanel" class="tab-pane fade in active show"  aria-expanded="true" >  
												     <div class="row">
												     	 <div class="col-md-12">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Product Type <span class='text-danger'>*</span></label>
		                                                        <select class="form-control" onchange="productTypeChanged()" required id="product_type" name="product_type" data-placeholder="Choose Product Type" tabindex="1">
		                                                            <option value="">Select Product Type</option>
		                                                            <option value="1">Device</option>
		                                                            <option value="2">Kit</option>
		                                                            <option value="3">Subscription</option>
		                                                        </select>
		                                                    </div>
		                                                     <div class="messageContainer"></div>
		                                                </div>
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Product Name</label>
		                                                        <input type="text" id="name" name="name" class="form-control" placeholder="product name"> 
	                                                        </div>
	                                                        <div class="messageContainer"></div>
		                                                </div>
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Product SKU</label>
		                                                        <input type="text" id="sku" name="sku" class="form-control" placeholder="Product sku"> 
	                                                        </div>
	                                                        <div class="messageContainer"></div>
		                                                </div>
		                                            </div>
		                                            <div class="row">
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Product Description</label>
		                                                        <textarea rows="6" cols="" class="form-control" name="description" id="description"></textarea>
		                                                      </div>
		                                                      <div class="messageContainer"></div>
		                                                </div>
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Short Description</label>
		                                                         <textarea rows="6" cols="" class="form-control" name="short_description" id="short_description"></textarea>
		                                                     </div>
		                                                </div>
		                                            </div>
		                                             <div class="row">
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">New From Date</label>
		                                                        <input type="text" id="new_from_date" name="new_from_date" class="form-control" > 
	                                                        </div>
		                                                </div>
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">New To Date</label>
		                                                        <input type="text" id="new_to_date" name="new_to_date" class="form-control" >
		                                                     </div>
		                                                </div>
		                                            </div>
		                                            <div class="row">
		                                                <div class="col-md-6">
		                                                  	<div class="form-group">
		                                                        <label class="control-label">Unit Price <span class="pmlabel">(Per Month)</span></label>
		                                                        <input type="text" id="unit_price" name="unit_price" value="" class="form-control" >
		                                                 	</div>
		                                                  	<div class="messageContainer"></div>
		                                             	</div>
		                                             	<div class="col-md-6">
		                                                  	<div class="form-group">
		                                                        <label class="control-label">Karma Points</label>
		                                                        <input type="text" id="karma_points" name="karma_points" value="0" class="form-control" >
		                                                 	</div>
		                                                  	<div class="messageContainer"></div>
		                                             	</div>
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Status <span class='text-danger'>*</span></label>
		                                                        <select class="form-control" id="status" name="status" data-placeholder="Choose Status" tabindex="1">
		                                                            <option value="0">Disable</option>
		                                                            <option value="1">Enable</option>
		                                                        </select>
		                                                    </div>
		                                                     <div class="messageContainer"></div>
		                                                </div>
		                                                <input type="hidden" name="min_quantity" id="min_quantity" value="1" />
		                                            </div>
	                                                
	                                               <div class="row" id="kit-table" style="display:none;">
														<h4 class="box-title">Create Kit</h4>
														<br /><br /><br /> <br />
														<table data-toggle="table"  id="tb" data-mobile-responsive="true" class="table table-hover" style="margin-top: -41px;">
															<thead>
																<tr>
																	<th>Product Name</th>
																	<th>Qty</th>
																	<th>Unit Price</th>
																	<th>Row Total</th>
<!-- 																	<th>Kit Rate</th> -->
																	<th>Action</th>
																</tr>
															</thead>
															<tbody id="kit_product_row">	
																<tr>
																	<td>
																		<select class="form-control" class="selectize" id="product_name[]"  name ="kit_product_name[]" onchange="productChanged(this);">
																			<option  value=""> Enter product name</option>
																			<?php  foreach($allProducts as $allProduct){?>
																				<option data-price="<?php echo $allProduct['price']?>" value="<?php echo $allProduct['id']?>"><?php echo $allProduct['name']?></option>
																			<?php }?>
																		</select>
																	</td>
																	<td>
																		<input type="number" class="form-control product-qty" onchange="qtyChanged(this);" value="" min="1" name="kit_qty[]" id="qty" />
																	</td>
																	<td>
																		<input type="text" class="form-control unit-price"  class="form-control"  value=""  name="unit-price[]" id="unit-price" />
																	</td>
																	<td><input type="text" class="form-control rowTotalPrice" value="" readonly name="rowTotalPrice[]" id="rowTotalPrice" /></td>
																	<!-- td>
																		<input type="text" class="form-control kitPrice" value=""  name="kitPrice[]" id="kitPrice" />
																	</td-->
																	<td><i class="btn fa fa-plus" onclick="addProductRow();" >Add</i></td>
																</tr>
															</tbody>
														</table>
													</div>
                                                </div>
                                                <div id="subTab" role="tabpanel" class="tab-pane fade"  aria-expanded="true">
                                                	<h4><br /></h4>
                                                	<div class="row" id="subscription-table">
														<table data-toggle="table"  id="tb" data-mobile-responsive="true" class="table table-hover" style="margin-top: -41px;">
															<thead>
																<tr>
																	<th>Title</th>
																	<th>Price</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody id="subscription_row">	
																<tr>
																	<td>
																		<select class="form-control subs-title" class="selectize" id="subs-title" name="subs-title[]" >
																		<option value=""> Enter Title</option>
																			<?php  foreach($subsciptions as $subsciption){?><option  value="<?php echo $subsciption["id"]?>"><?php echo $subsciption["name"]?></option><?php }?>
																		</select>
																	</td>
																	<td>
																		<input type="text" class="form-control subsPrice" value=""  name="subsPrice[]" id="subsPrice" />
																	</td>
																	<td><i class="btn fa fa-plus" onclick="addSubscriptionRow();" >Add</i></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
                                            	<div id="image" role="tabpanel" class="tab-pane fade"  aria-expanded="true">
		                                            <div class="row">
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Product Image</label>
		                                                        <input type="file" id="product_image" multiple  class="imageUpload" name="userfile[]" class="form-control" >
		                                                     </div>
		                                                </div>
	                                                </div>
	                                                <div id="img-preview" class="imageOutput"></div>
                                                </div>
                                                <div id="meta_info" role="tabpanel" class="tab-pane fade"  aria-expanded="true">
	                                                <div class="row">
		                                                <div class="col-md-12">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Meta Title</label>
		                                                        <input type="text" id="meta_title" name="meta_title" class="form-control" >
		                                                     </div>
		                                                </div>
	                                           		 </div>
		                                             <div class="row">
		                                            	 <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Meta Keyword</label>
		                                                        <textarea rows="6" cols="" class="form-control" name="meta_keyword" id="meta_keyword"></textarea>
		                                                      </div>
		                                                </div>
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Meta Description</label>
		                                                        <textarea rows="6" cols="" class="form-control" name="meta_description" id="meta_description"></textarea>
		                                                      </div>
		                                                </div>
		                                            </div>
										   		 </div>
										   		 <div id="categories" role="tabpanel" class="tab-pane fade"  aria-expanded="true">
	                                                 <?php  
				                                         function getList($categories, $id=0){
				                                            $newList = null;
															$i = 0;
				                                            foreach($categories as $key => $row) {
				                                            	if ($row['parent_id'] == $id) {
														            // Add an UL tag when LI exists
														            $newList == null ? $newList = "<ul>" : $newList;
														            $newList .= "<li>";
														            $newList .= "<input type='checkbox' id='".$row['id']."' name='category[]' value='".$row['id']."'>{$row['name']}";
														            // Find childrens
														             $newList .= getList(array_slice($categories,$key),$row['id']);
														            $newList .= "</li>";
														        }   
														    }   
														    // Add an UL end tag
														    strlen($newList) > 0 ? $newList .= "</ul>" : $newList;
														    $i++;
														    return $newList;
														    
				                                         } 
				                                         $new = getList($categories, $id=0);
				                                         echo  $new ;
												    ?> 
										   		 </div>
										   		 
										   		<div id="variant" role="tabpanel" class="tab-pane fade"  aria-expanded="true">
													<div class="row">
		                                                <div class="col-md-6">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Attribute Group</label>
		                                                        <select class="form-control attrgrp" id="attribute_group_id" name="attribute_group_id" data-placeholder="Choose a Category" tabindex="1">
		                                                            <option >Select Group</option>
		                                                            <?php foreach($attrgroup as $attrgrp) { ?>
		                                                            <option value="<?php echo $attrgrp['attribute_group_id']?>"><?php echo $attrgrp['name'] ?></option>
		                                                            <?php } ?>
		                                                        </select>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="row">
		                                                <div class="col-md-12">
		                                                    <h3 class="box-title m-t-40">Extra Attributes</h3>
		                                                    <div class="table-responsive" id="attributes">
		                                                        
		                                                    </div>
		                                                </div>
		                                            </div>
	                                            </div>
												<div id="custom_option" role="tabpanel" class="tab-pane fade"  aria-expanded="true">
		                                            <div class="row">
		                                                <div class="col-md-12">
		                                                    <div  id="custom_opt_details">
		                                                    </div>
		                                                    <div class="row">
		                                               			 <div class="col-md-12">
		                                                   			 <div id="custom_opt_details">
			                                                   			 <div class="row-details" id="row-details">
			                                                   			 	<div class="row" id="custom-head1">
			                                                   			 		<div class="col-md-3">
			                                                   			 			<div class="form-group">
				                                                   			 			<label class="control-label">Title</label>
				                                                   			 			<input type="text" class="form-control" placeholder="Title" name="fTitle[]" id="fTitle1" />
			                                                   			 			</div>
			                                                   			 			<div class="messageContainer"></div>
	                                                   			 				</div>
	                                                   			 				<div class="col-md-3">
	                                                   			 					<div class="form-group">
		                                                   			 					<label class="control-label">Quantity <span class="pmlabel">(In Months)</span></label>
		                                                   			 					<input type="number" class="form-control" placeholder="quantity" name="fQty[]" id="fQty" />
		                                                   			 				</div>
			                                                   			 			<div class="messageContainer"></div>
	                                                   			 				</div>
	                                                   			 				<div class="col-md-3">
	                                                   			 					<div class="form-group">
	                                                   			 						<label class="control-label">Price</label>
	                                                   			 						<input type="text" class="form-control" placeholder="price" name="fPrice[]" id="fPrice_1" />
	                                                   			 					</div>
			                                                   			 			<div class="messageContainer"></div>
	                                                   			 				</div>
	                                                   			 				<div class="col-md-3">
	                                                   			 					<div class="form-group">
		                                                   			 					<label class="control-label">Recommend</label>
		                                                   			 					<select name="frecommend[]" class="form-control" >
		                                                   			 						<option value="0">No</option>
		                                                   			 						<option value="1">Yes</option>
		                                                   			 					</select>
	                                                   			 					</div>
			                                                   			 			<div class="messageContainer"></div>
	                                                   			 				</div>
	                                                   			 				<div class="col-md-3">
	                                                   			 					<div class="form-group">
		                                                   			 					<label class="control-label">From Date</label>
		                                                   			 					<input type="text" class="form-control from_date" placeholder="From Date" name="ffrom_date[]" id="ffrom_date_1" />
		                                                   			 				</div>
			                                                   			 			<div class="messageContainer"></div>
	                                                   			 				</div>
	                                                   			 				<div class="col-md-3">
	                                                   			 					<div class="form-group">
		                                                   			 					<label class="control-label">To Date</label>
		                                                   			 					<input type="text" class="form-control to_date" placeholder="To Date" name="fto_date[]" id="fto_date_1" />
		                                                   			 				</div>
			                                                   			 			<div class="messageContainer"></div>
	                                                   			 				</div>
	                                                   			 				<div class="col-md-3">
	                                                   			 					<div class="form-group">
		                                                   			 					<label class="control-label">Sort Order</label>
		                                                   			 					<input type="number" class="form-control" placeholder="Sort Order" name="fsort_order[]" id="fsort_order_1" />
		                                                   			 				</div>
			                                                   			 			<div class="messageContainer"></div>
	                                                   			 				</div>
	                                                   			 				<div class="col-md-3">
	                                                   			 					<label class="control-label">Action</label>
	                                                   			 					<br />
	                                                   			 					<button class="btn btn-md btn-success" type="button" onclick="addNewField()"><i class="fa fa-plus"></i> Add More</button>
	                                                   			 				</div>
	                                                   			 			</div>
                                                   			 			</div>
                                                        		 	</div>
				                                                </div>
				                                            </div>
		                                                </div>
		                                            </div>
	                                            </div>
	                                            <div id="product_detail"  role="tabpanel" class="tab-pane fade"  aria-expanded="true" >  
												     <div class="row">
		                                                <div class="col-md-5">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Component Name</label>
		                                                        <input type="text" id="component_name" name="component_name[]" class="form-control" placeholder="Component name"> 
	                                                        </div>
	                                                        <div class="messageContainer"></div>
		                                                </div>
		                                                <div class="col-md-5">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Component Image</label>
		                                                        <input type="file" id="component_image" name="component_image[]" class="form-control" placeholder="Component Image"> 
	                                                        </div>
	                                                        <div class="messageContainer"></div>
		                                                </div>
		                                                <div class="col-md-2">
                                                   			 <label class="control-label">Action</label>
                                                   			 <br />
                                                   			 <button class="btn btn-md btn-success" type="button" onclick="addNewComponent()"><i class="fa fa-plus"></i> Add More</button>
                                                   		</div>
		                                            </div>
                                                </div>
                                                <div id="tech_specification"  role="tabpanel" class="tab-pane fade"  aria-expanded="true" >  
												     <div class="row">
		                                                <div class="col-md-5">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Attribute Name</label>
		                                                        <input type="text" id="attr_name" name="attr_name[]" class="form-control" placeholder="Attribute name"> 
	                                                        </div>
	                                                        <div class="messageContainer"></div>
		                                                </div>
		                                                <div class="col-md-5">
		                                                    <div class="form-group">
		                                                        <label class="control-label">Attribute Value</label>
		                                                        <input type="text" id="attr_value" name="attr_value[]" class="form-control" placeholder="Attribute name"> 
	                                                        </div>
	                                                        <div class="messageContainer"></div>
		                                                </div>
		                                                <div class="col-md-2">
                                                   			 <label class="control-label">Action</label>
                                                   			 <br />
                                                   			 <button class="btn btn-md btn-success" type="button" onclick="addNewTechSpec()"><i class="fa fa-plus"></i> Add More</button>
                                                   		</div>
		                                            </div>
                                                </div>
                                             </div>
                                             <div class="row" id="response">&nbsp;</div>
                                             <hr>
                                             
	                                       	 <div class="row form-actions m-t-40 center">
	                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
	                                            <button type="button" class="btn btn-default">Cancel</button>
	                                        </div>
	                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- /.container-fluid -->
   		</div>
   
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/selectize.min.js"></script>
<script>
$('.selectize').selectize({
    create: true,
    maxItems: 1
});
</script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
		
<script>

$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$('#ffrom_date_1').datepicker();
$('#fto_date_1').datepicker();
$('#new_to_date').datepicker().on('changeDate', function(ev){
	$('#new_to_date').bootstrapValidator('revalidateField', 'cycle_effective_date');
});
$('#new_from_date').datepicker().on('changeDate', function(ev){
	$('#new_from_date').bootstrapValidator('revalidateField', 'cycle_effective_date');
});


$('#addProduct').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        name: {
            validators: {
                notEmpty: {
                    message: 'Name is required and cannot be empty'
                }
            }
        },
        sku: {
            validators: {
                notEmpty: {
                    message: 'SKU is required and cannot be empty'
                }
            }
        },
        unit_price : {
	        validators: {
	        	numeric: {
                    message: 'The value is not a number',
                }, 
	            notEmpty: {
	                message: 'Price is required and cannot be empty'
	            }
	        }
	    },
	    minimum_quantity : {
	        validators: {
	        	numeric: {
                    message: 'The value is not a number',
                } 
	            
	        }
	    },
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addProduct();
});

function addProduct() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/product/add',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addProduct').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	$("#response").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#response").removeClass('alert-success');
       	$("#response").addClass('alert-danger');
		$("#response").html(resp.msg);
		$("#response").show();
		alert(resp.msg);
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"admin/product/list";
        //window.location.href = base_url+"admin/product/add";
  	}
}

function abc(input){
	//alert('hello');
	$(input).val('1')
}


//Image Preview 
var images = $('.imageOutput')

$(".imageUpload").change(function(event){
    readURL(this);
});

function readURL(input) {

    if (input.files && input.files[0]) {
        $.each(input.files, function() {
            var reader = new FileReader();
            reader.onload = function (e) {           
                images.append('<div class="row"><div class="col-md-10"><img height="150" width="150" class="img-responsive" src="'+ e.target.result+'" /> <input type="radio" name="is_image[]" value="0" onclick="abc(this)" /> Base Image </div> </div><hr />');
            }
            reader.readAsDataURL(this);
        });
        
    }
}

$(function () {
    $("input[type='checkbox']").change(function () {
        $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked);
    });
});
</script>

<script>
var countHead ='0';
var rowId ='1';
function custom_option(){
	countHead++
	var html = '<div class="maindiv" style="padding-bottom: 5%;" > ';
	    html += '<div class="row custom-head panel panel-success block5" > ';
	    html += '<input type="hidden" class="form-control" value="'+countHead+'" name="customid[]" id="custom_id[]">';
		html += '<div class="col-md-4"> <label class="control-label">Title</label><input type="text" class="form-control" placeholder="Title" name="title[]" id="custom_title[]"></div>';
		html += '<div class="col-md-4"><label class="control-label">is Required</label><select class="form-control" name="is_required[]" id="is_required[]"><option value="1">Yes</option><option value="0">No</option></select></div>';
		html += '<div class="col-md-4"><label class="control-label">sort order</label><input type="text" class="form-control" placeholder="" name="sort_order[]" id="sort_order[]"></div>';
		html += '</div>';
		html += '<div class="row-details" id="row-details'+countHead+'"><h2>Custom Details </h2> <hr /></center> ';
		html += '<div class="row" id="custom-head'+countHead+'">';
		
		html += '<div class="col-md-3"><label class="control-label">Title</label><input type="text" class="form-control" placeholder="Title" name="fTitle[]" id="fTitle'+countHead+'"></div>';
		html += '<div class="col-md-3"><label class="control-label">Price</label><input type="text" class="form-control" placeholder="Price" name="fPrice[]" id="fPrice_'+countHead+'"></div>';
		html += '<div class="col-md-3"><label class="control-label">sort order</label><input type="text" class="form-control" placeholder="Sort Order" name="fsort_order[]" id="fsort_order_'+countHead+'"></div>';
		html += '<div class="col-md-3"><button class="btn btn-sm btn-success" type="button" onclick="addNewField('+countHead+')"><i class="fa fa-plus"></i></button></div>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
	$('#custom_opt_details').append(html);
}
var rowId ='1';
function addNewField(){
	var vcnt = parseInt($('.from_date').length) + 1;
	var html = '<div class="row">';
		html += '<div class="col-md-3"><label class="control-label">&nbsp;</label><input type="text" class="form-control" placeholder="Title" name="fTitle[]" id="fTitle"></div>';
		html += '<div class="col-md-3"><label class="control-label">&nbsp;</label><input type="number" class="form-control" placeholder="" name="fQty[]" id="fQty"></div>';
		html += '<div class="col-md-3"><label class="control-label">&nbsp;</label><input type="text" class="form-control" placeholder="Price" name="fPrice[]" id="fPrice"></div>';
		html += '<div class="col-md-3"><label class="control-label">&nbsp;</label><select name="frecommend[]" class="form-control"><option value="0">No</option><option value="1">Yes</option></select></div>';
		html += '<div class="col-md-3"><label class="control-label">&nbsp;</label><input type="text" class="form-control from_date" placeholder="From Date" name="ffrom_date[]" id="ffrom_date_'+vcnt+'"></div>';
		html += '<div class="col-md-3"><label class="control-label">&nbsp;</label><input type="text" class="form-control to_date" placeholder="To Date" name="fto_date[]" id="fto_date_'+vcnt+'"></div>';
		html += '<div class="col-md-3"><label class="control-label">&nbsp;</label><input type="number" class="form-control" placeholder="Sort Order" name="fsort_order[]" id="fsort_order"></div>';
		html += '<div class="col-md-3"><label class="control-label">&nbsp;</label><br /><button class="btn btn-md btn-danger" type="button" onclick="removeField(this)"><i class="fa fa-minus"></i> Remove</button></div>';
		html += '</div>';
	$('#row-details').append(html);
	$('#ffrom_date_'+vcnt).datepicker();
	$('#fto_date_'+vcnt).datepicker();
}

function removeField(a){
	$(a).parent().parent().remove();
}

function addNewComponent(){
	var html = '<div class="row">'
        	  +'<div class="col-md-5">'
        	  +'<div class="form-group">'
        	  +'<input type="text" id="component_name" name="component_name[]" class="form-control" placeholder="Component name">' 
        	  +'</div>'
        	  +'<div class="messageContainer"></div>'
        	  +'</div>'
        	  +'<div class="col-md-5">'
        	  +'<div class="form-group">'
        	  +'<input type="file" id="component_image" name="component_image[]" class="form-control" placeholder="Component Image">'
        	  +'</div>'
        	  +'<div class="messageContainer"></div>'
        	  +'</div>'
        	  +'<div class="col-md-2">'
        	  +'<button class="btn btn-md btn-danger" type="button" onclick="removeComponent(this)"><i class="fa fa-minus"></i> Remove</button>'
        	  +'</div>'
        	  +'</div>';
	$('#product_detail').append(html);
}

function removeComponent(a){
	$(a).parent().parent().remove();
}

function addNewTechSpec(){
	var html = '<div class="row">'
        	  +'<div class="col-md-5">'
        	  +'<div class="form-group">'
        	  +'<input type="text" id="attr_name" name="attr_name[]" class="form-control" placeholder="Attribute name">'
        	  +'</div>'
        	  +'<div class="messageContainer"></div>'
        	  +'</div>'
        	  +'<div class="col-md-5">'
        	  +'<div class="form-group">'
        	  +'<input type="text" id="attr_value" name="attr_value[]" class="form-control" placeholder="Attribute name"> '
        	  +'</div>'
        	  +'<div class="messageContainer"></div>'
        	  +'</div>'
        	  +'<div class="col-md-2">'
        	  +'<button class="btn btn-md btn-danger" type="button" onclick="removeTechSpec(this)"><i class="fa fa-minus"></i> Remove</button>'
        	  +'</div>'
        	  +'</div>';
	$('#tech_specification').append(html);
}

function removeTechSpec(a){
	$(a).parent().parent().remove();
}

function productTypeChanged(){
	var type = $('#product_type').val();
	$('.pmlabel').hide();
	if(type == 2) {
		$('#kit-table').css("display", "block");
		$('#sub-typehead').css("display", "none");
	} else if(type == 3) {
		$('#kit-table').css("display", "none");
		$('#sub-typehead').css("display", "none");
		$('.pmlabel').show();
	} else {
		$('#kit-table').css("display", "none");
		$('#sub-typehead').css("display", "none");
	}

	if(type == 1) {
		$("#product_spec").show();
		$("#tech_spec").show();
	} else {
		$("#product_spec").hide();
		$("#tech_spec").hide();
	}
}
		
function addProductRow(){
	var html ="";
	var html ="";
	html += '<tr><td><select class="form-control" class="selectize" id="product_name" name="kit_product_name[]" onchange="productChanged(this);" ><option value=""> Enter product name</option>';
	html += '<?php  foreach($allProducts as $allProduct){?><option data-price="<?php echo $allProduct["price"]?>" value="<?php echo $allProduct["id"]?>"><?php echo $allProduct["name"]?></option><?php }?></select>';
	html +='</td><td>';	
	html +='<input type="text" class="form-control product-qty" onchange="qtyChanged(this);" value="0" min="1"  max=""  name="kit_qty[]" id="qty" />';
	html +='</td> <td>';
	html +='<input type="text" class="form-control unit-price" value="0"  name="kit_unit-price[]" id="unit-price" />';
	html +='</td> <td>';
	html +='<input type="text" class="form-control rowTotalPrice" value="" readonly name="kit_rowTotalPrice[]" id="rowTotalPrice" />';
	html +='</td> <td>';
	/*html +='<input type="text" class="form-control kitPrice" value=""  name="kitPrice[]" id="kitPrice" />';
	html +='</td> <td>';*/
	html +='<i class="btn fa fa-plus" id="removeProductRow" onclick="removeProductRow(this)"  >Remove</i>';
	html +='</td> </tr>';

	 $("#kit_product_row").append(html);
}
function removeProductRow(a){
	$(a).parent().parent().remove();
	updateTotals();
}


function productChanged(a){
	$(a).closest('tr').find('.unit-price').val($('option:selected', a).data('price'));
// 	var unit-price = $(a).closest('tr').find('.unit-price').val();
	var inqty = $(a).closest('tr').find('.product-qty').val(1);
 	var qty = $(a).closest('tr').find('.product-qty').val();
 	var unit_price = $('option:selected', a).data('price');
 	var row_total = qty * unit_price;
	var qty = $(a).closest('tr').find('.rowTotalPrice').val(row_total);
}

function qtyChanged(a){
	var qty = $(a).val();
	var unit_price = $(a).closest('tr').find('.unit-price').val();;
	var row_total = qty*unit_price;
	$(a).closest('tr').find('.rowTotalPrice').val(row_total);
}


// Add subscription row

/*function addSubscriptionRow(){
	var html ="";
	html += '<tr><td><select class="form-control subs-title" class="selectize" id="subs-title" name="subs-title[]" ><option value=""> Enter Title</option>';	
	html +='<?php  foreach($subsciptions as $subsciption){?><option  value="<?php echo $subsciption["id"]?>"><?php echo $subsciption["name"]?></option><?php }?></select>';
	html +='</td> <td>';
	html +='<input type="text" class="form-control subsPrice" value=""  name="subsPrice[]" id="subsPrice" />';
	html +='</td> <td>';
	html +='<i class="btn fa fa-plus" id="removeSubscriptionRow" onclick="removeSubscriptionRow(this)"  >Remove</i>';
	html +='</td> </tr>';

	 $("#subscription_row").append(html);
}*/
function removeSubscriptionRow(a){
	$(a).parent().parent().remove();
}
		
</script>

