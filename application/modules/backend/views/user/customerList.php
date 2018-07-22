<style>
<!--
.btn-plus {
	margin: 5px 0px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div>
			<form action="<?php echo base_url().'general/editcity'?>"
				method="post"></form>
		</div>
		<div class="col-lg-12">
			<!--<div class="btn-plus">
				<a href="#"
					class="btn btn-primary view-contacts bottom-margin"> <i
					class="fa fa-plus"></i> Add User
				</a>
			</div>-->
			<div class="panel panel-default">
				<div class="panel-heading">Customer List</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover"
							id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Mobile</th>
									<th>Email</th>
									<th>Address</th>
									<th>Locality</th>									
									<th>Zonename</th>
									<th>Area Name</th>
									<th>Created On</th>
								</tr>
							</thead>
							<tbody>
							
							<?php foreach ($users as $user){?>
							
								<tr>
									<td>
										<?php echo $user['id'];?>
									</td>
									<td>
										<?php echo $user['name'];?>
									</td>
									<td>
										<?php echo $user['mobile'];?>
									</td>
									<td>
										<?php echo $user['email'];?>
									</td>
									<td>
										<?php echo $user['address'];?>
									</td>
									<td>
										<?php echo $user['locality'];?>
									</td>
									<td>
										<?php echo $user['zonename'];?>
									</td>
									<td>
										<?php echo $user['areaname'];?>
									</td>
									<td>
										<?php echo date('d-m-Y',strtotime($user['created_on']));?>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!--<a href=""
				class="btn btn-primary view-contacts bottom-margin"> <i
				class="fa fa-plus"></i> Add user
			</a>-->
		</div>
	</div>
</div>
<!-- Modal coment -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background:#transparent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Comment</h4>
        </div>
        <div class="modal-body" style="padding:0px">
        <input type="hidden" id="uid" value=""/>
        <input type="hidden" id="status" value=""/>
          <textarea rows='5' style="width:100%" autofocus id="comment"></textarea>
        </div>
        <div class="modal-footer" style="background-color: none">
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='status()'>Add</button>
          <button type="button " class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="roleassign" role="dialog" style="top:100px">
    <div class="modal-dialog modal-sm">
      <div class="modal-content"  style="">
        <div class="modal-body" style="padding:20px">
        <input type="hidden" id="uid" value=""/>
        <input type="hidden" id="status" value=""/>
         <select class="form-control" id='role' required style="width:100%">
         <option value=""> Select Role</option>
         <option value="1"> Admin</option>
         <option value="2"> Content Executive</option>
         <option value="3"> Marketing</option>
         </select>
         <input type="hidden" value="" id="rid">
        </div>
        <div class="modal-footer" style="padding:0px">

          <button type="button " class="btn btn-primary"  id="asign">Assign</button>
         <button type="button " class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
<script>
$(document).ready(function(){
    $('#tblRestos').DataTable();
});
function rolemodal($id)
{

	$('#rid').val($id);
	$('#roleassign').modal({
        backdrop: 'static',
        keyboard: true
    });
}

$('#asign').click(function(){
	
	if($('#role').val()!='')
	{
	$.get(base_url + "admin/login/assignrole/",{id: $('#rid').val(),role:  $('#role').val(),comment: $('#comment').val()}, function (data) {
	       alert('User Role assigne succesfully');
	       location.reload();
	});
	}
	else
	{
		alert('please select role');
	}
});

function status(id,status)
{
	if($('#comment').val()!='')
	{
	$.get(base_url + "admin/login/turnonof/",{id: $('#uid').val(),status:  $('#status').val(),comment: $('#comment').val()}, function (data) {
	       alert('Status is changed');
	       location.reload();
  	});
	}
	else
	{
		alert(' Please Add comment then Action is completed ');
	    
	}
}
function turnOn(id,status)
{
	$('#myModal').modal({
        backdrop: 'static',
        keyboard: false
    });
   $('#uid').val(id);
   $('#status').val(status);
 	//alert('User is Activated');
  	//location.reload(true);
}

function deleteOffer(id)
{
 	$.get(base_url + "admin/offer/deleteoffer/"+ id, {}, function (data) {
       
  	});
 	alert('Offer is removed');
 	location.reload(true);
}

</script>