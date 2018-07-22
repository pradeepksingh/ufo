<style>
.row
{
margin-bottom:5px
}
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Search Orders
              	</div>
              	<div>
              	<div class="row" style="margin-top:20px">
	            	<div class="col-lg-12 margin-bottom-5" >
	                	<div class="form-group" id="error-cityid">
                        	<div class="col-sm-5">
                        	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date"/>
                        	</div>
                            <div class="col-sm-5">
                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date"/>
							</div>
							
                    	</div>
	             	</div>
	         	</div>
	         	 <div class="row">
	            	<div class="col-lg-12 margin-bottom-5">
	                	<div class="form-group" id="error-areaid">
                        	<div class="col-sm-5">
                            	<select name="zone" id="zone" class="form-control">
									<option value="">Select Zone</option>
									<?php foreach ($zone as $item) {?>
									<option value="<?php echo $item['id']; ?>" ><?php echo $item['name']; ?></option>
									<?php }?>
								</select>
							</div>
                            <div class="col-sm-5">
                           		<select name="restid" id="restid" class="form-control">
									
								</select>
							</div>
							<div class="col-sm-2"><input type="button" name="search" id="search1" class="btn btn-primary" value="Search" onclick="search()"></div>
							
                     	</div>
	             	</div>
	          	</div>
	          	<div class="row">
	            	<div class="col-lg-12 margin-bottom-5">
	                	<div class="form-group" id="error-areaid">
                        	<div class="col-sm-5" >                            	
							</div>                           
							<div class="col-sm-5" style="text-align:right">
                          			
                          		</div>
                     	</div>
	             	</div>
	          	</div>
              	</div>
              	
               	<div class="panel-body">
                	<div class="dataTable_wrapper" style="overflow:auto;">
                	<center>
              	<div id="ajaxTest" style="position:absolute;width:100px; height:50px;background-color:transparent">
            		<div id="dynElement">
            		
            		</div>
 				</div>
 				</center>
              <table id="example1" class="display" cellspacing="0" width="100%">
        <thead class="bg-info">
            <tr>
             	<th>Order ID</th>
				<th>Order Code</th>
				<th>User Name</th>
				<th>User Mobile</th>
				<th>Address</th>
				<th>Zone</th>
				<th>Area</th>
				<th>Restaurant</th>
				<th>Placing Mode</th>
				<th>Type/Discount</th>
				<th>Total Amount</th>
				<th>Date</th>
				<th>Status</th>
				<th>CSE</th>
				
            </tr>
        </thead>
        
        <tbody id="ubody">
       <?php if (isset($orders)) { ?>
							<?php foreach ($orders as $item):?>
            	<tr>
            		<td>
						<?php echo $item['orderid'];?>
					</td>
					<td>
						<?php echo $item['ordercode'];?>
					</td>
					<td>
						<?php echo $item['name'];?>
					</td>
					<td>
						<?php echo $item['mobile'];?>
					</td>
					<td>
						<?php echo $item['address'];?>
					</td>
					<td>
						<?php echo $item['zonename'];?>
					</td>
					<td>
						<?php echo $item['cust_area'];?>
					</td>
					<td>
						<?php echo $item['restname'];?>
					</td>
					<td>
						<?php if($item['order_placing_mode'] == 0) { ?>Phone<?php } else { ?>App<?php } ?>
					</td>
					<td>
						<?php if($item['is_takeaway'] == 1) { ?>Takeaway<?php } else { ?>Delivery<?php } ?>
					</td>
					<td>
						<?php echo $item['total_amount'];?>
					</td>
					<td>
						<?php echo $item['delivery_date'];?>
					</td>
					<td>
						<?php if($item['status'] == 1) { ?>Confirmed<?php } else if($item['status'] == 2) { ?>Cancelled<?php } else { ?>Pending<?php } ?>
					</td>
					<td>
						<?php if($item['cse_name'] == "") { ?>
						NA
						<?php } else { ?>
						<?php echo $item['cse_name'];?>
						<?php } ?>
					</td>
				</tr>
								<?php endforeach;?>
							<?php }?>
						
          
            </tbody>
            
            </table>
					</div>
				</div>
		</div>
	</div>
</div>

<script src="<?php echo asset_url();?>js/spin.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.introLoader.js"></script>
<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>

<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";


$(document).ready(function() {
	$('#from_date').datepicker();
    $('#to_date').datepicker();
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'CSV'
            }
            
        ]
    } );
} );
function search(){
	$("#ubody").fadeOut();
    $("#dynElement").introLoader({
        animation: {
            name: 'simpleLoader',
            options: {
                stop: false,
                fixed: false
            }
        }
    });
	
	$.post(base_url+"admin/report/searchrestaurantsvsorder",{from_date: $("#from_date").val(), to_date: $("#to_date").val(),restid: $("#restid").val()},function(data){
		var oTable = $("#example1").dataTable();
		var mode='';
		var isTakeaway='';
	    var status='';
		var csename='';
	    oTable.fnClearTable();
	    $(data).each(function(index){
		   
		    if(data[index].order_placing_mode==0)
		    {
			    mode = "Phone";
		    }
		    else
		    {
			    mode = "App";
		    }
		    if(data[index].is_takeaway==1)
		    {
		    	isTakeaway = "Takeaway";
		    }
		    else
		    {
			    isTakeaway = "Delivery";
		    }
		    if(data[index].status==1)
		    {
		    	status = "Confirmed";
		    }
		    else
		    {
		    	status = "Cancelled";
		    }
		    if(data[index].cse_name === "")
		    {
		    	csename = "NA";
		    }
		    else
		    {
		    	csename = data[index].cse_name;
		    }
		    var	vieworder = '<a href="'+base_url+'admin/order/view_details/'+data[index].id+'" >'+data[index].id+'</a>';
		    var row = [];
	    	    row.push(data[index].orderid);
		    	row.push(data[index].ordercode);
			    row.push(data[index].name);
		    	row.push(data[index].mobile);
		    	row.push(data[index].address);
		    	row.push(data[index].zonename);
		    	row.push(data[index].cust_area);
		    	row.push(data[index].restname);
		    	row.push(mode);
		    	row.push(isTakeaway);
		    	row.push(data[index].total_amount);
		    	row.push(data[index].delivery_date);
		    	row.push(status);
			    row.push(data[index].cse_name);
		    	oTable.fnAddData(row);
	    });
	},'json');
	 var loader = $('#dynElement').data('introLoader');
     loader.stop();
     $("#ubody").fadeIn();
}
$("#zone").change(function(){
	$.get(base_url+"admin/restaurantoffers/getrestaurantbyzoneid",{zoneid: $("#zone").val()},function(data){
		var html = "<option value=''>Select Restaurant</option>";
		$.each( data, function( key, value ) {
		    html = html + "<option value='"+value.id+"'>"+value.name+"</option>";
		});	
		$("#restid").html(html);
	},'json');
});





</script>