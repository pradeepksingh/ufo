<style>
<!--
.btn-plus{
	margin:5px 0px;
}
.row
{
margin-bottom:5px;
}

-->
</style>






<div id="page-wrapper" style="padding:0 16px;">
	<div class="row">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	<span style="cursor:pointer;" onclick="hideNav();" id="show-hide-nav"><i class="fa fa-chevron-circle-left fa-2x"></i></span> Banner Report
              	</div>
              	<div>
              	<div class="row" style="margin-top:20px">
	            	<div class="col-lg-12 margin-bottom-5" >
	                	<div class="form-group" id="error-cityid">
                        	<div class="col-sm-5">
                        	<input type="text" id="from_date" name="from_date" class="form-control" placeholder="From Date"/>
                        	</div>
                            <div class="col-sm-5">
                            	<input type="text" id="to_date" name="to_date" class="form-control" placeholder="To Date"/>
							</div>
							<div class="col-sm-2">
							<input type="button" name="search" id="search" class="btn btn-primary" value="Search" onclick="search()"/>
							</div>
							
                    	</div>
	             	</div>
	         	</div>
              	</div>
               	<div class="panel-body">
               		<center>
              			<div id="ajaxTest" style="position:absolute;width:100px; height:50px;background-color:transparent">
            				<div id="dynElement">
            				</div>
 						</div>
 					</center>
              
                	<div class="dataTable_wrapper" style="overflow:auto;">
              <table id="example1" class="display" cellspacing="0" width="100%">
        <thead class="bg-info">
            <tr>
            	
            	<th>Rest Id</th>
            	<th>Zone	</th>
            	<th>Area	</th>
             	<th> Restaurant </th>
             	<th> Click      </th>
             	<th> Convert    </th>
             	
            </tr>
        </thead>
        <tfoot>
             <tr>
             	<th>Rest Id</th>
             	<th>Zone	</th>
            	<th>Area	</th>
             	<th> Restaurant </th>
             	<th> Click      </th>
             	<th> Convert    </th>
             	
            </tr>
        </tfoot>
        <tbody id="ubody">
       <?php if (isset($report)) { ?>
							<?php foreach ($report as $item):?>
            	<tr>
            						<td>
										<?php echo $item['restid'];?>										
									</td>
									<td>
										<?php echo $item['zonename'];?>										
									</td>
									<td>
										<?php echo $item['area'];?>										
									</td>
									<td>
										<?php echo $item['name'];?>
										
									</td>
									<td>
										<?php echo $item['click'];?>
									</td>
									<td>
										<?php echo $item['converted'];?>
									</td>
									
								</tr>
								<?php endforeach;?>
							<?php }?>
						
          
            </tbody>
            </table>
					</div>
				</div>
		</div>
	</div>
</div>

<script src="<?php echo asset_url();?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo asset_url();?>js/spin.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.introLoader.js"></script>






<script>
$.fn.datepicker.defaults.format = "dd-mm-yyyy";


$(document).ready(function() {
	$('#from_date').datepicker();
    $('#to_date').datepicker();
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o" style="padding:5px;font-size:20px"></i>',
                titleAttr: 'CSV'
            }
            
        ]
    } );
} );
function search()
{
	$("#ubody").fadeOut();
    $("#dynElement").introLoader({
        animation: {
            name: 'simpleLoader',
            options: {
                stop: false,
                fixed: false
            }
        }
    });
	$.post(base_url+"admin/report/searchbannerreport",{from_date: $("#from_date").val(), to_date: $("#to_date").val(),cityid: $("#cityid").val(), areaid: $("#areaid").val()},function(data){
		var oTable = $("#example1").dataTable();
		var mode='';
		  var isTakeaway='';
		  var status='';
		  var csename='';
	    oTable.fnClearTable();
	    $(data).each(function(index){
		    
			    var row = [];
	    	    row.push(data[index].restid);
	    	    row.push(data[index].zonename);
	    	    row.push(data[index].area);
		    	row.push(data[index].name);
			    row.push(data[index].click);
		    	row.push(data[index].converted);
		    	oTable.fnAddData(row);
	    });
	   
	},'json');
	var loader = $('#dynElement').data('introLoader');
    loader.stop();
    $("#ubody").fadeIn();
}


</script>