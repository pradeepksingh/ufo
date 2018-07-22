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

<script type="text/javascript">
$(function () {
   	$("input[name='spacific']").click(function () {
      	if ($("#yes2").is(":checked")) {
         	$("#ff1").show();
          	$("#ff2").show();
           	$("#ff3").show();
      	} else {
         	$("#ff1").hide();
           	$("#ff2").hide();
            $("#ff3").hide();
      	}
   	});
});
    $(function () {
        $("#day").hide();
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
/*$(document).ready(function () {
  	$('#srest').hide();
   	var d = new Date();
   	var currMonth = d.getMonth();
    var currYear = d.getFullYear();
    var startDate = new Date(currYear,currMonth,d.getDate());
    $('#trial_end_date').datepicker('setDate',startDate);
    $('#trial_start_date').datepicker('setDate',startDate1);
}); */
    
</script>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3>Add Coupon</h3>

        </div>
    </div>
    <form id="addcoupon" name="addcoupon" action="" method="post" >
         <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" >
                                Add Coupon
                            </div>
                            <div class="panel-body">
							
                                <div class="row">
                                    <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Title <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="coupon[title]" id="title" />
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
								     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Coupon Code <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                             <input type="text" class="form-control" name="coupon[coupon_code]" id="coupon_code" />
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									
                                </div>
                                
                                <div class="row">
                                      <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Coupon Description <span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                              <textarea class="form-control" name="coupon[description]" id="description" ></textarea>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
                                     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Is First Order Coupon? <span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                                <select name="coupon[is_new_user]" id="is_new_user" class="form-control">
													<option value="0" selected>No</option>
													<option value="1">Yes</option>
												</select>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									
                                </div>
                                
                                <div class="row">
                                   
								     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Coupon Type <span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                              <select name="coupon[coupon_type]" id="coupon_type" onchange="couponType(this.value);" class="form-control">
													<option value="0" selected>Discount only</option>
													<option value="1">Cashback + Discount</option>
												</select>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									<div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Discount Service Category<span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                               <select name="coupon[cat_id]" id="cat_id" class="form-control">
													<option value="0" selected>All</option>
													<option value="1">Device</option>
													<option value="2">Kit</option>
													<option value="3">Subscription</option>
												</select>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    
								     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Discount Type <span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                               <select name="coupon[discount_type]" id="discount_type"  class="form-control">
													<option value="0" selected>Percentage</option>
													<option value="1">Flat</option>
												</select>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									<div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Discount<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                               	<input type="text" class="form-control" name="coupon[discount]" id="discount" />
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    
								     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Max Discount<span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                               <input type="text" class="form-control" name="coupon[max_discount]" id="max_discount" value="0"/>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									<div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Cashback Type <span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                                <select name="coupon[cashback_type]" id="cashback_type" class="form-control">
													<option value="0" selected>Percentage</option>
													<option value="1">Flat</option>
												</select>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    
								     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Cashback<span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                               <input type="text" class="form-control" name="coupon[cashback]" id="cashback" />
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									 <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Max Cashback<span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                             <input type="text" class="form-control" name="coupon[max_cashback]" id="max_cashback" value="0"/>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                   
								     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Minimum Order Value <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="coupon[min_order_value]" id="min_order_value" value="0"/>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									<div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> How many uses per user? <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                               <input type="text" class="form-control" name="coupon[count_per_user]" id="count_per_user" value="1"/>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    
								     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> Start Date <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                               <input type="text" class="form-control date_picker" name="coupon[start_date]" id="start_date" />
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									<div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5"> End Date <span class='text-danger'>*</span></label>
                                            <div class="col-sm-10">
                                              <input type="text" class="form-control date_picker" name="coupon[end_date]" id="end_date" />
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
                                </div>
                                
								  <div class="row">
                                    
								     <div class="col-lg-6 margin-bottom-5">
                                        <div class="form-group" id="error-mstart_time">
                                            <label class="control-label col-sm-5">Applicable On(APP/WEB)  <span class='text-danger'></span></label>
                                            <div class="col-sm-10">
                                              <select name="coupon[applicable_on]" id="applicable_on" class="form-control">
													<option value="0" selected>Both</option>
													<option value="1">Website</option>
													<option value="2">APP</option>
												</select>
                                            </div>
                                            <div class="messageContainer col-sm-10" id="srest"><!--<div class='panel panel-default' style='' ><div class='panel-heading' style=''>Restaurant List</div><div class='panel-body' style='' style='padding:0px' ><div class='dataTable_wrapper' ><table class='table table-striped table-bordered table-hover' id='dataTables-example' ><thead class='bg-info'><tr><th>Restaurant</th><th>Area</th><th>Action</th></tr></thead><tbody id="ddd"></tbody></table></div></div></div>--></div>
                                        </div>
                                    </div>
									
                                </div>
                       
								
                            
                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      


            <!--<div id="response"></div>
            <button type="submit" class="btn btn-success">Submit</button>-->
			<div class="row">
				<div class="col-lg-12 margin-bottom-5 text-center">
				<div id="response"></div>
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</div>
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
$('.date_picker').datepicker({
    format: 'dd-mm-yyyy',
    startDate: '0d'
});
$('#addcoupon').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('div.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	'coupon[title]': {
            validators: {
                notEmpty: {
                    message: 'Title is required and cannot be empty'
                }
            }
        },
        'coupon[coupon_code]': {
            validators: {
                notEmpty: {
                    message: 'Coupon Code is required and cannot be empty'
                }
            }
        },
        'coupon[discount]': {
            validators: {
                notEmpty: {
                    message: 'Discount is required and cannot be empty'
                },
                numeric: {
                    message: 'The value is not a number',
                    thousandsSeparator: '',
                    decimalSeparator: '.'
                }
            }
        },
        'coupon[count_per_user]': {
            validators: {
                notEmpty: {
                    message: 'Value is required and cannot be empty'
                },
                numeric: {
                    message: 'The value is not a number',
                    thousandsSeparator: '',
                    decimalSeparator: '.'
                }
            }
        },
        'coupon[min_order_value]': {
            validators: {
                notEmpty: {
                    message: 'Minimum Order Value is required and cannot be empty'
                },
                numeric: {
                    message: 'The value is not a number',
                    thousandsSeparator: '',
                    decimalSeparator: '.'
                }
            }
        },
        'coupon[max_discount]': {
            validators: {
                notEmpty: {
                    message: 'Maximum Discount is required and cannot be empty'
                },
                numeric: {
                    message: 'The value is not a number',
                    thousandsSeparator: '',
                    decimalSeparator: '.'
                }
            }
        },
     /*   'coupon[start_date]': {
            validators: {
                notEmpty: {
                    message: 'Start Date is required and cannot be empty'
                },
                date: {
                    format: 'DD-MM-YYYY',
                    message: 'The Business Registration Date is not a valid'
                }
            }
        },
        'coupon[end_date]': {
            validators: {
                notEmpty: {
                    message: 'End Date is required and cannot be empty'
                },
                date: {
                    format: 'DD-MM-YYYY',
                    message: 'The Business Registration Date is not a valid'
                }
            }
        },*/
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addCoupon();
});

function addCoupon() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/coupon/addcoupon',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addcoupon').ajaxSubmit(options);
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
  	} else {
  		$("#response").removeClass('alert-danger');
        $("#response").addClass('alert-success');
        $("#response").html(resp.msg);
        $("#response").show();
        alert(resp.msg);
        window.location.href = base_url+"admin/coupon/list";
  	}
}
couponType(0);
function couponType(coupon_type){
	//var c_type= $(discount_type).va;
	//alert(coupon_type);
	if(coupon_type == 0){
		$("#cashback").attr("disabled", true);
		$("#cashback_type").attr("disabled", true);
		$("#max_cashback").attr("disabled", true);
		}else{
			$("#cashback").attr("disabled", false);
			$("#cashback_type").attr("disabled", false);
			$("#max_cashback").attr("disabled", false);
			}
	//alert("hello");
	
}
</script>