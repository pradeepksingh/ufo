<form id="optionsUploadFrm" name="optionsUploadFrm" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="restid" value="<?php echo $restid;?>"/>
	<input type="hidden" name="option_id" value="<?php echo $option_id;?>"/>
	<input type="hidden" name="item_size" value="<?php echo $size;?>"/>
	<div id="basic" class="tab-pane fade in active">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Select File <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<input type="file" class="form-control" id="menu" name="menu" />
									</div>
									<div class="messageContainer col-sm-4"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="optionresponse"></div>
	<button type="submit" class="btn btn-success">Upload</button>
	<br> <br>
</form>