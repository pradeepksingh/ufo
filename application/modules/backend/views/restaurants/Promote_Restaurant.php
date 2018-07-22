
<style>
<!--
.btn-plus{
	margin:5px 0px;
}
-->
</style>
<div id="page-wrapper">
<div class="row">
<div>

</div>
<div class="col-lg-12">
<h3> Promoted Restaurant</h3>
				<form action ="searchpromotedrestaurant" method="get">
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select City <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="cityid" name="cityid" required>
											<option value=""> select city</option>
													<?php foreach ($cities as $item){?>

											<option value="<?php echo $item['id']?>"> <?php echo $item['name']?></option>
													<?php }?>
										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
							   </div>
							</div>
						</div>
					<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select Zone <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<select class="form-control" id="zone_id" name="zone_id" required>
										
										</select>
									</div>
									<div class="messageContainer col-sm-4"></div>
							   </div>
							</div>
						</div>
						<div class="row" style="margin-top:5px">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-5"> <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<input type="submit" name="ok" value="Search" class = "btn btn-primary"/>
									</div>
									<div class="messageContainer col-sm-4"></div>
							   </div>
							</div>
						</div>
						</form>
						
						
						<form action='' method='' id='formpromote' >
			<div class="btn-plus">
			<?php if($_SESSION['adminsession']['user_role']==1){?>
			<input type="button" value="promote" class="btn btn-primary" onclick="loadPopup()" style="float:right"/>
			
			<?php } else {?>
			<input type="button" value="promote" class="btn btn-primary" onclick="" disabled style="float:right"/>
			<?php }?>
			
			</div>
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Restaurant List
              	</div>
               	<div class="panel-body">
                	<div class="dataTable_wrapper">
                	
                	<input type="hidden" name="comment" id="comment" value=''>
                       	<table class="table table-striped table-bordered table-hover" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>Select</th>
									<th>Restaurant</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Status</th>
									<th>Priority</th>
								</tr>
							</thead>
							<tbody>
							<?php if (isset($restaurants)) { $i=0; ?>
							<?php foreach ($restaurants as $item){?>
								<tr>
									<td>
										<input type="checkbox" name="promote[]" id = '<?php echo $item['restid'];?>' value="<?php echo $item['restid'];?>">
									</td>
									<td>
										<?php echo $item['name'];?>
									</td>
									<td>
									 <input type="text" id="" name="start_date<?php echo $item['restid'];?>" class="form-control sdate" placeholder="Start Date" style="display:inline;" value="<?php echo $item['start_date'];?>" required/>
									</td>
									<td>
										<input type="text" id="" name="end_date<?php echo $item['restid'];?>" class="form-control edate" placeholder="End Date" style="display:inline;" value = "<?php echo $item['end_date'];?>" required/>
										<input type="hidden" name="status<?php echo $item['restid'] ?>" value="1">
									</td>
									<td>
									<?php if($_SESSION['adminsession']['user_role']==1){?>
									 <?php if($item['status'] != NULL) {?>
                                    <?php if($item['status'] == 1) {?>
                                    	<a href="javascript:turnOn(<?php echo $item['id'];?>,1)" >
                                        	<i class="fa fa-cog text-success fa-lg"></i>
                                       	</a>
                                  	<?php }else{?>
                                      	<a href="javascript:turnOn(<?php echo $item['id'];?>,0)">
                                        	<i class="fa fa-cog text-danger fa-lg"></i>
                                     	</a>
                                    <?php }}} ?>
                                 
                                    
									</td>
									<td><select name="priority<?php echo $item['restid']?>" id="priority" style="">
										<option value='1' <?php if($item['priority']==1){ echo "selected";}?>>1</option>
										<option value='2' <?php if($item['priority']==2){ echo "selected";}?>>2</option>
										<option value='3' <?php if($item['priority']==3){ echo "selected";}?>>3</option>
										<option value='4' <?php if($item['priority']==4){ echo "selected";}?>>4</option>
										<option value='5' <?php if($item['priority']==5){ echo "selected";}?>>5</option>
									</select> 
									<?php if($_SESSION['adminsession']['user_role']==1){?>
										<?php if($item['status'] !=null){?>
									<button type="button" class="btn btn-success btn-xs" style="float:right" onclick = 'loadPopupUpdate("<?php echo $item['restid']?>")'>Edit</button>
									<?php } ?>
									<?php } ?>
									</td>
								</tr>
								
								<?php }?>
							<?php } else { ?>
								<tr><td colspan="5">Records not found.</td></tr>
							<?php }?>
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>

<!--  Comment for Log -->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background:#transparent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Comment</h4>
        </div>
        <div class="modal-body" style="padding:0px">
          <textarea rows='5' style="width:100%" autofocus id="cmt"></textarea>
        </div>
        <div class="modal-footer" style="background-color: none">
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='promote()'>Add</button>
          <button type="button " class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModalupdate" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background:#transparent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Comment</h4>
        </div>
        <input type="hidden" name="updatedid" id="updatedid">
        <div class="modal-body" style="padding:0px">
          <textarea rows='5' style="width:100%" autofocus id="cmt1"></textarea>
        </div>
        <div class="modal-footer" style="background-color: none">
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='promoteUpdate()'>Add</button>
          <button type="button " class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="status" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background:#transparent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Comment</h4>
        </div>
         
        <input type="hidden" name="restaurantid" id="restaurantid"/>
        <input type="hidden" name="statusvalue" id="statusvalue"/>
        <div class="modal-body" style="padding:0px">
          <textarea rows='5' style="width:100%" autofocus id="comment3"></textarea>
        </div>
        <div class="modal-footer" style="background-color: none">
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='status()'>Add</button>
          <button type="button " class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
  
<script src="<?php echo asset_url(); ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url(); ?>js/bootstrap-timepicker.min.js"></script>
<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";
$(document).ready(function () {
  	
   	var d = new Date();
   	var currMonth = d.getMonth();
    var currYear = d.getFullYear();
    var startDate = new Date(currYear,currMonth,d.getDate());
    $('.sdate').datepicker('');
    $('.edate').datepicker();
});
 </script>
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
});
function promote()
{
	
	$('#comment').val($('#cmt').val());

	if($('#comment').val()!='')
	{
		$.ajax({
            url:base_url + "admin/restaurant/promote",
            type: 'GET',
            data: $('#formpromote').serialize(),
            success: function(result) {
            	
            	alert('Promote Successfull');
            	location.reload();
            }
			
	       //location.reload();
	});
	}
	else
	{
		alert(' Please Add comment then Action is completed ');
	    
	}
	
}

function loadPopup()
{
	
	$('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
   
  
}
function promoteUpdate()
{
	
	$('#comment').val($('#cmt1').val());
	var uid = $('#updatedid').val();
	if($('#'+uid).prop("checked")==true)
	{  if( $('#comment').val()!='')
	{
		$.ajax({
            url:base_url + "admin/restaurant/promoteUpdate",
            type: 'GET',
            data: $('#formpromote').serialize(),
            success: function(result) {
            	location.reload();
                alert('update Successfull');
            }
			
	       //location.reload();
	});
	}else
	{
		alert(' Please Add comment then Action is completed ');
	}
	}
	else
	{
		alert(' Please select checkbox ');
	    
	}
	
}
function loadPopupUpdate(uid)
{
	$('#updatedid').val(uid);
	$('#myModalupdate').modal({
        backdrop: 'static',
        keyboard: false
    });
}

function status()
{
	if($('#comment3').val()!='')
	{
		if($('#statusvalue').val()==1 )
		{
	$.get(base_url + "admin/restaurant/turnoffpromotedresto",{id: $('#restaurantid').val(),comment: $('#comment3').val()}, function (data) {
	       alert('Status is changed');
	       location.reload();
  	});
		}
		else
		{
			$.get(base_url + "admin/restaurant/turnonpromotedresto",{id: $('#restaurantid').val(),comment: $('#comment3').val()}, function (data) {
			       alert('Status is changed');
			       location.reload();
		  	});
		}
	}
	else
	{
		alert(' Please Add comment then Action is completed ');
	    
	}
}

function turnOn(restid,status)
{
	$('#status').modal({
        backdrop: 'static',
        keyboard: false
    });
   $('#restaurantid').val(restid);
   $('#statusvalue').val(status);
 	//alert('User is Activated');
  	//location.reload(true);
}


$("#cityid").change(function () {
	var html = "<option value=''> Select Zone </option>";
 	$.get(base_url + "admin/banner/getzonebycityid", {cityid: $("#cityid").val()}, function (data) {
 		$.each(data, function (key, value) {
 	         html=html+ "<option value='" + value.id + "'> " + value.name + " </option>" ;
  		});
        $('#zone_id').html(html);
 		
  	},'json');
});
</script>