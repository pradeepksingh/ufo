<style>
<!--
.btn-plus{
	margin:5px 0px;
}
.row
{
margin-bottom:5px;
}

-->
</style>
<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Restaurant Delivery Orders
              	</div>
              	<div class="col-lg-12 alert alert-info">
               		<div class="col-sm-3"><b>COD Orders:</b> <?php echo $codorders;?></div>
               		<div class="col-sm-3"><b>OP Orders:</b> <?php echo $oporders;?></div>
               		<div class="col-sm-3"><b>COD Amount:</b> <?php echo $codamount;?></div>
               		<div class="col-sm-3"><b>OP Amount:</b> <?php echo $opamount;?></div>
               	</div>
              	<div>
              	<form action="<?php echo base_url()?>admin/report/viewrestdelorders" method="post">
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
                            	<select name="is_online_paid" id="is_online_paid" class="form-control">
									<option value="">Select Payent Mode</option>
									<option value="1">Online</option>
									<option value="0">COD</option>
								</select>
							</div>
                            <div class="col-sm-5">
                           		<input type="submit" name="search" id="search" class="btn btn-primary" value="Search" />
							</div>
                     	</div>
	             	</div>
	          	</div>
	          	</form>
              	</div>
               	<div class="panel-body">
               		<center>
              			<div id="ajaxTest" style="position:absolute;width:100px; height:50px;background-color:transparent">
            				<div id="dynElement">
            				</div>
 						</div>
 					</center>
               	<div class="dataTable_wrapper" style="overflow:auto;">
			      	<table id="example1" class="display" cellspacing="0" width="100%">
			        <thead class="bg-info">
			            <tr>
			             	
							<th>Order ID</th>
							<th>User Name</th>
							<th>User Mobile</th>
							<th>Zone</th>
							<th>Area</th>
							<th>Restaurant</th>
							<th>Payment Mode</th>
							<th>Order Amount</th>
							<th>Date</th>
							<th>Status</th>
			            </tr>
			        </thead>
			        <tbody id="ubody">
			       <?php if (isset($orders)) { ?>
										<?php foreach ($orders as $item):?>
			            	<tr>
												
												<td>
													<?php echo $item['id'];?>
												</td>
												<td>
													<?php echo $item['name'];?>
												</td>
												<td>
													<?php echo $item['mobile'];?>
												</td>
												<td>
												<?php echo $item['zonename'];?>
												</td>
												<td>
													<?php echo $item['locality'];?>
												</td>
												<td>
													<?php echo $item['restname'];?> (<?php echo $item['restarea'];?>)
												</td>
												<td>
													<?php if($item['is_online_paid'] == 0) { ?>COD<?php } else { ?>Online<?php } ?>
												</td>
												<td>
													<?php echo $item['order_amount'];?>
												</td>
												<td>
													<?php echo $item['created_date'];?>
												</td>
												<td>
													<?php if($item['status'] == 1) { ?>Confirmed<?php } else if($item['status'] == 2) { ?>Cancelled<?php } else { ?>Pending<?php } ?>
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

<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/spin.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.introLoader.js"></script>






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
function search()
{
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
	$.post(base_url+"admin/report/restdelorders",{from_date: $("#from_date").val(), to_date: $("#to_date").val(), is_online_paid: $("#is_online_paid").val()},function(data){
		var oTable = $("#example1").dataTable();
		  var mode='';
		  var status='';
	    oTable.fnClearTable();
	    $(data).each(function(index){
		   if(data[index].is_online_paid == 1) {
			   	mode = 'Online';
		   } else {
				mode = 'COD';
		   }
		   if(data[index].status == 1) {
			   status = 'Confirmed';
		   } else if(data[index].status == 2) {
			   status = 'Cancelled';
		   } else {
			   status = 'Pending';
		   }
		    var row = [];
	    	    row.push(data[index].id);
			    row.push(data[index].name);
		    	row.push(data[index].mobile);
		    	row.push(data[index].zonename);
		    	row.push(data[index].locality);
		    	row.push(data[index].restname+' ('+data[index].restarea+')');
		    	row.push(mode);
		    	row.push(data[index].created_date);
		    	row.push(status);
		    	oTable.fnAddData(row);
	    });
	   
	},'json');
	 var loader = $('#dynElement').data('introLoader');
     loader.stop();
     $("#ubody").fadeIn();
}
$("#cityid").change(function(){
	$.get(base_url+"admin/general/localities",{cityid: $("#cityid").val()},function(data){
		var html = "<option value=''>Select Area</option>";
		$.each( data, function( key, value ) {
		    html = html + "<option value='"+value.id+"'>"+value.name+"</option>";
		});	
		$("#areaid").html(html);
	},'json');
});

</script>