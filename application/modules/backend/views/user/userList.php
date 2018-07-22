<style>
<!--
.btn-plus {
	margin: 5px 0px;
}
#myModal > .modal-dialog{
	margin-top: 20px;
	top :90px;
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
				<div class="panel-heading">Employee List <a href="<?php echo base_url();?>admin/user/new"><button class="btn btn-sm btn-success pull-right">Add New  User</button></a></div>
				<div class="panel-body">
					<div class="">
						<table class="table table-striped " class="display nowrap" cellspacing="0" width="100%" id="tblRestos">
							<thead class="bg-info">
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email Id</th>
									<th>Phone No</th>
									<th>User Role</th>									
									<th>Online</th>
									<th>status</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
							
							<?php foreach ($users as $item){?>
							
								<tr>
									<td>
										<?php echo $item['id'];?>
									</td>
									<td>
										<?php echo $item['first_name'].' '.$item['last_name'];;?>
									</td>
									<td>
										<?php echo $item['email'];?>
									</td>
									<td>
										<?php echo $item['mobile'];?>
									</td>
									<td>
										<?php if($item['user_role']==1) echo 'Admin'; else if($item['user_role']==2) echo 'C.E'; else  echo 'N.A';?>
									</td>
									<td>
									<?php if($item['is_logged_in']==1){?><a href="" class="btn btn-primary icon-btn btn-xs">
												<i class="fa fa-wifi"></i>
											</a>
											<?php }?>
									</td>
									<td>
										<?php if( $item['status'] == 1){?>
										
											<a href="javascript:turnOn(<?php echo $item['id'] ?>,0)" class="btn btn-success icon-btn btn-xs">
												<i class="fa fa-gear"></i>
											</a>
											<?php } else {?>
									
											<a href="javascript:turnOn(<?php echo $item['id'] ?>,1)" class="btn btn-danger icon-btn btn-xs">
												<i class="fa fa-gear"></i>
											</a>
											<?php }?>
									</td>
									<td>
									
										<a href="javascript:rolemodal(<?php echo $item['id'] ?>)"   class="" disabled='true'>
											<i class="ti-user"></i>
										</a>
										&nbsp;
										<a href="<?php echo base_url();?>admin/user/edit/<?php echo $item['id'];?>"   class="" disabled='true'>
											<i class="ti-pencil-alt"></i>
										</a>
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
	<!--  Test Modal -->
	            <!-- sample modal content -->
	            <!-- /.modal -->
	       		<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	                 <div class="modal-dialog">
	                      <div class="modal-content">
	                           <div class="modal-header">
	                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                                <h4 class="modal-title">To change status please comment here.</h4>
	                            </div>
	                            <div class="modal-body">
	                                <form>
	                                    <div class="form-group">
	                                       <label for="message-text" class="control-label">Comment:</label>
	                                        <input type="hidden" id="uid" value="" class="form-control"/>
											<input type="hidden" id="status" value="" class="form-control"/>
	                                        <textarea rows='5'  autofocus id="comment" class="form-control"></textarea>
	                                    </div>
	                                </form>
	                            </div>
	                            <div class="modal-footer">
	                               <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
	                               <button type="button" class="btn btn-danger waves-effect waves-light" onclick='status()'>Save changes</button>
	                            </div>
	                       </div>
	                  </div>
	              </div>
	              <!-- Button trigger modal -->
<!-- - Test Modal End -->

<!-- Modal coment -->
<!-- <div class="modal fade" id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
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
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='status()'>Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
   -->
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
        <div class="modal-footer" style="padding:5px">
          <button type="button" class="btn btn-primary"  id="asign">Assign</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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