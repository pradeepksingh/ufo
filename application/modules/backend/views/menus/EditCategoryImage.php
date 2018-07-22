<form id="catImageUpdate" name="catImageUpdate" action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="cat_id" value="<?php echo $id;?>"/>
	<div id="basic" class="tab-pane fade in active">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12 margin-bottom-5">
								<div class="form-group" id="error-name">
									<label class="control-label col-sm-3">Category Image <span class='text-danger'>*</span></label>
									<div class="col-sm-5">
										<input type="file" class="form-control" id="cat_image" name="cat_image" />
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
	<div id="imgresponse"></div>
	<button type="submit" class="btn btn-success">Upload</button>
	<br> <br>
</form>