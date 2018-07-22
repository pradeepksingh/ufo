<style>
<!--
.btn-plus{
	margin:5px 0px;
}

-->

</style>

<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<!--<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span>--> Users List
              	</div>
              	<!--<div>
              		<div class="panel panel-default">
	                   	<div class="panel-body">
                            <div class="row">
	                            <div class="col-sm-4">
	                            	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date"/>
	                            </div>
	                            <div class="col-sm-4">
	                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date"/>
	                            </div>
	                            <div class="col-sm-4">
	                            	<input type="text" id="email" name="email" class="form-control" placeholder="Email Id"/>
	                            </div>
                          	</div>
                          	<div class="row" style="padding-top:5px;">
                          		<div class="col-sm-4">
	                            	<input type="text" id="mobile" name="mobile" class="form-control" placeholder=" Mobile"/>
	                            </div>
	                            <div class="col-sm-4">
	                            	<select id="usertype" name="usertype" class="form-control">
	                            	<option value=''> Select User type</option>
	                            	<option value="1"> Registered User </option>
	                            	<option value="0"> Guest user </option>
	                            	</select>
	                            </div>
                          		<div class="col-sm-4">
                          			<input type="button" name="search" id="search" class="btn btn-primary" value="Search"/>
                          		</div>
                          	</div>
	                   	</div>
	               	</div>
              	</div>-->
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
             	<th>Id</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Locality</th>
                <th>Zone</th>
              	<th>Date</th>
            </tr>
        </thead>
        <tbody id="ubody">
        <?php 
        if(isset($users))foreach ($users as $user){ ?>
            <tr>
          		<td><?php echo $user['id'];?></td>
                <td><?php echo $user['name'];?></td>
                <td><?php echo $user['mobile'];?></td>
                <td><?php echo $user['email'];?></td>
                <td><?php echo $user['address'];?></td>
                <td><?php echo $user['locality'];?></td>
                <td><?php echo $user['zonename'];?></td>
				<td><?php if (!empty($user['created_on'])) { echo date('Y-m-d',strtotime($user['created_on']));}?></td>                
            </tr>
            <?php } ?>
          
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
$("#search").click(function() {
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
	$.post(base_url+"admin/report/searchuser",{from_date: $("#from_date").val(), to_date: $("#to_date").val(), email: $("#email").val(), mobile: $("#mobile").val(),user: $("#usertype").val()},function(data){
		var oTable = $("#example1").dataTable();
		  
	    oTable.fnClearTable();
	    $(data).each(function(index){
		   
		    
		    var	vieworder = '<a href="'+base_url+'admin/order/view_details/'+data[index].id+'" >'+data[index].id+'</a>';
		    var row = [];
	    	    row.push(data[index].id);
		    	row.push(data[index].name);
			    row.push(data[index].mobile);
		    	row.push(data[index].email);
		    	if(data[index].address != null)
		    		row.push(data[index].address);
		    	else 
		    		row.push("NA");
		    	if(data[index].locality != null)
		    		row.push(data[index].locality);
		    	else 
		    		row.push("NA");
		    	if(data[index].zonename != null)
		    		row.push(data[index].zonename);
		    	else 
		    		row.push("NA");
		    	row.push(data[index].created_on);
		    	oTable.fnAddData(row);
	    });
	   
	},'json');
	 var loader = $('#dynElement').data('introLoader');
     loader.stop();
     $("#ubody").fadeIn();
	 
	
});

</script>