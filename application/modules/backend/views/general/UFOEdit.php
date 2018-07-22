	<style>
	#profile_response{
	color:red;
	}
	</style>
		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">Status > Edit UFOID</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Edit UFOID </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">	
                                	<?php
                                	foreach($ufoids as $ufo){?>
                                    <form action="" id="ufo-form"  method="post">
                                        <div class="form-body">
                                            <h3 class="box-title">UFO Form</h3>
                                            <div id="profile_response"></div>
                                            <hr>
                                            <div class="row">
                                            	<div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">UFO ID</label>
                                                        <input type="text" id="ufo" name="ufo" value="<?php echo $ufo['ufoid']?>" class="form-control" placeholder="Ufo id"> 
                                                        <input type="hidden" id="ufo_id" name="ufo_id" value="<?php echo $ufo['id']?>" class="form-control" placeholder="id"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">UFO Availibility</label>
                                                        <select id="availibility" name="availibility" required class="form-control"> 
                                                        	<option value="" >Select Availibility</option>
                                                        	<option value="1" <?php if($ufo['is_available'] == 1){echo "selected"; } ?>>Available</option>
                                                        	<option value="0" <?php if($ufo['is_available'] == 0){echo "selected"; } ?> >Not Available</option>
                                                        </select>
                                                     </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Status</label>
                                                        <select id="status" name="status" required class="form-control"> 
                                                        	<option value="" >Select status</option>
                                                        	<option value="1" <?php if($ufo['status'] == 1){echo "selected"; } ?>>Enable</option>
                                                        	<option value="0" <?php if($ufo['status'] == 0){echo "selected"; } ?> >Disable</option>
                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                            <!--/row-->
                                            <!--/row-->
                                            <hr>
                                            
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" onclick="window.history.go(-1); return false;" class="btn btn-default">Cancel</button>
                                        </div>
                                        </div>
                                     </form><?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
		</div>
		
	<script src="<?php echo asset_url();?>backend/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo asset_url();?>backend/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo asset_url();?>backend/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo asset_url();?>backend/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo asset_url();?>backend/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <script src="<?php echo asset_url();?>backend/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;

                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });

            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
    <script type="text/javascript" src="<?php echo asset_url();?>js/bootstrapValidator.min.js" ></script>
<script>
$('#ufo-form').bootstrapValidator({
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
                    message: 'UFOID is required and cannot be empty'
                }
            }
        }, 
        
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	updateUfo();
});
function updateUfo() {
	$.post(base_url+"admin/ufoid/update", {id :$("#ufo_id").val(), ufoid:$("#ufo").val(),  availibility: $("#availibility").val(),  status : $("#status").val() }, function(data){
		if(data.status == 1) {
			alert(data.msg);
			window.location.href = base_url+"admin/ufoid";
		} else {
			alert(data.msg);
			$("#profile_response").show();
			$("#profile_response").html(data.msg);
		}
	},'json');
}
</script>