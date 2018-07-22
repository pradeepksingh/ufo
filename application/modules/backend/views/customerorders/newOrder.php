<link href="<?php echo asset_url();?>css/selectize.bootstrap3.css" rel="stylesheet">
<link href="<?php echo asset_url();?>css/datepicker3.css" rel="stylesheet">
<link href="<?php echo asset_url();?>css/jquery.multiselect.css" rel="stylesheet">
<style>
.pac-container {
    z-index: 1051 !important;
}
</style>
<div id="page-wrapper">
	<div class="row bg-title">
		<div class="col-lg-12 text-center">
			<h3>Add New Order</h3>
		</div>
	</div>
	
	<form  action="" method="post" id="newaddress" name="newaddress"  enctype="multipart">
		<div class="tab-content">
			<input type="hidden" name="latitude" id="latitude" value=""/>
			<input type="hidden" name="longitude" id="longitude" value=""/>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-name">
											<label class="control-label">Full Name <span class='text-danger'>*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control" value="" name="name" id="name" autocomplete="off"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-email">
											<label class="control-label ">Customer Email <span class='text-danger'>*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control" value="" name="email" id="email" autocomplete="off"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-mobile">
											<label class="control-label ">Customer Mobile <span class='text-danger'>*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control" value="" name="mobile" id="mobile" autocomplete="off"/>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-address">
											<label class="control-label ">Address <span class='text-danger'>*</span></label>
											<div class="col-sm-12" id="clientaddress">
												<select id="orderaddress" name="orderaddress" class="col-sm-6">Select Address</select>
<!-- 												<input type='button' class="btn btn-success" value="+ Add Address" onclack="opennewAddress()" /> -->
												<button type="button" class="btn btn-info btn-lg"  onclick="openNewAddressModal();">+ Add Address</button>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								 <div class="modal fade" id="myModal4" role="dialog" style="padding-left: 15px; padding-top: 130px;">
								   <div class="modal-dialog inbox modal-lg"> 
								      <div class="modal-content">
								      	<div class="modal-header">
								       		<button type="button" class="close" data-dismiss="modal">&times;</button>
								       	</div>
								        <div class="modal-body">
								           <div class="row">
											  <div class="col-md-10 col-sm-10 col-xs-10">
											    <h3>+ New Client Address</h3>
										      </div>
<!-- 											  <div class="col-md-2 col-sm-2 col-xs-2"> -->
<!-- 											    <a href=""> <img src="../images/error.png" alt="cancle" data-dismiss="modal"></a> -->
<!-- 											   </div> -->
										    </div>
										  		<input type="hidden" name="userid" id="userid" value="0"/>
												<div class="row">
													<div class="col-lg-6 margin-bottom-5">
														<div class="form-group" id="error-mobile">
															<label class="control-label ">Address name <span class="text-danger">*</span></label>
															<div class="col-sm-12">
																<input type="text" class="form-control"    name="addressname" placeholder="Address name" id="addressname" autocomplete="off"/>
															</div>
															<div class="messageContainer col-sm-10"></div>
														</div>
													</div>
													<div class="col-lg-6 margin-bottom-5">
														<div class="form-group" id="error-address">
															<label class="control-label ">Address <span class="text-danger">*</span></label>
															<div class="col-sm-12">
																<input type="text" class="form-control"  name="shipperaddress" id="shipperaddress" placeholder="shipping address" autocomplete="off"/>
															</div>
															<div class="messageContainer col-sm-10"></div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6 margin-bottom-5">
														<div class="form-group" id="error-mobile">
															<label class="control-label ">Appartment number <span class="text-danger">*</span></label>
															<div class="col-sm-12">
																<input type="text" class="form-control" value=""  name="aptno" id="aptno" placeholder="Appartment number" autocomplete="off"/>
															</div>
															<div class="messageContainer col-sm-10"></div>
														</div>
													</div>
													<div class="col-lg-6 margin-bottom-5">
														<div class="form-group" id="error-address">
															<label class="control-label ">Locality <span class="text-danger">*</span></label>
															<div class="col-sm-12">
																<input type="text" class="form-control" value=""  name="locality" id="locality" placeholder="locality"  value="" autocomplete="off"/>
															</div>
															<div class="messageContainer col-sm-10"></div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6 margin-bottom-5">
														<div class="form-group" id="error-mobile">
															<label class="control-label ">Landmark <span class="text-danger">*</span></label>
															<div class="col-sm-12">
																<input type="text" class="form-control" value="" name="landmark" id="landmark" placeholder="Landmark" autocomplete="off"/>
															</div>
															<div class="messageContainer col-sm-10"></div>
														</div>
													</div>
													<div class="col-lg-6 margin-bottom-5">
														<div class="form-group" id="error-address">
															<label class="control-label ">Pincode <span class="text-danger">*</span></label>
															<div class="col-sm-12">
																<input type="text" class="form-control" name="pincode" id="pincode" placeholder="pincode" autocomplete="off"/>
															</div>
															<div class="messageContainer col-sm-10"></div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6 margin-bottom-5">
														<div class="form-group" id="error-mobile">
															<label class="control-label ">City <span class="text-danger">*</span></label>
															<div class="col-sm-12">
																<input type="text" class="form-control" value="" name="city" id="city" placeholder="city name" autocomplete="off"/>
															</div>
															<div class="messageContainer col-sm-10"></div>
														</div>
													</div>
													<div class="col-lg-6 margin-bottom-5">
														<div class="form-group" id="error-address">
															<label class="control-label ">State <span class="text-danger">*</span></label>
															<div class="col-sm-12">
																<input type="text" class="form-control" value="" name="state" id="state" placeholder="state name" autocomplete="off"/>
															</div>
															<div class="messageContainer col-sm-10"></div>
														</div>
													</div>
												</div>
													
												<div class="row">
													<div class="col-lg-12">
														<button type="submit" id="submitnewaddress" class="btn btn-success">Submit</button>
													</div>
												</div>
										  </div>
									  	</div>
								 	  </div>
						            </div>
								</div>								
							</div>
						</div>
					</div>
				</div>
		</form>
		
		<form  action="" method="post" id="neworder" name="neworder"  enctype="multipart/form-data">
		<input type="hidden" id="newuserid" name="newuserid" />
		<input type="hidden" id="newaddressid" name="newaddressid" />
		<input type="hidden" id="grandtotal" name="grandtotal" />
		<input type="hidden" id="unitpricetotal" name="unitypricetotal[]" />
		<input type="hidden" id="hsubtotal" name="hsubtotal"/>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group" id="selectcategory">
										<label class="control-label">Category <span class='text-danger'>*</span></label>
										<div class="col-sm-12">
											<select id="filer_category_ids" name="filer_category_ids[]" class="form-control show-tick" multiple class="form-control1" required>
												<option value="1">Device</option>
												<option value="2">Kit</option>
												<option value="3">Subscription</option>
											</select>
										</div>
										<div class="messageContainer col-sm-10"></div>
									</div>
								</div>
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group" id="selectproduct">
										<label class="control-label ">Select Project <span class='text-danger'>*</span></label>
										<div class="col-sm-12">
											<select id="productids"  name="productids[]" multiple="multiple" required>
											<option value=""></option>
											</select>
										</div>
										<div class="messageContainer col-sm-10"></div>
									</div>
								</div>
							</div>
							<div class="row" id="products"></div>
							<div class="row">
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group">
									<label class="control-label ">Select Payment Method <span class='text-danger'>*</span></label>
										<div class="col-sm-12">
											<input type="radio"  name="cod" id="cod" value="0" required />Cash On Delivery</input>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 margin-bottom-5"></div>
								<div class="col-lg-6 margin-bottom-5">
									<div class="form-group">
										<div class="col-sm-12">
											<input type="submit"  name="ordersubmit" id="ordersubmit"  class="btn btn-success" value="Submit"/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
<script type="text/javascript" src="<?php echo asset_url();?>js/selectize.min.js" ></script>
<script type="text/javascript" src="<?php echo asset_url();?>js/jquery.multiselect.js" ></script>
<script>
$('.selectize').selectize({
    create: true,
    maxItems: 1
});
</script>

<script src="<?php echo asset_url();?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqbaVKWXKDsrUY87hCEVlQMXpcCAzR-38&libraries=places&callback=initMap"
        async defer></script>
<script>
// $(window).load(function(){
// 	initMap();
// });

$("#orderaddress").change(function(){
	$("#newaddressid").val($(this).val());
});

$('#productids').multiselect({
    columns: 1,
    placeholder: 'Select Product',
    search: true,
    selectAll: true,
    onControlClose : function(element){getProject(element);}     
});
$('#filer_category_ids').multiselect({
    columns: 1,
    placeholder: 'Select Category',
    search: true,
    selectAll: true,
    onControlClose : function(element){getProjectList(element);}     
});
$('#name').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z ]/g, function(str) { return ''; } ) );
});
$('#city').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z ]/g, function(str) { return ''; } ) );
});
$('#state').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z ]/g, function(str) { return ''; } ) );
});
$("#pincode").attr('maxlength','6');
$('#pincode').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
});
$('#newaddress').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	mobile: {
            validators: {
            	notEmpty: {
                    message: 'The Mobile is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
            }
        },
        name: {
            validators: {
                notEmpty: {
                    message: 'Name is required and cannot be empty'
                }
            }
        },
        email: {
            validators: {
            	notEmpty: {
                    message: 'The Email is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
                }
            }
        },
    	aptno: {
            validators: {
            	notEmpty: {
                    message: 'Appartment number is required and cannot be empty'
            	}
        	}
    	},
        addressname: {
            validators: {
                notEmpty: {
                    message: 'Name is required and cannot be empty'
                }
            }
        },
        locality: {
            validators: {
            	notEmpty: {
                    message: 'Locality is required and cannot be empty'
                }
            }
        },
        shipperaddress: {
            validators: {
                notEmpty: {
                    message: 'Shipper Address is required and cannot be empty'
                }
            }
        },
        landmark:{
        	validators: {
                notEmpty: {
                    message: 'Landmark is required and cannot be empty'
                }
            }
        },
        pincode: {
            validators: {
                notEmpty: {
                    message: 'Pincode is required and cannot be empty'
                }
            }
        },
        city: {
            validators: {
               notEmpty: {
                    message: 'City is required and cannot be empty'
                }
            }
        },
        state: {
            validators: {
                notEmpty: {
                    message: 'State is required and cannot be empty'
                }
            }
        }
    }	
        
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	saveNewAddress();
});

function saveNewAddress(){
	 ajaxindicatorstart("Please wait.. while loading..");
	var options = {
	 		target : '#pricingresponse', 
	 		beforeSubmit : showNewAddRequest,
	 		success :  showNewAddResponse,
	 		url : base_url+"admin/customer/address/add",
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#newaddress').ajaxSubmit(options);
}

function showNewAddRequest(formData, jqForm, options){
	$("#pricingresponse").hide();
   	var queryString = $.param(formData);
	return true;
}

function showNewAddResponse(resp, statusText, xhr, $form){
        var address="";
		if(resp != "" && resp != null){
			$(resp).each(function(index){
				address+="<option id="+resp[index].id+" class='col-sm-10'>"+resp[index].address+"</option>";
			});
			$("#orderaddress").html(address);
		}
		
		$("#addressname").val('');
		$("#shipperaddress").val('');
		$("#aptno").val('');
		$("#locality").val('');
		$("#landmark").val('');
		$("#pincode").val('');
		$("#city").val('');
		$("#state").val('');
		$('#newaddress').bootstrapValidator('revalidateField', 'name');
		$('#newaddress').bootstrapValidator('revalidateField', 'mobile');
		$('#newaddress').bootstrapValidator('revalidateField', 'email');
		$('#newaddress').bootstrapValidator('revalidateField', 'addressname');
		$('#newaddress').bootstrapValidator('revalidateField', 'shipperaddress');
		$('#newaddress').bootstrapValidator('revalidateField', 'aptno');
		$('#newaddress').bootstrapValidator('revalidateField', 'locality');
		$('#newaddress').bootstrapValidator('revalidateField', 'landmark');
		$('#newaddress').bootstrapValidator('revalidateField', 'pincode');
		$('#newaddress').bootstrapValidator('revalidateField', 'city');
		$('#newaddress').bootstrapValidator('revalidateField', 'state');
		$("#myModal4").modal('hide');
		ajaxindicatorstop();
  	//}
}


function initMap() {
	var options = {
	  	componentRestrictions: {country: 'in'}
	};
	var input =  document.getElementById('landmark');
	var autocomplete = new google.maps.places.Autocomplete(input,options);
	autocomplete.addListener('place_changed', function() {
		var place = autocomplete.getPlace();
	    if (!place.geometry) {
	      window.alert("Autocomplete's returned place contains no geometry");
	      return;
	    }
	    $('#latitude').val(place.geometry.location.lat());
	    $('#longitude').val(place.geometry.location.lng());
	});
}

$("#mobile").typeahead({
    onSelect: function(item) {
        itemvalue = item.value;
        ajaxindicatorstart("Please wait.. while loading..");
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
            alert(result);
			$("#email").val(result.email);
			$("#address").val(result.address);
			$("#areaid").val(result.areaid);
			$("#name").val(result.name);
			$("#landmark").val(result.landmark);
			$("#latitude").val(result.latitude);
			$("#longitude").val(result.longitude);
			$("#userid").val(result.id);
			$("#newuserid").val(result.id);
			$('#newaddress').bootstrapValidator('revalidateField', 'email');
			$('#newaddress').bootstrapValidator('revalidateField', 'mobile');
			$.get(base_url+"admin/customer/order/"+result.id,{},function(data){
				var address="";
				if(data != "" && data != null){
					$(data).each(function(index){
						address+="<option value="+data[index].id+" class='col-sm-10'>"+data[index].address+"</option>";
						$("#newaddressid").val(data[index].id);
					});
					$("#orderaddress").html(address);
				}
			},'json');
			ajaxindicatorstop();
        },'json');
    },
    ajax: {
        url: base_url+"admin/user/bymobile",
        timeout: 500,
        displayField: "mobile",
        triggerLength: 3,
        method: "get",
        loadingClass: "loading-circle",
        preDispatch: function (query) {
            return {
            	name: query
            }
        },
        preProcess: function (data) {
            if (data.success === false) {
                return false;
            }
            return data;
        }
    }
    
});	
$("#email").typeahead({
    onSelect: function(item) {
        itemvalue = item.value;
        ajaxindicatorstart("Please wait.. while loading..");
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
			$("#mobile").val(result.mobile);
			$("#address").html(result.address);
			$("#areaid").val(result.areaid);
			$("#name").val(result.name);
			$("#landmark").val(result.landmark);
			$("#latitude").val(result.latitude);
			$("#longitude").val(result.longitude);
			$("#userid").val(result.id);
			$("#newuserid").val(result.id);
			$('#newaddress').bootstrapValidator('revalidateField', 'email');
			$('#newaddress').bootstrapValidator('revalidateField', 'mobile');
			$.get(base_url+"admin/customer/order/"+result.id,{},function(data){
				var address="";
				if(data != "" && data != null){
					$(data).each(function(index){
						address+="<option value="+data[index].id+" class='col-sm-10'>"+data[index].address+"</option>";
						$("#newaddressid").val(data[index].id);
					});
					$("#orderaddress").html(address);
				}
			},'json');
			ajaxindicatorstop();
        },'json');
    },
    ajax: {
        url: base_url+"admin/user/byemail",
        timeout: 500,
        displayField: "email",
        triggerLength: 3,
        method: "get",
        loadingClass: "loading-circle",
        preDispatch: function (query) {
            return {
            	name: query
            }
        },
        preProcess: function (data) {
            if (data.success === false) {
                return false;
            }
            return data;
        }
    }
    
});	

$("#name").typeahead({
    onSelect: function(item) {
        itemvalue = item.value;
        ajaxindicatorstart("Please wait.. while loading..");
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
			$("#mobile").val(result.mobile);
			$("#address").html(result.address);
			$("#areaid").val(result.areaid);
			$("#email").val(result.email);
			$("#landmark").val(result.landmark);
			$("#latitude").val(result.latitude);
			$("#longitude").val(result.longitude);
			$("#userid").val(result.id);
			$("#newuserid").val(result.id);
			$('#newaddress').bootstrapValidator('revalidateField', 'email');
			$('#newaddress').bootstrapValidator('revalidateField', 'mobile');

			$.get(base_url+"admin/customer/order/"+result.id,{},function(data){
				var address="";
				if(data != "" && data != null){
					$(data).each(function(index){
						address+="<option value="+data[index].id+" class='col-sm-6'>"+data[index].address+"</option>";
						$("#newaddressid").val(data[index].id);
					});
					$("#orderaddress").html(address);
				}
			},'json');
			ajaxindicatorstop();
        },'json');
    },
    ajax: {
        url: base_url+"admin/user/byname",
        timeout: 500,
        displayField: "name",
        triggerLength: 3,
        method: "get",
        loadingClass: "loading-circle",
        preDispatch: function (query) {
            return {
            	name: query
            }
        },
        preProcess: function (data) {
            if (data.success === false) {
                return false;
            }
            return data;
        }
    }
    
});	




function openNewAddressModal(){
	
	$("#myModal4").modal('show');
}

function getProjectList(element){
	var ids = "";
	 $("#selectcategory .ms-options li.selected input").each(function(index){
		 if(ids == ""){
			 ids = $(this).val();
		 }else{
			ids = ids +","+ $(this).val();
		 }
	 });
	 if(ids != ""){
		 ajaxindicatorstart("Please wait.. while loading..");
		$.post(base_url+"admin/customer/categories",{id: ids},function(data){
			$('#productids').multiselect('loadOptions',data);
	    	$('#productids').multiselect('reload');
	    	ajaxindicatorstop();
		},'json');
		
	 }
}
function changeQty(id){
	var qty = $("#quantity"+id).val();
	var price = $("#price"+id).text();
	var min = $("#minimum_quantity"+id).val();
	var max= $("#maximum_quantity"+id).val();
	var totalprice = "0";
	var count =1;
	var sum =0;
	if(qty > 0 ){
		if(parseInt(qty) >=parseInt(min) && parseInt(qty)<parseInt(max)){
			totalprice = qty * price;
			$("#hunitpricetotal"+id).val(totalprice);
			$("#error"+id).html("");
			$("#ordersubmit").attr('disabled',false);
		}else{
			totalprice = 0;
			$("#ordersubmit").attr('disabled',true);
			$("#error"+id).html("<span class='text-danger'>Sorry product is not avaiable in "+qty+" quantity.</span>");
		}
	}else if(qty != ""){
		$("#error"+id).html("<span class='text-danger'>quantity required and cannot be empty.</span>");
	}
	$("#totalprice"+id).html(totalprice);
    
	$(".totalprice").each(function(){
		sum += parseInt($("#totalprice"+count).text());
		count++;
	});
	$("#subtotal").html("&#8377; "+sum+"/-");
	$("#total").html("<b>&#8377; "+sum+"/-</b>");
	$("#hsubtotal").val(sum);
	$("#grandtotal").val(sum);
}
function validateQty(){
	 var $th = $(this);
	    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
}
function getProject(element){
	$("#products").empty();
	var ids = "";
	var htmlproduct="";
	var image = "";
	var img = "";
	
	var imgurl = '<?php echo asset_url();?>';
	 $("#selectproduct .ms-options li.selected input").each(function(index){
		 if(ids == ""){
			 ids = $(this).val();
		 }else{
			ids = ids +","+ $(this).val();
		 }
	 });
	 if(ids != ""){
		 ajaxindicatorstart("Please wait.. while loading..");
		 $.post(base_url+"admin/customer/products",{id: ids},function(data){
			 var count =1;
			 htmlproduct = '<div class="col-md-4 col-sm-5 col-md-4-custom">'
			   			+'<h4>Product name</h4>'
			  			+'</div>'
			  			+'<div class="col-md-2 col-sm-2 col-md-2-custom">'
			     		+'<div class="inline">'
			         	+'<h4 class="qty">QTY</h4>'
			        	+'</div>'   
			  			+'</div>'
			  			+'<div class="col-md-2 col-sm-1 col-md-2-custom">'
			  			+'<h4>Unit Price</h4>'
			  			+'</div>'
			  			+'<div class="col-md-2 col-sm-1 col-md-2-custom">'
			  			+'<h4>Total</h4>'
			 			+'</div>';
			$(data).each(function(index){
				img = data[index].image;
				if(img!=""){
					img = imgurl.img;
					htmlproduct+='<img src="'+image+'" alt="phynart_logo" class="cart-img img-responsive" />';
					}
				
					htmlproduct +='<div class="col-md-4 col-sm-5 col-md-4-custom">'
			          			+'<h3>'+data[index].name+'</h3>'
			             		+'<p>'+data[index].description+'</p>'
			             		+'<input type="hidden" id="minimum_quantity'+count+'" value="'+data[index].minimum_quantity+'" />'
			             		+'<input type="hidden" id="maximum_quantity'+count+'" value="'+data[index].quantity+'" />'
			          			+'</div>'
			          			+'<div class="col-md-2 col-sm-2 col-md-2-custom">'
			             		+'<div class="inline">'
			                  	+'<input type="text" class="form-control" id="quantity'+count+'" name="quantity[]" onkeyup="onlyNumber('+count+');" onchange="changeQty('+count+');"  />'
			                  	+'<p id="error'+count+'"></p>'
			                	+'</div>'   
			          			+'</div>'
			          			+'<div class="col-md-2 col-sm-1 col-md-2-custom">'
			             		+'<h5 id="price'+count+'">'+data[index].price+'</h5>'
			          			+'</div>'
			          			+'<div class="col-md-2 col-sm-1 col-md-2-custom">'
			             		+'<h5 class="totalprice" id="totalprice'+count+'">0</h5>'
					 			+'</div>'
					 			+'<input type="hidden" id="unitprice'+count+'" name="unitprice[]" value="'+data[index].price+'" />' 
					 			+'<input type="hidden" id="hunitpricetotal'+count+'" name="hunitpricetotal[]" />';
		 			count++;
			      });

			 htmlproduct +='</div>';
			 htmlproduct +='<div class="col-md-6 col-sm-4"></div> <div class="col-md-4 col-sm-4">'
                 		+'<div class="total row">'
                    	+'<div class="col-sm-6 col-xs-6">'
                       	+'<p>Subtotal</p>'
                    	+'</div>'
                    	+'<div class="col-sm-6 col-xs-6">'
                        +'<p id="subtotal">&#8377; 0/-</p>'
                    	+'</div>'
		                +'</div>'
		                +'<div class="total row">'
                    	+'<div class="col-sm-6 col-xs-6">'
                        +'<p>Shipping (Free)</p>'
                   		+'</div>'
                    	+'<div class="col-sm-6 col-xs-6">'
                        +'<p>&#8377; 0/-</p>'
                    	+'</div>'
                 		+'</div>'
                 		+'<div class="total row">'
                    	+'<div class="col-sm-6 col-xs-6">'
                        +'<p>GST</p>'
                    	+'</div>'
                    	+'<div class="col-sm-6 col-xs-6">'
                        +'<p>&#8377; 0/-</p>'
                    	+'</div>'
                 		+'</div>'
                 		+'<div class="total row">'
                    	+'<div class="col-sm-6 col-xs-6">'
                        +'<p><b>Grand Total</b></p>'
                    	+'</div>'
                    	+'<div class="col-sm-6 col-xs-6">'
                        +'<p id="total"> <b>&#8377; 0/-</b></p>'
                    	+'</div>'
                		+'</div>'
               			+'<span class="green">*All the prices are inclusive of Taxes</span>'
            			+'</div>';
			$("#products").html(htmlproduct);
			ajaxindicatorstop();
			},'json');

	 }
}

$(document).ready(function(){
	$('#neworder').bootstrapValidator({
		container: function($field, validator) {
			return $field.parent().next('.messageContainer');
	   	},
	    feedbackIcons: {
	        validating: 'glyphicon glyphicon-refresh'
	    },
	    excluded: ':disabled',
	    fields: {
	    	
	        filer_category_ids: {
	            validators: {
	                notEmpty: {
	                    message: 'category is required and cannot be empty'
	                }
	            }
	        },
	        product_ids: {
	            validators: {
	            	notEmpty: {
	                    message: 'Product is required and cannot be empty'
	            	}
	        	}
	    	},
	    }	
	        
	}).on('success.form.bv', function(event,data) {
		// Prevent form submission
		event.preventDefault();
		saveNewOrder();
	});
	
});

function saveNewOrder(){
	if($("#grandtotal").val() > 0){
		 ajaxindicatorstart("Please wait.. while loading..");
		var options = {
		 		target : '#pricingresponse', 
		 		beforeSubmit : showPriceRequest,
		 		success :  showPriceResponse,
		 		url : base_url+"admin/customer/order/add",
		 		semantic : true,
		 		dataType : 'json'
		 	};
	   	$('#neworder').ajaxSubmit(options);
	}else{
		alert("You are trying to place wrong order");
		$("#ordersubmit").attr('disabled',false);
	}
}

function showPriceRequest(formData, jqForm, options){
	$("#pricingresponse").hide();
   	var queryString = $.param(formData);
	return true;
}

function showPriceResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		if(resp.id == '0'){
			alert(resp.msg);
			$("#ordersubmit").attr('disabled',false);
		}else{
			alert(resp.msg);
		}
		ajaxindicatorstop();
  	} else {
  		alert(resp.msg);
  		window.location.href = base_url+"admin/customer/order";
  	}
}
function onlyNumber(id){
	 var $th = $("#quantity"+id);
	    $th.val( $th.val().replace(/[^0-9]/g, function(str) { return ''; } ) );
}
</script>