		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">General > Add Property Size</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> Add New Size</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body"><?php foreach($sizes as $size ) ?>
                                    <form action="" id="size-form"  method="post">
                                        <div class="form-body">
                                            <h3 class="box-title">Size Form</h3>
                                            <hr>
                                            <div class="row">
                                            	<div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="control-label">Size Name</label>
                                                        <input type="text" id="name" name="name" value="<?php echo $size['name']; ?>" class="form-control" placeholder="eg: 1 BHK, 2 BHK etc."> 
                                                     	<input type="hidden" id="size_id" name="size_id" value="<?php echo $size['id']; ?>" class="form-control" placeholder="Add status name"> 
                                                     </div>
                                                      <div class="messageContainer"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Status</label>
                                                        <select id="status" name="status" required class="form-control"> 
                                                        	<option value="" >Select Lead Status</option>
                                                        	<option value="1" <?php if($size['status']==1){ echo "selected"; } ?>>Enable</option>
                                                        	<option value="0" <?php if($size['status']==0){ echo "selected"; } ?>>Disable</option>
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
                                     </form>
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
$('#size-form').bootstrapValidator({
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
                    message: 'Name is required and cannot be empty'
                }
            }
        }, 
        
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	updatePropertySize();
});
function updatePropertySize() {
	var id = $("#size_id").val();
	$.post(base_url+"admin/property/size/update", { id: id, name: $("#name").val(),  status : $("#status").val() }, function(data){
		if(data.status == 1) {
			alert(data.msg);
			window.location.href = base_url+"admin/property/size/new#property-list";
		} else {
			$("#profile_response").show();
			$("#profile_response").html(data.msg);
		}
	},'json');
}
</script>