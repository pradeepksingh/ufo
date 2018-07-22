<link href="<?php echo asset_url();?>css/selectize.bootstrap3.css" rel="stylesheet">
<link href="<?php echo asset_url();?>css/datepicker3.css" rel="stylesheet">
<div id="page-wrapper">
	<div class="row bg-title">
		<div class="col-lg-12 text-center">
			<h3>Add New Order</h3>
		</div>
	</div>
	<form id="addorder" name="addorder" action="<?php echo base_url();?>admin/order/add" method="post" enctype="multipart/form-data">
		<!--<ul class="nav nav-tabs">
		  	<li class="active"><a data-toggle="tab" href="#basic">Add New Order</a></li>
		</ul>-->
		<div class="tab-content">
		  	<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<input type="hidden" name="userid" id="userid" value=""/>
								
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
											<div class="col-sm-12">
												<textarea class="form-control" name="address" id="address" ></textarea>
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-landmark">
											<label class="control-label ">Landmark/Building Name <span class='text-danger'>*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control" value="" name="landmark" id="landmark" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
									<div class="col-lg-6 margin-bottom-5">
										<div class="form-group" id="error-landmark">
											<label class="control-label">Locality <span class='text-danger'>*</span></label>
											<div class="col-sm-12">
												<input type="text" class="form-control" value="" name="locality" id="locality" />
											</div>
											<div class="messageContainer col-sm-10"></div>
										</div>
									</div>
								</div>
								<input type="hidden" name="latitude" id="latitude" value=""/>
								<input type="hidden" name="longitude" id="longitude" value=""/>
																
								<hr />
								<h4>Add Products </h4>
								 <div class="row">
			                    <div class="col-sm-12">
			                        <div class="white-box">
											<table data-toggle="table"  id="tb" data-mobile-responsive="true" class="table table-hover" style="margin-top: -41px;">
												<thead>
													<tr>
														<th>Product Name</th>
														<th>Qty</th>
														<th>Unit Price</th>
														<th>Row Total</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody id="product_row">	
													<tr>
														<td>
															<select class="form-control" class="selectize" id="product_name[]"  name ="product_name[]" onchange="productChanged(this);">
																<option  value=""> Enter product name</option>
																<?php  foreach($products as $product){?>
																	<option data-price="<?php echo $product['price']?>" value="<?php echo $product['product_id']?>"><?php echo $product['name']?></option>
																<?php }?>
															</select>
														</td>
														<td>
															<input type="number" class="form-control product-qty" onchange="qtyChanged(this);" value="" min="1"  max="<?php echo $product['quantity']?>"  name="qty[]" id="qty" />
														</td>
														<td>
															<input type="text" class="form-control unit-price"  class="form-control"  value=""  name="unit-price[]" id="unit-price" />
														</td>
														<td><input type="text" class="form-control rowTotalPrice" value="" readonly name="rowTotalPrice[]" id="rowTotalPrice" /></td>
														<td><i class="btn fa fa-plus" onclick="addProductRow();" >Add</i></td>
													</tr>
												</tbody>
												<tfoot>
													<tr>
														<th>Sub Total</th>
														<td>
															<input type='number' name='subTotal' id='subTotal' class='subTotal form-control' readonly>
														</td>
													</tr>
													<tr>
														<th>Discount</th>
														<td>
															<select class="form-control" id="discount-type" onchange="updateTotals();">
																<option value="">Select Type</option>
																<option value="1">Percentage</option>
																<option value="2">Flat</option>
															</select>
														</td>
														<td>
															<input type='text' name='discount' id='discount' class='discount form-control' onchange="updateTotals();" max="100" min="0" placeholder="eg:50">
														</td>
													</tr>
													<tr>
														<th>Total Discount</th>
														<td>
															<input type='text' name='discount-price' id='discount-price' class='discount-price form-control' readonly>
														</td>
													</tr>
													<tr>
														<th>Grand Total</th>
														<td>
															<input type='text' name='Grand_Total' id='Grand_Total' class='Grand_Total form-control' readonly>
														</td>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
								<div class="row">
									<h2>Total Price</h2> <h2 class="total-price" id="total-price"></h2>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5 text-center">
									<div id="response"></div>
										<button type="submit" class="btn btn-success">Submit</button>
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
<script>

$('#addorder').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('div.messageContainer');
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
        address: {
            validators: {
                notEmpty: {
                    message: 'Address is required and cannot be empty'
                }
            }
        },
		
        }
})

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
			$('#addorder').bootstrapValidator('revalidateField', 'item[email]');
			$('#addorder').bootstrapValidator('revalidateField', 'item[mobile]');
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
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
			$("#mobile").val(result.mobile);
			$("#address").html(result.address);
			$("#areaid").val(result.areaid);
			$("#name").val(result.name);
			$("#landmark").val(result.landmark);
			$("#latitude").val(result.latitude);
			$("#longitude").val(result.longitude);
			$("#userid").val(result.id);
			$('#addorder').bootstrapValidator('revalidateField', 'item[email]');
			$('#addorder').bootstrapValidator('revalidateField', 'item[mobile]');
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
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
			$("#mobile").val(result.mobile);
			$("#address").html(result.address);
			$("#areaid").val(result.areaid);
			$("#email").val(result.email);
			$("#landmark").val(result.landmark);
			$("#latitude").val(result.latitude);
			$("#longitude").val(result.longitude);
			$("#userid").val(result.id);
			$('#addorder').bootstrapValidator('revalidateField', 'item[email]');
			$('#addorder').bootstrapValidator('revalidateField', 'item[mobile]');
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

$(document).ready(function(){
    $("#ser_id").change(function() {
      var ser_id =  $('#ser_id').val();
       //console.log(ser_id);
	      $.post(base_url+"crm/order/category/", {ser_id : ser_id}, function(data){
	    	 $('#cat_id').empty();
	    	 $('#cat_id').append("<option value=''>"+'Select Category'+"</option>");
		     if(data.length > 0){
		      for( var i=0; i < data.length; i++){
		   	
		          $('#cat_id').append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");

			 }
	      }
	    },'json');
    });
});
 
function addProductRow(){
	var html ="";
	html += '<tr><td><select class="form-control" class="selectize" id="product_name" name="product_name[]" onchange="productChanged(this);" ><option value=""> Enter product name</option>';
	html += '<?php  foreach($products as $product){?><option data-price="<?php echo $product["price"]?>" value="<?php echo $product["product_id"]?>"><?php echo $product["name"]?></option><?php }?></select>';
	html +='</td><td>';	
	html +='<input type="number" class="form-control product-qty" onchange="qtyChanged(this);" value="" min="1"  max=""  name="qty[]" id="qty" />';
	html +='</td> <td>';
	html +='<input type="text" class="form-control unit-price" value=""  name="unit-price[]" id="unit-price" />';
	html +='</td> <td>';
	html +='<input type="text" class="form-control rowTotalPrice" value=""  name="rowTotalPrice[]" id="rowTotalPrice" />';
	html +='</td> <td>';
	html +='<i class="btn fa fa-plus" id="removeProductRow" onclick="removeProductRow(this)">Remove</i>';
	html +='</td> </tr>';

	 $("#product_row").append(html);
}
function removeProductRow(a){
	$(a).parent().parent().remove();
}

$('.productName').change(function() {
	//alert('changed');
	 // $(this).closest('tr').find('.unit-price').val($('option:selected', this).data('price'));
	});
function productChanged(a){
	$(a).closest('tr').find('.unit-price').val($('option:selected', a).data('price'));
// 	var unit-price = $(a).closest('tr').find('.unit-price').val();
	var inqty = $(a).closest('tr').find('.product-qty').val(1);
 	var qty = $(a).closest('tr').find('.product-qty').val();
 	var unit_price = $('option:selected', a).data('price');
 	var row_total = qty * unit_price;
	var qty = $(a).closest('tr').find('.rowTotalPrice').val(row_total);
	updateTotals();
}
function qtyChanged(a){
	var qty = $(a).val();
	var unit_price = $(a).closest('tr').find('.unit-price').val();;
	var row_total = qty*unit_price;
	$(a).closest('tr').find('.rowTotalPrice').val(row_total);
	updateTotals();
}

function updateTotals(){
	var total ="0";
	var discount = $('#discount').val();
	var dis_type = $('#discount-type').val();
	var sTotal = 0;
	var gTotal = 0;
  	$('.rowTotalPrice').each(function() {
	  sTotal += Number($(this).val());
  	});
  	$('#subTotal').val(sTotal);
  	if(dis_type == 1){
		var tdiscount = ((discount *sTotal)/100);
		var gTotal = sTotal-tdiscount;
  	  	}else if(dis_type == 2){
  	  		var gTotal = sTotal-discount;
  	  		var tdiscount = sTotal-gTotal;
  	  	  	}else{
  	  	  	  	var tdiscount = discount;
  	  	  	    var gTotal = sTotal;
  	  	  	  	}
	  	$('#discount-price').val(tdiscount);
	  	$('#Grand_Total').val(gTotal);
  }


</script>
