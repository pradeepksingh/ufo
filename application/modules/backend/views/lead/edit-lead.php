	<link href="<?php echo asset_url();?>css/selectize.bootstrap3.css" rel="stylesheet">
		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">Lead > Add Lead</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Add New Lead</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                <?php foreach ($leads as $lead){?>
                                    <form action="" id="lead-form"  method="post">
                                        <div class="form-body">
                                            <h3 class="box-title">Person Info</h3>
                                            <hr>
                                            <div class="row">
                                            	<div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Phone</label>
                                                        <input type="text" id="mobile" name="mobile" value="<?php echo $lead['mobile'];?>" class="form-control" placeholder="Phone"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Name</label>
                                                        <input type="text" id="name" name="name" value="<?php echo $lead['name']; ?>" class="form-control" placeholder="Enter enquirer's name">
                                                        <input type="hidden" id="lead_id" name="lead_id" value="<?php echo $lead['id']; ?>" class="form-control" placeholder="Enter enquirer's name"> 
                                                     </div>
                                                     <div class="messageContainer"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Email</label>
                                                        <input type="text" id="email" name="email" value="<?php echo $lead['email']; ?>" class="form-control" placeholder="Enter enquirer's name"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Source</label>
                                                        <select class="selectize" id="source" name="source" class="form-control" required>
                                                        	<option value="" >Select Source</option>
                                                        	<?php foreach($leadSource as $source){?>
                                                        	<option value="<?php echo $source['id'];?>" <?php if($source['id']== $lead['source_id']){echo "selected"; } ?>><?php echo $source['name'];?></option>
                                                        	<?php }?>
                                                        </select> 
                                                     </div>
                                                </div>
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                            	<div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Property Type</label>
                                                        <input type="text" id="property-type" class="form-control" value="<?php echo $lead['property_type']; ?>" placeholder="eg : Residential / Commercial"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Property Size</label>
                                                        <!-- <input type="text" id="property-size" name="property-size" class="form-control" placeholder="eg: 2BHK, 1BHK etc">  -->
                                                        <select class="selectize" id="property-size" name="property-size" class="form-control"> 
                                                        	<option value="" >Select Property Size</option>
                                                        	<?php foreach($propertySize as $size){ ?>
                                                        	<option value="<?php echo $size['id'];?>" <?php if($size['id'] == $lead['property_size_id']){echo "selected";}?>><?php echo $size['name'];?></option>
                                                        	<?php }?>
                                                        </select>
                                                     </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Assign Executive</label>
                                                        <!-- <input type="text" id="property-size" name="property-size" class="form-control" placeholder="eg: 2BHK, 1BHK etc">  -->
                                                        <select class="selectize" id="executive_id" name="executive_id" class="form-control"> 
                                                        	<option value="" >Select Executive</option>
                                                        	<?php foreach($executives as $executive) {?>
                                                        	<option  value="<?php echo $executive['id']; ?>" <?php if($executive['id']== $lead['executive_id']){ echo "selected";}?>><?php echo $executive['first_name'].' '.$executive['last_name']; ?></option>
                                                        	<?php }?>
                                                        </select>
                                                     </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Lead Status</label>
                                                        <!-- <input type="text" id="property-size" name="property-size" class="form-control" placeholder="eg: 2BHK, 1BHK etc">  -->
                                                        <select class="selectize" id="lead_status_id" name="lead_status_id" class="form-control"> 
                                                        	<option value="" >Select Lead Status</option>
                                                        	<?php foreach($leadStatus as $status) {?>
                                                        	<option  value="<?php echo $status['id']; ?>" <?php if($status['id'] == $lead['lead_status_id']){echo "selected";} ?>><?php echo $status['status_name']; ?></option>
                                                        	<?php }?>
                                                        </select>
                                                     </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Priority</label>
                                                        <!-- <input type="text" id="property-size" name="property-size" class="form-control" placeholder="eg: 2BHK, 1BHK etc">  -->
                                                        <select class="selectize" id="priority" name="priority" class="form-control"> 
                                                        	<option value="" >Select Lead Priority</option>
                                                        	<option value="1" <?php if( $lead['priority'] ==1) { echo  "selected"; } ?>>Hot</option>
                                                        	<option value="2" <?php if( $lead['priority'] ==2) { echo  "selected"; } ?>>Warm</option>
                                                        	<option value="3" <?php if( $lead['priority'] ==3) { echo  "selected"; } ?>>Cold</option>
                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <!--/span-->
                                                <div class="col-md-12">
                                                    <div class="form-group ">
                                                        <label class="control-label">Message/Comment</label>
                                                        <textarea rows="4" cols="10" required name="message" id="message" class="form-control"><?php echo $lead['message']; ?></textarea>
                                                     </div>
                                                </div>
                                            </div>
                                            <!--/row-->
                                            <hr>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                                            <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-default">Cancel</button></a>
                                        </div>
                                    </form>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
		</div>
		<script type="text/javascript" src="<?php echo asset_url();?>js/bootstrapValidator.min.js" ></script>
		<script type="text/javascript" src="<?php echo asset_url();?>js/selectize.min.js" ></script>
<script>
$('.selectize').selectize({
    create: true,
    maxItems: 1
});
</script>
<script>
$('#lead-form').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
  		name: {
            validators: {
                notEmpty: {
                    message: 'Full Name is required and cannot be empty'
                }
            }
        }, 
        email: {
            validators: {
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
                }
        		
            }
        },
        mobile: {
            validators: {
                notEmpty: {
                    message: 'Mobile is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
        		
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	updateLead();
});
function updateLead() {
	var id = $("#lead_id").val();
	$.post(base_url+"admin/lead/update/"+id, { name: $("#name").val(), priority:$("#priority").val(), email: $("#email").val(), mobile: $("#mobile").val(), property_size: $("#property-size").val(), property_type: $("#property-type").val() , message: $("#message").val() , source: $("#source").val(), lead_status_id : $("#lead_status_id").val(), executive_id : $("#executive_id").val() }, function(data){
		if(data.status == 1) {
			alert(data.msg);
			window.location.href = base_url+"admin/leads";
		} else {
			$("#profile_response").show();
			$("#profile_response").html(data.msg);
		}
	},'json');
}
</script>