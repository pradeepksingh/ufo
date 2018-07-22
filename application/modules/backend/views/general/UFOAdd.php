		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">UFO > Add UFO ID</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Add New UFO ID</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="" id="status-form"  method="post">
                                        <div class="form-body">
                                            <h3 class="box-title">UFO ID Form</h3>
                                            <hr>
                                            <div class="row">
                                            	<div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">UFO ID</label>
                                                        <input type="text" id="ufo" name="ufo" class="form-control" placeholder="Enter UFO ID eg: XA6tT"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                      
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">UFO Status</label>
                                                        <select id="status" name="status" required class="form-control"> 
                                                        	<option value="" >Select UFO Status</option>
                                                        	<option value="1">Enable</option>
                                                        	<option value="0">Disable</option>
                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                            <!--/row-->
                                            <!--/row-->
                                            <hr>
                                         <div id= "profile_response" class="alert alert-danger"  ></div>   
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-default">Cancel</button>
                                        </div>
                                        </div>
                                     </form>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
                  
    <script type="text/javascript" src="<?php echo asset_url();?>js/bootstrapValidator.min.js" ></script>
<script>
$("#profile_response").hide();
$('#status-form').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
  		ufo: {
            validators: {
                notEmpty: {
                    message: 'UFo is required and cannot be empty'
                }
            }
        }, 
        
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	addNewUFO();
});
function addNewUFO() {
	$.post(base_url+"admin/ufoid/add", { ufoid: $("#ufo").val(),  status : $("#status").val() }, function(data){
		if(data.status == 1) {
			alert(data.msg);
			window.location.reload();
			window.location.href = base_url+"admin/ufoid/new";
		} else {
			alert(data.msg);
			$("#profile_response").show();
			$("#profile_response").html(data.msg);
		}
	},'json');
}
</script>