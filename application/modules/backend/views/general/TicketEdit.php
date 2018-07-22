<style>
<!--
.margin-bottom-5 {
	margin-bottom: 5px;
}
-->
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3>Edit Ticket</h3>
		</div>
	</div>
	<form id="addticket" name="addticket" action="" method="post" enctype="multipart/form-data">
		<div class="tab-content">
		  	<div id="basic" class="tab-pane fade in active">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<input type="hidden" name="ticket[ticketid]" id="ticketid" value="<?php echo $ticket['ticketid'];?>"/>
								<input type="hidden" name="ticket[userid]" id="userid" value="<?php echo $ticket['userid'];?>"/>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-3">Ticket Number</label>
											<div class="col-sm-5">
												<?php echo $ticket['ticket_no'];?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-3">Customer Mobile <span class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<input type="text" class="form-control" name="ticket[mobile]" id="mobile" value="<?php echo $ticket['mobile'];?>"/>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-3">Customer Name <span class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<input type="text" class="form-control" name="ticket[name]" id="name" value="<?php echo $ticket['name'];?>"/>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-3">Order ID </label>
											<div class="col-sm-5">
												<input type="text" class="form-control" name="ticket[orderid]" id="orderid" value="<?php if(!empty($ticket['orderid'])){ echo $ticket['orderid'];}?>"/>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<!--<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-3">Number Of Cloths </label>
											<div class="col-sm-5">
												<input type="text" class="form-control" name="ticket[quantity]" id="quantity" value="<?php if(!empty($ticket['quantity'])){echo $ticket['quantity'];}?>"/>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>-->
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-subject">
											<label class="control-label col-sm-3">Subject <span class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<input type="text" class="form-control" name="ticket[subject]" id="subject" value="<?php if(!empty($ticket['subject'])) {echo $ticket['subject'];}?>"/>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-description">
											<label class="control-label col-sm-3">Description <span class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<textarea name="ticket[description]" id="description" class="form-control"><?php if(!empty($ticket['description'])) {echo $ticket['description'];}?></textarea>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-priority">
											<label class="control-label col-sm-3">Priority</label>
											<div class="col-sm-5">
												<select name="ticket[priority]" id="priority" class="form-control">
													<option value="0" <?php if($ticket['priority'] == 0) { ?>selected<?php } ?>>Low</option>
													<option value="1" <?php if($ticket['priority'] == 1) { ?>selected<?php } ?>>Normal</option>
													<option value="2" <?php if($ticket['priority'] == 2) { ?>selected<?php } ?>>High</option>
													<option value="3" <?php if($ticket['priority'] == 3) { ?>selected<?php } ?>>Urgent</option>
												</select>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<!--<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-type">
											<label class="control-label col-sm-3">Service Type</label>
											<div class="col-sm-5">
												<select name="ticket[type]" id="type" class="form-control">
													<option value="0" <?php if($ticket['type'] == 0) { ?>selected<?php } ?>>Select Type Of Service</option>
													<option value="1" <?php if($ticket['type'] == 1) { ?>selected<?php } ?>>Wet Cleaning</option>
													<option value="2" <?php if($ticket['type'] == 2) { ?>selected<?php } ?>>Dry Cleaning</option>
													<option value="3" <?php if($ticket['type'] == 3) { ?>selected<?php } ?>>Ironing</option>
												</select>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>-->
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-assigned_to">
											<label class="control-label col-sm-3">Assigned To <span class='text-danger'>*</span></label>
											<div class="col-sm-5">
												<select name="ticket[assigned_to]" id="assigned_to" class="form-control">
													<option value="0">Select Executive</option>
													<?php foreach ($acps as $acp) { ?>
													<option value="<?php echo $acp['id'];?>" <?php if($ticket['assigned_to'] == $acp['id']) { ?>selected<?php } ?>><?php echo $acp['first_name'];?> <?php echo $acp['last_name'];?></option>
													<?php } ?>
												</select>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-3">Status</label>
											<div class="col-sm-5">
												<select name="ticket[status]" id="status" class="form-control">
													<option value="0" <?php if($ticket['status'] == 0) { ?>selected<?php } ?>>Open</option>
													<option value="1" <?php if($ticket['status'] == 1) { ?>selected<?php } ?>>In Progress</option>
													<option value="2" <?php if($ticket['status'] == 2) { ?>selected<?php } ?>>Wait For Response</option>
													<option value="3" <?php if($ticket['status'] == 3) { ?>selected<?php } ?>>Closed</option>
												</select>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-3">Created Date</label>
											<div class="col-sm-5">
												<?php echo date('j M Y h:i A',strtotime($ticket['created_date']));?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-3">Updated Date</label>
											<div class="col-sm-5">
												<?php echo date('j M Y h:i A',strtotime($ticket['updated_date']));?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-status">
											<label class="control-label col-sm-3">Created By</label>
											<div class="col-sm-5">
												<?php if(!empty($ticket['created_by_name'])) { echo $ticket['created_by_name'];} else { echo 'NA';}?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 margin-bottom-5">
										<div class="form-group" id="error-description">
											<label class="control-label col-sm-3">Resolution</label>
											<div class="col-sm-5">
												<textarea name="ticket[resolution]" id="resolution" class="form-control"><?php if(!empty($ticket['resolution'])) { echo $ticket['resolution']; }?></textarea>
											</div>
											<div class="messageContainer col-sm-4"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="response"></div>
		<button type="submit" class="btn btn-success">Update</button>
		<br> <br>
	</form>
</div>
<script src="<?php echo asset_url();?>js/bootstrap-typeahead.min.js"></script>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script>
$('#addticket').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('div.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
    	'ticket[name]': {
            validators: {
                notEmpty: {
                    message: 'Customer Name is required and cannot be empty'
                }
            }
        },
        'ticket[mobile]': {
            validators: {
                notEmpty: {
                    message: 'Customer Mobile is required and cannot be empty'
                }
            }
        },
        'ticket[assigned_to]': {
            validators: {
            	notEmpty: {
                    message: 'Assigned To is required and cannot be empty'
                }
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	// Prevent form submission
	event.preventDefault();
	addTicket();
});

function addTicket() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/general/ticket/update',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#addticket').ajaxSubmit(options);
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
        window.location.href = base_url+"admin/general/tickets";
  	}
}

$("#mobile").typeahead({
    onSelect: function(item) {
        itemvalue = item.value;
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
			$("#name").val(result.name);
			$("#userid").val(result.id);
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[name]');
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[mobile]');
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

$("#name").typeahead({
    onSelect: function(item) {
        itemvalue = item.value;
        $.get(base_url+"admin/user/detail/"+item.value,{},function(result){
			$("#mobile").val(result.mobile);
			$("#userid").val(result.id);
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[email]');
			$('#addticket').bootstrapValidator('revalidateField', 'ticket[mobile]');
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

</script>