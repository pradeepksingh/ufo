        <div class="row">
             <?php foreach($attributes as $attribute) {?>
           		<div class="col-md-6">
                  	<label><?php echo $attribute['name']; ?></label>
                         <input type="text" class="form-control" name="<?php echo "value_".$attribute['attribute_id']; ?>" value="" id="<?php echo "value_" .$attribute['attribute_id']; ?>" placeholder="<?php echo "Enter ". $attribute['name']; ?>">
                         <input type="hidden"  class="form-control" name="attribute_id[]" id="" value="<?php echo $attribute['attribute_id']; ?>"  placeholder="">
                 </div>
            <?php }?>
     	</div>                                                                              