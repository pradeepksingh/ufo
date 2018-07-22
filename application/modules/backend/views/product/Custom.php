<?php //print_r($customs); ?>
<?php $attr_id = 0;?>
<?php foreach ($customs as $row) {?>
<?php if($row['id'] != $attr_id) { ?>
<?php if($attr_id != 0) { ?>
</div>
<?php } ?>
<div class="maindiv" style="padding-bottom: 5%;" > 
			<div class="row custom-head panel panel-success block5" >
			   <input type="hidden" class="form-control" value="''" name="customid[]" id="custom_id[]">
			   <input type="hidden" class="form-control" placeholder="Id" name="id[]" id="id[]" value="<?php echo $row['id'];?>">
				<div class="col-md-4"> <label class="control-label">Title</label><input type="text" class="form-control" placeholder="Title" name="title[]" id="custom_title[]" value="<?php echo $row['title'];?>"></div>
			    <div class="col-md-4"><label class="control-label">is Required</label><select class="form-control" name="is_required[]" id="is_required[]"><option value="1">Yes</option><option value="0">No</option></select></div>
				<div class="col-md-4"><label class="control-label">sort order</label><input type="text" class="form-control" placeholder="" name="sort_order[]" id="sort_order[]" value="<?php echo $row['title'];?>"></div>
				</div>
				<h2>Custom Details </h2> <hr />
<?php } ?>
			<div class="row-details" id="row-details'+countHead+'">
				<div class="row" id="custom-head'+countHead+'">
				<input type="hidden" class="form-control" placeholder="Id" name="fId[]" id="fId'+countHead+'" value="<?php echo $row['id1'];?>">
				<div class="col-md-3"><label class="control-label">Title</label><input type="text" class="form-control" placeholder="Title" name="fTitle[]" id="fTitle'+countHead+'" value="<?php echo $row['title1'];?>"></div>
				<div class="col-md-3"><label class="control-label">Price</label><input type="text" class="form-control" placeholder="Price" name="fPrice[]" id="fPrice_'+countHead+'" value="<?php echo $row['price'];?>"></div>
				<div class="col-md-3"><label class="control-label">sort order</label><input type="text" class="form-control" placeholder="Sort Order" name="fsort_order[]" id="fsort_order_'+countHead+'" value="<?php echo $row['sort_order1'];?>"></div>
				<!-- <div class="col-md-3"><button class="btn btn-sm btn-success" type="button" onclick="addNewField('+countHead+')"><i class="fa fa-plus"></i></button></div>-->
				</div>
			</div>
<?php $attr_id = $row['id'];?>			
<?php } ?>
</div>