<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/star-rating.min.css" />
<style>
<!--
.rating-container .clear-rating {
	display:none !important;
}
.star {
	color:#fde16d;
}
.rating-md {
    font-size: 2.13em;
}
-->
</style>
<section id="content" style="margin-top:90px;min-height:500px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<div class="reviews">
 					<?php foreach ($reviews as $review) { ?>
					<div class="reviews row">
						<div class="col-sm-4">
							<?php if(!empty($review['image'])){ ?>
							<img src="<?php if(!empty($review['image'])){ echo "http://olotime.com/assets/".$review['image'];}?>" alt="" class="img-responsive"/>
							<?php } else { ?>
							<img src="<?php echo asset_url();?>images/user/avatar.png" alt="" class="img-responsive"/>
							<?php } ?>
						</div>
						<div class="col-sm-8">
							<div class="row">
								<div class="col-md-12 col-sm-8">
									<h3><?php echo $review['name'];?></h3>
									<div class="meta">
										<span>
										<?php $total_rating = ceil($review['rating']);?>
										<?php for ($i=1;$i<=$total_rating;$i++) { ?>
											<i class="fa fa-star fa-lg" style="color:#fde16d;"></i> 
										<?php } ?>
										<?php for ($i=1;$i<=(5-$total_rating);$i++) { ?>
											<i class="fa fa-star-o fa-lg" style="color:#fde16d;"></i> 
										<?php } ?>
										</span>
										<span style="margin-left:10px;"><i class="fa fa-clock-o fa-lg"></i> <?php echo date('j M Y h:i A',strtotime($review['review_on']));?></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<p>
										<?php echo $review['review'];?>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
						<hr>
						</div>
					</div>
 					<?php } ?>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="widget">
					<form role="form">
						<div class="panel panel-default">
							<div class="panel-heading"><h3>Rate & Review Us</h3></div>
							<?php 
			                     if(!empty($olouserid)) { 
			               	?>
							<div class="panel-body">
					        	<div class="rating-stars-area">
					        		<input type="hidden" name="rating_restid" id="rating_restid" value="1"/>
					        		<input type="hidden" name="rating_userid" id="rating_userid" value="<?php echo $olouserid;?>"/>
					        		<input type="hidden" name="rating_value" id="rating_value" value=""/>
					        		<div class="rating-head">Rate Us</div>
					        		<div class="rating-container-div">
					        			<input id="rating-input" name="rating-input" value="3.5" class="rating-loading">
					        		</div>
					        	</div>
					        	<div class="review-area">
					        		<div class="rating-head">Enter Your Review</div>
					        		<div>
					        			<textarea id="review" name="review" class="form-control" placeholder="Enter Your Review" rows="5"></textarea>
					        		</div>
					        	</div>
					      	</div>
					      	<div class="panel-footer">
					      		<button type="button" class="btn btn-success" id="rating_submit">Submit</button>
					        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					      	</div>
					      	<?php 
		                		} else {
		                	?>
		                		<div class="panel-body">
		                			<div class="col-sm-10">
		                				<a href="javascript:openLogin();" class="btn btn-warning">Login / SignUp To Review</a>
		                			</div>
		                		</div>
				                <?php
			                	}
			                ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo asset_url();?>js/star-rating.min.js"></script>
<script type="text/javascript">
$(document).on('ready', function(){
    $('#rating-input').rating({
        step: 1,
        starCaptions: {1: 'Very Poor', 2: 'Poor', 3: 'Average', 4: 'Good', 5: 'Very Good'},
        starCaptionClasses: {1: 'text-danger', 2: 'text-warning', 3: 'text-info', 4: 'text-primary', 5: 'text-success'}
    });
    $("#rating_value").val(2.5);
    $('#rating-input').rating().on("rating.change", function(event, value, caption) {
		$("#rating_value").val(value);
    });
});

$("#rating_submit").click(function() {
	var rflag = true;
	if($("#review").val() != "") {
		if($("#review").val().length < 80) {
			alert("Please enter review of atleast 25 characters.");
			rflag = false;
		}
	}
	if(rflag) { 
		$.post(base_url+"review/save",{restid: $("#rating_restid").val(), rating: $("#rating_value").val(), review: $("#review").val(), userid: $("#rating_userid").val()},function(data){
			alert("Thank You.");
			window.location.reload();
		},'json');
	}
});
function openLogin() {
	$("#signInModal").modal('show');
}
</script>
