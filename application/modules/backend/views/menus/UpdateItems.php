<style>
<!--
.margin-bottom-5{
	margin-bottom: 5px;
}
.caption{
	font-size:18px;
}
-->
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div id="page-wrapper" style="padding:2px;">
	<div class="row">
		<div>
		</div>
		<div class="col-lg-12">
        	<div class="panel panel-default">
            	<div class="panel-heading">
                	Update Menu
              	</div>
               	<div class="panel-body">
               		<div class="row">
					<?php if($group != null) { ?>
						<button class="expand removeitem btn btn-sm btn-danger pull-right">Expand All</button>
					<?php } ?>
					    <a  href="<?php echo base_url();?>admin/menus/items/end_date_items?restid=<?php echo $restid;?>"></a>
						 	<div id="messageContainer" ></div>
							<ul class="nav nav-tabs" id="maincategory">
							<?php 
							$i = 0;
							foreach ($group as $maincat) {
							?>
								<li id="<?php echo $maincat['id'];?>" <?php if($i == 0) {?>class="active"<?php } ?>>
									<a data-toggle="tab" href="#maincat_tab<?php echo $i;?>">
										<span name="main_cat_name" data-name="<?php echo $restid;?>" data-pk="<?php echo $maincat['id'];?>"><?php echo $maincat['name'];?></span>
									</a>
								</li>
							<?php 
								$i++;
							} 
							?>
							</ul>
							<form id="updateItems" name="updateItems" method="post" action="<?php echo base_url();?>admin/menu/items/update_menu" enctype="multipart/form-data">
							<input  type="hidden" name="restid" id="restid" value="<?php echo $restid;?>" />
							<div class="tab-content">
							<?php 
							$i = 0;
							foreach ($group as $maincat) {
							?>
							<div id="maincat_tab<?php echo $i;?>" class="tab-pane fade <?php if($i == 0) {?>in active<?php } ?>">
							<?php 
							$j = 0;
							$categories = $maincat['categories'];
							?>
								<div class="accordion" id="<?php echo $i;?>">
								<?php 
								foreach ($categories as $category) {
								?>
						 			<div class="main" id="<?php echo $maincat['id'];?>" >
										<h3 class="portlet blue box" id="<?php echo $category['id'];?>">
											<div class="portlet-title">
												<div class="caption">
											 	 	<input type="hidden" id="menu_cat_id" value="<?php echo $maincat['id'];?>">
													<i class="fa fa-bars"></i>&nbsp;&nbsp;&nbsp;
													<a href="#" class="rname" id="cat<?php echo $category['id'];?>"><?php echo $category['sortorder'];?></a>&nbsp &nbsp
						                            <span class="edit" id="edit-cat<?php echo $category['id'];?>">  
						                           		<a href="#" name="cat_name" class="publicname-change editable editable-click inline-input"><?php echo $category['name'];?></a>
						                          	</span>&nbsp &nbsp
						                          	<span class="editable-container editable-inline" style="display: none;" id="edit-form<?php echo $category['id'];?>">
						                          		<div>
					                          				<form class="form-inline editableform" style="">
					                          					<div class="control-group">
					                          						<div>
							                          					<div class="editable-input" style="position: relative;">
							                          						<input type="text" style="padding-right: 24px;" class="form-control" value="<?php echo $category['name'];?>" id="edit_cat_name<?php echo $category['id'];?>"/>
							                          						<span class="editable-clear-x"></span>
							                          					</div>
							                          					<div class="editable-buttons">
							                          						<button type="button" class="editable-submit btn btn-success btn-xs" onclick="updateCategory(<?php echo $category['id'];?>);">Update</button>
							                          						<button type="button" class="editable-cancel btn btn-danger btn-xs" onclick="displayCategory(<?php echo $category['id'];?>);">X</button>
							                          					</div>
					                          						</div>
					                          						<div class="editable-error-block" style="display: none;"></div>
					                          					</div>
					                          				</form>
					                          			</div>
					                          		</span>
						                            <span id="edit-pencil<?php echo $category['id'];?>" class="edit-pencil" onclick="editCategory(<?php echo $category['id'];?>);"><i class="fa fa-pencil fa-sm"></i></span>
												</div>
											</div>
										</h3>	
										<div class="portlet-body" style="overflow:scroll;width:100%;padding-left:5px;">
											<div style="margin-bottom:5px;">
											<button class="additem btn btn-success btn-sm"  title="category_<?php echo $category['id'];?>"><i class="fa fa-plus"> Add Item</i></button>
											<?php if($category['image'] != "") { ?>
								 			<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#catImageModal" onclick="updateCategoryImage(<?php echo $category['id'];?>);">
								 				<i class="fa fa-cloud-upload"></i> Change Image
								 			</button>
								  			<span>
								  				<img src="<?php echo asset_url();?><?php echo $category['image'];?>" width=180px height=35px style="margin-top:10px;" />
								  			</span>
								   			<?php } else { ?>
							    				<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#catImageModal" onclick="updateCategoryImage(<?php echo $category['id'];?>);"><i class="fa fa-cloud-upload"></i> Add Image</button>
								   			<?php } ?>
								   			</div>
						 					<div class="dataTable_wrapper">
						 						<form id='xyz' name='xyz'></form>
						 						<table class="table table-striped table-bordered table-hover item_list" id="category<?php echo $category['id'];?>" style="overflow: scroll;">
													<tr>
														<th>Action</th>
														<th>Item Name</th>
														<th>S Order</th>
														<th>Size</th>
														<th>Description</th>
														<th>Price</th>
														<th>Vat Tax</th>
														<th>Ser. Tax</th>
														<th>Start Time</th>
														<th>End Time</th>
														<th>Color</th>
														<th>Packaging</th>
														<th>Start Date</th>
														<th>End Date</th>
														<th>Options</th>
														<th>Image</th>
													</tr>
												    <tbody class="tbsort"> 
												    <?php 
													foreach ($category['items'] as $item) {
													?>	
														<tr id="item_<?php echo $item['id'];?>">
															<input type="hidden" name="catid[]" value="<?php echo $category['id'];?>"/>
															<input type="hidden" name="has_options[]" value="<?php echo $item['has_options'];?>"/>
															<input type="hidden" name="option_id[]" value="<?php echo $item['option_id'];?>"/>
															<input type="hidden" id="itemid_<?php echo $item['id'];?>" name="itemid[]" value="<?php echo $item['id'];?>"/>
															<td>
																<span class="duplicateitem" title="Duplicate Item" id="item_<?php echo $item['id'];?>#category_<?php echo $category['id'];?>"><i class="fa fa-copy"></i></span>
															</td>
															<td><input type="text" name="name[]" class="form-control" value="<?php echo $item['name'];?>" required="required" style="width:200px;"/></td>
															<td><input type="text" name="sort[]" size="2" value="<?php echo $item['sortorder'];?>" class="form-control"/></td>
															<td><input type="text" name="size[]" size="2" value="<?php echo $item['size'];?>" style="width:80px;" class="form-control"/></td>
															<td><textarea style="margin: 0px; width: 140px; height: 50px;" name="desription[]" rows="5" cols="50" class="form-control"><?php echo $item['description'];?></textarea></td>
															<td><input type="text" class="form-control" style="margin: 0px; width: 60px;" name="price[]" value="<?php echo $item['price'];?>" required="required"/></td>
															<td><input type="text" class="form-control" style="margin: 0px; width: 60px;" name="vat_tax[]" value="<?php echo $item['vat_tax'];?>" /></td>
															<td><input type="text" class="form-control" style="margin: 0px; width: 60px;" name="service_tax[]" value="<?php echo $item['service_tax'];?>" /></td>
															<td><input type="text" style="width:100px;" class="form-control timepicker size=4 timepicker-default" name="start_time[]" value="<?php echo $item['start_time'];?>" required="required" /></td>
															<td><input type="text" style="width:100px;" class="form-control timepicker size=4 timepicker-default" name="end_time[]" value="<?php echo $item['end_time'];?>" required="required"/></td>
															<td><input type="text" style="margin: 0px; width: 80px;" name="color[]" value="<?php echo $item['color'];?>" class="form-control"/></td>
															<td><input type="text" style="margin: 0px; width: 50px;" name="packaging[]" value="<?php echo $item['packaging'];?>" class="form-control"/></td>
															<?php if (empty($item['start_date']) || $item['start_date'] == '0000-00-00') { ?>
															<td><input type="text" class="date_picker form-control" name="start_date[]" size="6" value="<?php echo date('Y-m-d');?>" style="width:120px;" required="required"/></td>
															<?php } else { ?>
															<td><input type="text" class="date_picker form-control" name="start_date[]" size="6" value="<?php echo $item['start_date'];?>" style="width:120px;" required="required"/></td>
															<?php } ?>
															<?php if (empty($item['end_date']) || $item['end_date'] == '0000-00-00') { ?>
															<td><input type="text" class="date_picker form-control"  name="end_date[]" size="6" value="" style="width:120px;"/></td>
															<?php } else { ?>
															<td><input type="text" class="date_picker form-control"  name="end_date[]" size="6" value="<?php echo $item['end_date'];?>" style="width:120px;"/></td>
															<?php } ?>
															<?php if ($item['has_options'] == 1) { ?>
															<td>
																<a href="<?php echo base_url();?>admin/menu/options/edititemoption/<?php echo $restid;?>/<?php echo $item['option_id'];?>/<?php echo $item['size'];?>?item_name=<?php echo $item['name'];?>" target="_blank"><i class="fa fa-pencil-square" title="Update"></i></a>
																<a class="highlight" href="" onclick="getUploadOptionForm(<?php echo $restid;?>,<?php echo $item['option_id'];?>,'<?php echo $item['size'];?>');" data-toggle="modal" data-target="#uploadOptionModal"><i class="fa fa-cloud-upload" title="Upload"></i></a>
																<a class="highlight" href="<?php echo base_url();?>admin/menu/options/downloadoption/<?php echo $restid;?>/<?php echo $item['option_id'];?>" target="_blank"><i class="fa fa-cloud-download" title="Download"></i></a>
															</td>
															<?php } else { ?>
															<td>
																<a href="<?php echo base_url();?>admin/menu/options/newoption/<?php echo $restid;?>/<?php echo $item['option_id'];?>/<?php echo $item['size'];?>?item_name=<?php echo $item['name'];?>" target="_blank"><i class="fa fa-plus-square" title="Add"></i></a>
																<a class="highlight" href="" onclick="getUploadOptionForm(<?php echo $restid;?>,<?php echo $item['option_id'];?>,'<?php echo $item['size'];?>');" data-toggle="modal" data-target="#uploadOptionModal"><i class="fa fa-cloud-upload" title="Upload"></i></a>
															</td>
															<?php } ?>
															<?php if ($item['image'] == "") { ?>
															<td>
																<input type="file" style='margin: 0px; width: 140px;' name="image[]" />
																<input type="hidden" name="image[]" value="<?php echo $item['image'];?>"/>
															</td>
															<?php } else { ?>
															<td>
																<input type="file" style='margin: 0px; width: 140px;' name="image[]" />
																<span><img src="<?php echo asset_url();?><?php echo $item['image'];?>" width=30px height=30px style="margin-top:10px;"  /></span>
																<input type="hidden" name="image[]" value="<?php echo $item['image'];?>"/>
															</td>
															<?php } ?>
															<input type='hidden' name='is_duplicate[]' value='0'/>
														</tr>
													<?php } ?>
								 					</tbody>
												</table>
											</div>
							    		</div> <!--  portlet body -->
									</div><!-- main--> 
									<?php
										$j++; 
									}
									?>
								</div>
								<div class="text-right" style="padding:5px;">
					    			<a href="" onclick="addNewCategory(<?php echo $maincat['id'];?>,<?php echo $restid;?>,'<?php echo $maincat['name'];?>');" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary" title="Add Category"><i class="fa fa-plus"></i> Add Category</a>	 
								</div>
							</div>
							<?php 
								$i++;
							} 
							?>
							<div>
							<?php if ($group != null) {?>
							<div class="alert">
							 	<button class="btn btn-success" type="submit" id="updateitems" title="Update Menu Items" ><i class="fa fa-save"></i> Update Menu</button> &nbsp;&nbsp;
						 		<a  href="javascript:comment(<?php echo $restid;?>);"  title="Publish Menu"><button class="btn btn-warning" type="button" id="publishitems" title="Publish Menu Items" /><i class="fa fa-sign-out"></i> Publish Menu</button></a>
								<a href="<?php echo base_url();?>admin/menu/download/<?php echo $restid;?>" target="_blank"  title="Download Menu"><button class="btn btn-info" type="button" id="downloaditems" title="Download Menu Items" /><i class="fa fa-download"></i> Download Menu</button></a>
							</div>
							<?php } else { ?>
								<i class="fa fa-exclamation-circle"></i>	No Data Found For This Restaurant..
							<?php } ?>
					    	</div>
					    </div>
					</form>
					<?php if ($group != null) {?>	
					<div id="maincat_tab<?php echo $i;?>" class="tab-pane newItemForm" style="display:none;">
					<?php } else { ?>
					<div class="tab-pane newItemForm" id="maincat_tab<?php echo $i;?>" style="display:none;">
					<?php } ?>
						<form id="newsection">
							<input type="hidden" id="tabvar" name="tabvar" value="<?php echo $i+1;?>" />
						<fieldset>
							<dl>
							<dt><label for="type">Create a new section:</label><br/><span>Here you can create a new main category or category for a menu</span></span></dt>
							<dd><input type="radio" class="radio" class="section" name="section" value="1" checked/> New Main Category &nbsp;&nbsp;
							</dl>
							<div id="newmaincategories" style="margin-top:10px;;border-top:dotted #EFEFEF;">
								<form id="newmcatform" class="validateDontSubmit">
								<input type="hidden" name="restid" value="<?php echo $restid;?>" />
								<dl>
									<dt><label for="newmname">Main Category Name:</label> </dt>
									<dd><input type="text" name="newmname" value="" required="required"></input></dd>
								</dl>
								<dl>
									<dt><label for="newmimage">Main Category image:</label></dt>
									<dd><input style='margin: 0px; width: 120px;' type="file" name="newmimage" ></input></dd>
								</dl>
								<dl>
									<dt><label for="type">Main category sort order:</label></dt>
									<dd><input  type="number" style='margin: 0px; width: 60px;' name="newmsortorder" value="1" required="required"></input></dd>
								</dl>
								<dl>
									<dt><label for="type">Main Category Description:</label></dt>
									<dd><label><textarea style="margin: 0px; width: 250px;" name="newmdescription" rows="4" cols="50" ></textarea></label></dd>
								</dl>
								<p class="submit-buttons">
									<input class="btn blue" type="submit" id="addmaincategory" value="Add" />&nbsp;
								</p>
								</form>
							</div>
							<div id="newcategories" style="margin-top:10px;;border-top:dotted #EFEFEF;display:none">
								<form id="newcatform" class="validateDontSubmit">
								<input type="hidden" name="new_menu_mcat_id" id="new_menu_mcat_id" value="">
								<dl>
									<dt><label for="msearch">Main category search:</label> </dt>
									<dd><input type="text" name="msearch" id="msearch" size='70' value="" required="required"></input></dd>
								</dl>
								<dl>
									<dt><label for="newcname">Category Name:</label> </dt>
									<dd><input type="text" name="newcname" value="" size='70' required="required"></input></dd>
								</dl>
								<dl>
									<dt><label for="newcimage">Category image:</label></dt>
									<dd><input style='margin: 0px; width: 120px;' type="file" name="newcimage" ></input></dd>
								</dl>
								<dl>
									<dt><label for="newcsortorder">Category sort order:</label></dt>
									<dd><input type="number" style='margin: 0px; width: 60px;' name="newcsortorder" value="1" required="required"></input></dd>
								</dl>
								<dl>
									<dt><label for="newcdescription">Category Description:</label></dt>
									<dd><label><textarea style="margin: 0px; width: 250px;" id="newcdescription" name="newcdescription" rows="4" cols="50" ></textarea></label></dd>
								</dl>
								<p class="submit-buttons">
									<!-- <input class="btn blue" type="submit" id="addcategory" value="Add" />&nbsp; -->
									<button class="btn blue" type="submit" id="addcategory" title="Add Category" /><i class="fa fa-plus"></i> Add Category</button>
									
								</p>
								</form>
							</div>
							<div id="newitems" style="margin-top:10px;;border-top:dotted #EFEFEF;display:none">
								<form id="newitemform" class="validateDontSubmit">
								<button class="additem btn green btn-sm" title="Add Item"><i class="fa fa-plus"> Add Item</i></button>
								<button class="removeitem btn red btn-sm" title="Remove Item"><i class="fa fa-trash-o"> Remove Item</i></button>
								<table >
								<thead>
									<th style="text-align: center;width:32px;">Item Name</th>
									<th style="text-align: center">Size</th>
									<th style="text-align: center">Description</th>
									<th style="text-align: center">Price</th>
									<th style="text-align: center">Vat Tax</th>
									<th style="text-align: center">Ser. Tax</th>
									<th style="text-align: center">Start Time</th>
									<th style="text-align: center">End Time</th>
									<th style="text-align: center">Calories</th>
									<th style="text-align: center">Packaging</th>
									<th style="text-align: center">Start Date</th>
									<th style="text-align: center">End Date</th>
									<th style="text-align: center">Options</th>
									<th style="text-align: center">POS ID</th>
									<th style="text-align: center">Image</th>
								</thead>
								<tr class="row2" >
									<input type="hidden" name="catid[]" id="new_menu_cat_id" value=""/>
									<input type="hidden" name="has_options[]" value="0"/>
									<td class="username-coloured"><input type="text" name="name[]" value="" required="required"/></td>
									<td class="username-coloured"><input type="text" name="size[]" size="2" value="standard" style="width:80px;"/></td>
									<td class="username-coloured"><textarea style="margin: 0px; width: 160px; height: 50px;" name="desription[]" rows="5" cols="50"></textarea></td>
									<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="price[]" value="0" required="required"/></td>
									<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="vat_tax[]" value="0" /></td>
									<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="service_tax[]" value="0" /></td>
									<td class="username-coloured"><input type="text" name="start_time[]" size="1" value="00:00" required="required"/></td>
									<td class="username-coloured"><input type="text" name="end_time[]" size="1" value="23:59" required="required"/></td>
									<td class="username-coloured"><input type="text" style="margin: 0px; width: 60px;" name="color[]" value="" /></td>
									<td class="username-coloured"><input type="number" style="margin: 0px; width: 60px;" name="packaging[]" value="0" /></td>
									<td class="username-coloured"><input type="date" class="date_picker" name="start_date[]" size="3" value="<?php echo date('Y-m-d'); ?>" required="required"/></td>
									<td class="username-coloured"><input type="date" class="date_picker" name="end_date[]" size="3" value="" /></td>
									<td class="username-coloured"><input type="text" style='margin: 0px; width: 60px;' name="posItemID[]" value="" /></td>
									<td class="username-coloured"><input type="file" style='margin: 0px; width: 120px;' name="image[]" value="" /></td>
									<input type='hidden' name='is_duplicate[]' value='1'/>
								</tr>
								</table>
								<p class="submit-buttons">
									<button class="btn blue" type="submit" id="additems" title="Add Menu Items" /><i class="fa fa-plus"></i> Add Items</button>
							
								</p>
								</form>
								<button class="additem btn green btn-sm" style="float:right;" title="Add Item"><i class="fa fa-plus"> Add Item</i></button>
								<button class="removeitem btn red btn-sm" style="float:right;" title="Remove Item"><i class="fa fa-trash-o"> Remove Item</i></button>
							</div>
						</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div id="myModal" class="modal large fade" role="dialog">
	<div class="modal-dialog" style="width:90%;">
    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title" id="myTitle">Add Category</h4>
      		</div>
      		<div class="modal-body" id="upload-popup">
        		
      		</div>
    	</div>
  	</div>
</div>

<div id="catImageModal" class="modal large fade" role="dialog">
	<div class="modal-dialog" style="width:60%;">
    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title" id="myTitle">Update Category Image</h4>
      		</div>
      		<div class="modal-body" id="cat-image-upload-popup">
        		
      		</div>
    	</div>
  	</div>
</div>

<div id="uploadOptionModal" class="modal large fade" role="dialog">
	<div class="modal-dialog" style="width:60%;">
    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title" id="myTitle">Upload Options</h4>
      		</div>
      		<div class="modal-body" id="option-upload-popup">
        		
      		</div>
    	</div>
  	</div>
</div>
<div class="modal fade" id="modelComment" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background:#transparent">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" >Comment</h4>
        </div>
        <div class="modal-body" style="padding:10px" >
        <input type="hidden" id="restidc" value=""/>
          <textarea rows='5' style="width:100%" autofocus id="comment" name='comment'></textarea>
        </div>
        <div class="modal-footer" style="background-color: none">
         <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='commentAdd()'>Publish</button>
          <button type="button " class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div>
<style>
.optionselected {background-color:#e88549;}
#scrolldown , #scrollup{	color:#BDBDBD;float:right;}
#scrolldown:hover , #scrollup:hover{color:black;}
.permissions-category ul li ,.permissions-category ul li a{display:-moz-stack;display:-webkit-inline-box; width:94%;}
.permissions-panel{width:84%;}
.permissions-category{width:15%;min-width:0px;}
#tabs1 ul li{display:inline;padding:5px;border-radius: 10px;}
.editable-submit{float:left;}
.editable-cancel{margin-left:0px;}
#content{min-height:500px;}
</style>
<script src="<?php echo asset_url();?>js/bootstrapValidator.min.js"></script>
<script src="<?php echo asset_url();?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo asset_url();?>js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo asset_url();?>js/datatable.tableTools.js"></script>
<script src="<?php echo asset_url();?>js/jquery.form.js"></script>
<script src="<?php echo asset_url();?>js/jquery-ui.min.js"></script>
<link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/css/jqueryui-editable.css" rel="stylesheet"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/js/jqueryui-editable.min.js"></script>
<script>
$(function(){
	   
	 /*$.fn.editable.defaults.mode = 'inline';  
	 $('.edit-pencil').click(function(e){
	   e.stopPropagation();
      $(this).prev().children('.publicname-change').editable('toggle');
       e.stopPropagation();
	  $('.publicname-change').editable({
	         type: 'text',
	         url: '<?php echo base_url();?>admin/menu/items/editcategory',
	         ajaxOptions: {
	                       type: 'post'
	                     }   ,     
	   	     placement:'right',
	   		 title: 'Enter category name name'    
	});
	
	$( ".editable-submit" ).empty();
	$( ".editable-cancel" ).empty();
	$( ".editable-submit" ).html("Update");
	$( ".editable-submit" ).addClass("btn btn-success btn-xs");
	$( ".editable-cancel" ).html("X");
	$( ".editable-cancel" ).addClass("btn btn-danger btn-xs");
	$(".editable-input input").addClass("form-control");

});*/
	 
	/*$('.edit').click(function(e){   
	       e.stopPropagation();
           $('.publicname-change').editable({
	         type: 'text',
	         url: '<?php echo base_url();?>admin/menu/items/editcategory',
	         ajaxOptions: {
	                       type: 'post'
	                     }   ,     
	   	     placement:'right',
	   		 title: 'Enter category name name'    
	});
	
	$( ".editable-submit" ).empty();
	$( ".editable-cancel" ).empty();
	$( ".editable-submit" ).html("Update");
	$( ".editable-submit" ).addClass("btn btn-success btn-xs");
	$( ".editable-cancel" ).html("X");
	$( ".editable-cancel" ).addClass("btn btn-danger btn-xs");
 
	
});*/

$.ui.accordion.prototype._keydown = function( event ) {
    // your new code for the "_keydown" function
};
	 
	/*---- Main Menu Edit  */

$('.tabbg').click(function(e){    
	       e.stopPropagation();
	  	 $('.editable1').editable({
	   							 type: 'text',
	 						     url: '<?php echo base_url();?>admin/menus/menu/editmaincategory',
	    	ajaxOptions: {
	        type: 'post'
	   					 }   ,     
	   		 placement: 'top',
	  		  title: 'Enter Main category  name'    
		});
	 
	$( ".editable-submit" ).empty();
	$( ".editable-cancel" ).empty();

	$( ".editable-submit" ).html("OK").css("margin-left","0px");
	$( ".editable-cancel" ).html("<b style='color:red;'>X</b>").css("margin-left","0px");
	});

	/*--- Main Menu Edit Close ----*/
});

$(function() {
   $( "#tabs1" ).tabs();
 /* jquery scroll down and scroll up */
$('#scrollup').on("click",function(){
    var percentage = 100;
    var height = $(document).height();
    var remove = +height / +100 * +percentage;
    var spaceFromTop = +height - +remove;
    $('html,body').animate({ scrollTop: spaceFromTop }, 'slow', function () {
    });
});
$('#scrolldown').on("click",function() {
  var window_height = $(window).height();
    var document_height = $(document).height();
    $('html,body').animate({ scrollTop: window_height + document_height }, 'slow', function () {
                              });
});	

/* end jquery scroll up and s*/ 	
$('.expand').click(expandAll);

  $(".portlet-title h2").on('keydown', function (e) {
        e.stopPropagation();
    })
    
/* -  Main category Sorting  */    

$( "#maincategory" ) .sortable({
axis: "y",
handle: "li",
update : function () {

               var maincatid = [];
               var sortorder=[];
                var menu_id=  $("#restid").val();
                var j=1;
                $('#maincategory .maincatloop').each(function() {    

                    var id  = $(this).attr("id");
                    maincatid.push(id);
                    sortorder.push(j);
                 //   alert("id:"+id+"order:"+j);
                    j++;
                });
                  $.post("<?php echo base_url();?>admin/menus/menu/edit_maincat_sort_order",{maincatid:maincatid,sortorder:sortorder,menu_id:menu_id},function(data){});
            
  }
						}); 


/*- END  Main category Sorting--*/   
/*- Item Sorting -- */


/*--End Item Sorting--------- */
});

/*       END FUNCTION  */   
 /*
$(document).ready(function() {
 	$( ".date_picker" ).datepicker({ dateFormat: "yy-mm-dd" }); 
 	$(".ui-icon-circle-triangle-e").empty();
  	$(".item_list").dataTable( {
        "processing": true,
        "iDisplayLength": 15,
        "serverSide": true
   	});
  
});
    */
    

var active_pmask = '0';
var active_fmask = '0';
var active_cat = '0';
var id = '000';
var date = '<?php echo date('Y-m-d');?>';

$('.selectall').click(function(){
	var id = this.id.split("_")
	if($( this ).is( ':checked' ))
	{
		$("#category"+id[1]+" input[name^=itemid]").attr('checked', true);
	}else {
		$("#category"+id[1]+" input[name^=itemid]").attr('checked', false);	
	}
});

$(".highlight").click(function() {
	$("td").removeClass("optionselected");
	$(this).parent().addClass("optionselected");
});

$(document).on('submit','.validateDontSubmit',function (e) {
    //prevent the form from doing a submit
    e.preventDefault();
    return false;
})

function expandAll() {
    $('.accordion h3 ').removeClass('ui-state-default')
        .addClass('ui-state-active')
        .removeClass('ui-corner-all')
        .addClass('ui-corner-top')
        .attr('aria-expanded', 'true')
        .attr('aria-selected', 'true')
        .attr('tabIndex', 0)
    .find('span.ui-icon')
        .removeClass('ui-icon-triangle-1-e')
        .addClass('ui-icon-triangle-1-s')
    .closest('h3').next('div')
        .show();

    $('.expand').text('Collapse all').unbind('click').bind('click', collapseAll);

    $('.accordion h3 ').bind('click.collapse', function() {
        collapseAll();
        $(this).click();
    });
}

function collapseAll() {
    $('.accordion h3 ').unbind('click.collapse');

    $('.accordion h3 ').removeClass('ui-state-active')
            .addClass('ui-state-default')
            .removeClass('ui-corner-top')
            .addClass('ui-corner-all')
            .attr('aria-expanded', 'false')
            .attr('aria-selected', 'false')
            .attr('tabIndex', -1)
        .find('span.ui-icon')
            .removeClass('ui-icon-triangle-1-s')
            .addClass('ui-icon-triangle-1-e')
        .closest('h3').next('div')
            .hide();

    $('.expand').text('Expand all').unbind('click').bind('click', expandAll);

    $('.accordion').accordion('destroy').accordion({ header: "> div > h3",autoHeight:false,collapsible: true ,active: false, navigation: true ,heightStyle: "content" });
}

/*  */

$("#newsection").on("click","#addmaincategory",function(e) {
	var $myForm = $(this).closest('form');
	if ($myForm[0].checkValidity()) {
		e.preventDefault();
		showLightbox_lf(this); 
		$.ajax({
	    	type: "POST",
	    	url: "<?php echo base_url();?>admin/menus/menu/addmaincategory",
	    	data: $("#newsection").find("#newmaincategories input").serialize(),	
	    	dataType: "json",
	    	success: function(request){
	    		hideLightbox_lf();
	    		$("#newmaincategories").fadeOut();
	    		$("#newcategories").fadeIn();
	    		$("#new_menu_mcat_id").val( request.id );
	    		$("#msearch").val(request.name);
	            tabs=$("#tabvar").val();  	
	            restid=$('#restid').val();
		        swap_options('0', '0', tabs, false);
		         return false 
		    },
	    	error: function(request, errorType, errorThrown){
		    }
		});
	}
});

$("#newsection").on("click","#addcategory",function(e) {
	 var $myForm = $(this).closest('form');
	if ($myForm[0].checkValidity()) {
		e.preventDefault();
		showLightbox_lf(this); 
		$.ajax({
	    	type: "POST",
	    	url: "<?php echo base_url();?>admin/menus/menu/addcategory",
	    	data: $("#newsection").find("#newcategories input").serialize(),	
	    	dataType: "json",
	    	success: function(request){
	    		hideLightbox_lf();
	    		$("#newcategories").fadeOut();
	    		$("#new_menu_cat_id").val( request.id );
	    		$("#newitems").fadeIn();
		    },
	    	error: function(request, errorType, errorThrown){
		    }
		});
	}
});

$("#newsection").on("click","#additems",function(e) {
	var $myForm = $(this).closest('form');
	if ($myForm[0].checkValidity()) {
		e.preventDefault();
		showLightbox_lf(this); 
		$.ajax({
	    	type: "POST",
	    	url: "<?php echo base_url();?>admin/menus/items/additems",
	    	data: $("#newsection").find("#newitems input").serialize()+"&restid=<?php echo base_url();?>&output=json",	
	    	dataType: "json",
	    	success: function(request){
	    		hideLightbox_lf();
	    		alert('items added');
	    		window.location.href = '<?php echo base_url();?>admin/menus/items/update?restid=<?php echo $restid;?>';
		    },
	    	error: function(request, errorType, errorThrown){
		    }
		});
	}
});


$('input[name="section"]:radio' ).change(function() {
	if(this.value == 1)
	{
		$("#newmaincategories").fadeIn();
		$("#newcategories").fadeOut();
	}else {
		$("#newmaincategories").fadeOut();
		$("#newcategories").fadeIn();
	}
});

$("#updateItems").on("click",".addoptions",function(e) {
	e.preventDefault();
	window.open(this.id);
});

$("#updateItems").on("click",".removeitem",function(e) {
	e.preventDefault();
	var category = this.title.split("_");
	var block = $("#"+category[0]+category[1]+" tr");
	if(block.length > 1)
		block.last().remove();
});

$("#updateItems").on("click",".additem",function(e) {
	e.preventDefault();
	
	var category = this.title.split("_");
	var html = "<tr class='row2'><input type='hidden' name='catid[]' value='"+category[1]+"'/><input type='hidden' name='has_options[]' value='0'/><input type='hidden' name='option_id[]' value=''>"+
	"<input type='hidden' name='itemid[]'  value='0'/>"+
	"<td style='text-align: center;' ><p class='removenew' style='text-align:center;cursor:pointer;' title='Remove Item'><i class='fa fa-trash-o'></i></p></td>"+
	"<td class='username-coloured'><input type='text' name='name[]' id='name' value='' required='required' class='form-control' style='width:200px;'/></td>"+
	"<td class='username-coloured'><input type='text' name='sort[]' id='sortorder' value='1' size='2' class='form-control' style='width:60px;'/></td>"+
	"<td class='username-coloured'><input type='text' name='size[]' id='size' size='2' value='standard' class='form-control' style='width:80px;'/></td>"+
	"<td class='username-coloured'><textarea style='margin: 0px; width: 140px; height: 50px;' name='desription[]' rows='5' cols='50' class='form-control'></textarea></td>"+
	"<td class='username-coloured'><input type='number' style='margin: 0px; width: 60px;' name='price[]' value='0' required='required' class='form-control'/></td>"+
	"<td class='username-coloured'><input type='number' style='margin: 0px; width: 60px;' name='vat_tax[]' value='0' class='form-control'/></td>"+
	"<td class='username-coloured'><input type='number' style='margin: 0px; width: 60px;' name='service_tax[]' value='0' class='form-control'/></td>"+
	"<td class='username-coloured'><input type='text' showMeridian='false'  name='start_time[]' size='4' value='00:00:00' required='required' class='form-control'/></td>"+
	"<td class='username-coloured'><input type='text' showMeridian='false' name='end_time[]' size='4' value='23:59:00' required='required' class='form-control'/></td>"+
	"<td class='username-coloured'><input type='text' style='margin: 0px; width: 80px;' name='color[]' value='' class='form-control'/></td>"+
	"<td class='username-coloured'><input type='number' style='margin: 0px; width: 50px;' name='packaging[]' value='0' class='form-control'/></td>"+
	"<td class='username-coloured'><input type='text' class='date_picker form-control' name='start_date[]' size='6' value='"+date+"' required='required'/></td>"+
	"<td class='username-coloured'><input type='text' class='date_picker form-control' name='end_date[]' size='6' value='' /></td>"+
	"<td class='username-coloured'>New Item</td>"+
	"<td class='username-coloured'><input type='file' style='margin: 0px; width: 120px;' name='image[]' /></td><input type='hidden' name='is_duplicate[]' value='0'/></tr>";
	$("#"+category[0]+category[1]).append(html);    
	 $( ".date_picker" ).datepicker({ dateFormat: "yy-mm-dd" }); 
	 
	 
	/*var r_options = {
					script:function (input) { return "{/literal}{$site_url}{literal}index.php/menus/menu/search_items/?json=true&type=restaurant&menu=1&q="+input+"&" },	
			varname:"q",json:true,shownoresults:true,noresults:"No Results",maxresults:8,cache:true,timeout:100000,minchars:3,
			callback: function (obj) {
				var html = "Name: "+obj.name+"<br>Main Text : " + obj.name + "<br>Info : " + obj.name;;
				$('#input_search_all_response').html(html).show() ;
			
			}
		};
	var as_json = new bsn.AutoSuggest('name', r_options);*/
});
    jQuery(document).ready(function() {       
     
       //    App.init();
       //    ComponentsPickers.init();
        });   
 
//$('.time_picker').timepicker();
$(".removenewitem").on("click",function(e) {
	e.preventDefault();
	var category = this.title.split("_");
	var block = $("#newitems").find("table tr");
	if(block.length > 1)
		block.last().remove();
});

$(document).on("click",".removenew",function(e){
	e.preventDefault();
	$(this).closest("tr").remove();
});
	
$(".addnewitem").on("click",function() {
	
	var table = $("#newitems").find("table");
	$newitem = table.find("tr:last").clone();
	 
	$newitem.find("input[name*='start_date']").val(date);
	table.append($newitem);
});

 

$("#updateItems").on("click",".duplicateitem",function(e) {
	e.preventDefault();
	var section = this.id.split("#");
	var category = section[1].split("_");
	var table = $("#"+category[0]+category[1]);
	$newitem = table.find("#"+section[0]).clone();
	$newitem.find("input[name*='start_date']").val(date);
	$newitem.find("input[name*='is_duplicate']").val("1");
	$newitem.find(".duplicateitem").empty();
	$newitem.find(".duplicateitem").addClass("delete");
	$newitem.find(".delete").removeClass('duplicateitem');
	$newitem.find(".delete").html("<p class='removenew' style='text-align:center;' title=''><i class='fa fa-trash-o'></i></p>");
	table.append($newitem);
	$( ".date_picker" ).datepicker({ dateFormat: "yy-mm-dd" }); 
	
});



var i=0;
$( ".accordion" ).accordion({ header: "> div > h3",autoHeight:false,collapsible: true , navigation: true ,heightStyle: "content" });
$(".accordion").each(function(){
	$( "#"+$(this).attr('id')).sortable({axis: "y",handle: "h3", update : function () {
               var catid = [];
               var sortorder=[];
               var menu_id=  $("#restid").val();
               var j=1;
               $('#'+$(this).attr('id')+' div h3').each(function() {    
                    var id  = $(this).attr("id");
                    catid.push(id);
                    sortorder.push(j);
                    j++;
                });
              $.post("<?php echo base_url();?>admin/menu/editsortorder",{catid:catid,sortorder:sortorder,restid:menu_id},function(data){
              });
            }
          ,stop: function () {
            i=1
            $('#'+$(this).attr('id')+' div h3').each(function() {    
            $("#cat"+$(this).attr('id')).html(i);
            i++;
          });
       }
 	});
		i++;
});				

$(document).ready(function()
{
$('.itemimage').on('change', function()
{
$("#preview").html('');
$("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
 
id='.imageform_'+$(this).attr('id');
iid=$(this).attr('id');
$(id).ajaxForm(

//$this.$(".imageform").ajaxForm(
{
target: '#preview_'+iid
}).submit();
});

	$('.deleteimage').click(function(){
	$(this).closest('.deleteForm').ajaxForm(
		{
		target:$(this).closest('td')
		}).submit();


	});
	
});   
function publishMenu(restid) {
	$.get(base_url+"admin/menu/publish/"+restid,{},function(data) {
		alert(data.msg);
	},'json');
}
function commentAdd()
{
	if($('#comment').val()!='')
	{	
		$.get(base_url+"admin/menu/publish",{restid:$('#restidc').val(),comment:$('#comment').val()},function(data) {
			alert(data.msg);
		},'json');
	}
	else
	{
		alert(' Please Add comment then Action is completed ');
	    
	}
}
function comment(restid)
{
	$('#modelComment').modal({
        backdrop: 'static',
        keyboard: false
    });
   $('#restidc').val(restid);
}
function load_A()
{
    restid=$("#restid").val();
    menuid=$("#restid").val();
    page="<?php echo base_url();?>admin/menus/items/end_date_items?menu_id="+restid+"&restid="+restid
    parsedhtml='<object type=text/html data="'+page+'"style="width:100%;height:800px"><\/object>';
  
    document.getElementById("tabs-2").innerHTML=parsedhtml;
}

function addNewCategory(id,restid,catname) {
	$.get(base_url+"admin/menu/items/new_menu",{ id:id, restid: restid, catname:catname},function(data){
		$("#upload-popup").html(data);
		//$("h4#myTitle").html(name);
		$( ".date_picker" ).datepicker({ dateFormat: "yy-mm-dd" });
		$('#newMenuAdd').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().next('.messageContainer');
		   	},
		    feedbackIcons: {
		        validating: 'glyphicon glyphicon-refresh'
		    },
		    excluded: ':disabled',
		    fields: {
		    	newcname: {
		            validators: {
		                notEmpty: {
		                    message: 'Category Name is required and cannot be empty'
		                }
		            }
		        },
		        newcsortorder: {
		            validators: {
		                notEmpty: {
		                    message: 'Category SortOrder is required and cannot be empty'
		                },
		                numeric: {
		                    message: 'Invalid Sort Order',
		                }
		            }
		        },  
		        newcimage: {
		            validators: {
		                file: {
		                	extension: 'jpeg,jpg,png,gif',
		                    type: 'image/jpeg,image/png,image/gif,image/jpg',
		                    maxSize: 2097152,   // 2048 * 1024
		                    message: 'The selected file is not valid'
		                }
		            }
		        }
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			AddMenuCategory();
		});
	},'html');
}

function AddMenuCategory() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showAddRequest,
	 		success :  showAddResponse,
	 		url : base_url+'admin/menu/items/addcategory',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#newMenuAdd').ajaxSubmit(options);
}

function showAddRequest(formData, jqForm, options){
	$("#messageContainer").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showAddResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#messageContainer").removeClass('alert-success');
       	$("#messageContainer").addClass('alert-danger');
		$("#messageContainer").html(resp.msg.name);
		$("#messageContainer").show();
  	} else {
  		$("#messageContainer").removeClass('alert-danger');
        $("#messageContainer").addClass('alert-success');
        $("#messageContainer").html(resp.msg);
        $("#messageContainer").show();
        alert(resp.msg);
        $("#newMenuAdd").fadeOut();
		$("#popup_menu_cat_id").val( resp.id );
		$("#popupnewitems").fadeIn();
		$("#popupitemtable").dataTable();
  	}
}

function editCategory(catid) {
	$("#edit-form"+catid).show();
	$("#edit-cat"+catid).hide();
}

function displayCategory(catid) {
	$("#edit-form"+catid).hide();
	$("#edit-cat"+catid).show();
}

function updateCategory(catid) {
	$.post(base_url+"admin/menu/items/editcategory",{id:catid, name:$("#edit_cat_name"+catid).val(), sortorder:$("#cat"+catid).text()},function(data){
		if(data.status == 1) {
			alert(data.msg);
			$("#edit-form"+catid).hide();
			$("#edit-cat"+catid).show();
			$("#edit-cat"+catid+" a").html($("#edit_cat_name"+catid).val());
		}
	},'json');
}

function updateCategoryImage(id) {
	$.get(base_url+"admin/menu/items/editcategoryimage",{ id:id },function(data){
		$("#cat-image-upload-popup").html(data);
		$('#catImageUpdate').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().next('.messageContainer');
		   	},
		    feedbackIcons: {
		        validating: 'glyphicon glyphicon-refresh'
		    },
		    excluded: ':disabled',
		    fields: {
		        cat_image: {
		            validators: {
		                file: {
		                	extension: 'jpeg,jpg,png,gif',
		                    type: 'image/jpeg,image/png,image/gif,image/jpg',
		                    maxSize: 2097152,   // 2048 * 1024
		                    message: 'The selected file is not valid'
		                }
		            }
		        }
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			UpdateMenuCategoryImage();
		});
	},'html');
}

function UpdateMenuCategoryImage() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showImageRequest,
	 		success :  showImageResponse,
	 		url : base_url+'admin/menu/items/updatecategoryimage',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#catImageUpdate').ajaxSubmit(options);
}

function showImageRequest(formData, jqForm, options){
	$("#messageContainer").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showImageResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#imgresponse").removeClass('alert-success');
       	$("#imgresponse").addClass('alert-danger');
		$("#imgresponse").html(resp.msg.name);
		$("#imgresponse").show();
  	} else {
  		$("#imgresponse").removeClass('alert-danger');
        $("#imgresponse").addClass('alert-success');
        $("#imgresponse").html(resp.msg);
        $("#imgresponse").show();
        alert(resp.msg);
        window.location.href = base_url+"admin/menu/edit/<?php echo $restid;?>"; 
  	}
}

function getUploadOptionForm(restid,option_id,size) {
	$.get(base_url+"admin/menu/items/viewuploadform",{ restid:restid, option_id:option_id, size:size },function(data){
		$("#option-upload-popup").html(data);
		$('#optionsUploadFrm').bootstrapValidator({
			container: function($field, validator) {
				return $field.parent().next('.messageContainer');
		   	},
		    feedbackIcons: {
		        validating: 'glyphicon glyphicon-refresh'
		    },
		    excluded: ':disabled',
		    fields: {
		    	menu: {
		            validators: {
		                notEmpty: {
		                    message: 'The Upload File is required and cannot be empty'
		                },
		                file: {
		                    extension: 'xls',
		                    type: 'application/vnd.ms-excel',
		                    maxSize: 2097152,   // 2048 * 1024
		                    message: 'Please select .xls file only'
		                }
		            }
		        }
		    }
		}).on('success.form.bv', function(event,data) {
			// Prevent form submission
			event.preventDefault();
			UploadMenuOptions();
		});
	},'html');
}

function UploadMenuOptions() {
	var options = {
	 		target : '#response', 
	 		beforeSubmit : showOptionRequest,
	 		success :  showOptionResponse,
	 		url : base_url+'admin/menu/items/uploadoption',
	 		semantic : true,
	 		dataType : 'json'
	 	};
   	$('#optionsUploadFrm').ajaxSubmit(options);
}

function showOptionRequest(formData, jqForm, options){
	$("#messageContainer").hide();
   	var queryString = $.param(formData);
	return true;
}
   	
function showOptionResponse(resp, statusText, xhr, $form){
	if(resp.status == '0') {
		$("#optionresponse").removeClass('alert-success');
       	$("#optionresponse").addClass('alert-danger');
       	var errors = resp.error_msg.errors;
       	var errorMessage = "<ul>";
       	$.each(errors,function( index, error ) {
       		errorMessage = errorMessage + "<li>"+error+"</li>";
		});
       	errorMessage = errorMessage + "</ul>";
       	$("#optionresponse").html(errorMessage);
		$("#optionresponse").show();
  	} else {
  		$("#optionresponse").removeClass('alert-danger');
        $("#optionresponse").addClass('alert-success');
        $("#optionresponse").html(resp.msg);
        $("#optionresponse").show();
        alert(resp.msg);
  	}
}
</script>