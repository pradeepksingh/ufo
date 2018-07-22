		<div id="page-wrapper" >
			<div class="container-fluid">
				<div class="row bg-title">Lead </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> All Leads <div class="pull-right"><a href="<?php echo base_url();?>admin/lead/new"><button class="btn btn-sm btn-success pull-right">Add New Lead</button></a></div></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                   <div class="row">
				                    <div class="col-sm-12">
				                        <div class="white-box">
				                            <div class="table-responsive">
				                                <table id="myTable" class="table table-striped">
				                                    <thead>
				                                        <tr>
				                                            <th>Name</th>
				                                            <th>Phone</th>
				                                            <th>Email</th>
				                                            <th>Type</th>
				                                            <th>Size</th>
				                                            <th>Status</th>
				                                            <th>Priority</th>
				                                            <th>Executive</th>
				                                            <th>Action</th>
				                                        </tr>
				                                    </thead>
				                                    <tbody>
				                                    	<?php foreach($leads as $lead) {?>
			                                    	<tr>
			                                    		<td><?php echo $lead['name']; ?></td>
			                                            <td><?php echo $lead['mobile']; ?></td>
			                                            <td><?php echo $lead['email']; ?></td>
			                                            <td><?php echo $lead['property_type']; ?></td>
			                                            <td><?php echo $lead['size']; ?></td>
			                                            <td><?php echo $lead['lead_status']; ?></td>
			                                            <td><?php if($lead['priority'] ==1){echo "Hot";}elseif($lead['priority']==2) {echo "Warm";}  elseif($lead['priority']==3){ echo "Cold";} ?></td>
			                                            <td><?php echo $lead['first_name'].' '.$lead['last_name']; ?></td>
			                                            <td><a href="<?php echo base_url(); ?>admin/lead/edit/<?php echo $lead['id']?>"><i class="ti-pencil-alt"></i></a>&nbsp;<a href="javascript:edit(<?php echo $lead['id']?>);"><i class="ti-trash"></i></a>&nbsp;<a href="<?php echo base_url();?>admin/lead/view/<?php echo $lead['id']?>"><i class="ti-desktop"></i></a></td>
			                                    	
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
	addNewLead();
});
function addNewLead() {
	alert('Hello');
	$.post(base_url+"admin/lead/add", { name: $("#name").val(), email: $("#email").val(), mobile: $("#mobile").val(), property_size: $("#property-size").val(), property_type: $("#property-type").val() , message: $("#message").val() }, function(data){
		if(data.status == 1) {
			alert("Profile Updated Successful.")
			//window.location.href = base_url+"user/profile";
		} else {
			$("#profile_response").show();
			$("#profile_response").html(data.msg);
		}
	},'json');
}
</script>
