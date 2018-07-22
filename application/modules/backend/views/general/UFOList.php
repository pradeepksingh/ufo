		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">General > Manage UFO</div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info" id="source-list">
                            <div class="panel-heading"> UFO</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                	<div class="white-box">
			                            <div class="table-responsive">
			                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
			                                    <thead>
			                                        <tr>
			                                        	<th>Sr.</th>
			                                            <th>UFOID </th>
			                                            <th>Status</th>
			                                            <th>Availibility</th>
			                                            <th>Created By</th>
			                                            <th>Action</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                    <?php 
			                                    $i = 0;
			                                    foreach($ufoids as $ufo) {
			                                    $i++;
			                                    	?>
			                                        <tr>
			                                        	<td><?php echo $i; ?></td>
			                                            <td><?php echo $ufo['ufoid']?></td>
			                                            <td><?php  if($ufo['status']==1){ echo "Enable"; } else {echo "Disable";}?></td>
			                                            <td><?php  if($ufo['is_available']==1){ echo "available"; } else {echo "Not Available";}?></td>
			                                            <td><?php echo $ufo['first_name'].' '.$ufo['last_name'];?></td>
			                                             <td><a href="<?php echo base_url();?>admin/ufoid/edit/<?php echo $ufo['id']; ?>"><i class="ti-pencil-alt"></i></a></td>
			                                        </tr>
			                                       <?php }?>
			                                       
			                                    </tbody>
			                                </table>
			                            </div>
			                        </div>
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
	addNewSource();
});
function addNewSource() {
	$.post(base_url+"admin/source/add", { name: $("#name").val(),  status : $("#status").val() }, function(data){
		if(data.status == 1) {
			alert(data.msg);
			window.location.reload();
			window.location.href = base_url+"admin/source/new#property-list";
		} else {
			$("#profile_response").show();
			$("#profile_response").html(data.msg);
		}
	},'json');
}
</script>