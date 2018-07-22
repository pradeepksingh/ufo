<div>
	<div id="messageContainer"></div>
	<form id="menuUpload" name="menuUpload" action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="restid" value="<?php echo $productid; ?>" />
		<input type="hidden" name="type" value="new" />
		<div class="row">
			<div class="col-lg-12 margin-bottom-5">
				<div class="form-group" id="error-cityid">
					<label class="control-label col-sm-3">Menu File <span
						class='text-danger'>*</span></label>
					<div class="col-sm-5">
						<input type="file" name="menu">
					</div>
					<div class="messageContainer col-sm-4"></div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-12 margin-bottom-5">
				<div class="form-group">
					<div class="col-sm-5">
						<button type="submit" id="upload_menu" class="btn btn-success" >Upload</button>
					</div>
				</div>
			</div>
		</div>
		<br>
	</form>
</div>
