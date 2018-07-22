<div class="banner-images" style="margin-top:70px;">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Carousel indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>
		<!-- Wrapper for carousel items -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="<?php echo asset_url();?>images/banner/banner-1.png" width="100%" alt="Delecious Food in pune">
			</div>
			<div class="item">
				<img src="<?php echo asset_url();?>images/banner/banner-2.png" width="100%" alt="Lip smacking food">
			</div>
			<div class="item">
				<img src="<?php echo asset_url();?>images/banner/banner-3.png" width="100%" alt="Tasty food">
			</div>
			<div class="item">
				<img src="<?php echo asset_url();?>images/banner/banner-4.png" width="100%" alt="Good taste good food">
			</div>
		</div>
		<!-- Carousel controls -->
		<a class="carousel-control left" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a> <a class="carousel-control right" href="#myCarousel"
			data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	</div>
</div>
<div class="banner-images-mobile" style="margin-top:70px;">
	<div id="myCarouselMobile" class="carousel slide" data-ride="carousel">
		<!-- Carousel indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
			<li data-target="#myCarousel" data-slide-to="3"></li>
		</ol>
		<!-- Wrapper for carousel items -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="<?php echo asset_url();?>images/banner/snacks.png" width="100%" alt="Delecious Food in pune">
			</div>
			<div class="item">
				<img src="<?php echo asset_url();?>images/banner/alacarte.png" width="100%" alt="Lip smacking food">
			</div>
			<div class="item">
				<img src="<?php echo asset_url();?>images/banner/breakfast.png" width="100%" alt="Tasty food">
			</div>
			<div class="item">
				<img src="<?php echo asset_url();?>images/banner/veg-biryani.png" width="100%" alt="Good taste good food">
			</div>
		</div>
	</div>
</div>
<div class="order_now">
	<div class="col-sm-3"></div>
	<div class="col-sm-6 order_now_cover">
		<div class="row">
        	<div class="col-xs-12">
        		<div class="">
	        		<input type="text" name="location" id="location" class="form-control form-control-custom" placeholder="Enter your delivery location" value="" style="margin-bottom: 5px;"/>
	        		<input type="hidden" name="latitude" id="latitude" value="" />
	        		<input type="hidden" name="longitude" id="longitude" value="" />
	        		<a class="custom-addon btn btn-primary pull-right" id="ordernow">
                    	<b>Order Now</b>
                   	</a>
	        	</div>
        	</div>
        </div>
   	</div>
</div>
<div class="bs-example" style="background:url(<?php echo asset_url();?>images/home/texture.png);">
	<div class="container">
		<div class="row">
			<br>
			<h2 class="text-center">FEATURED CATEGORIES</h2>
			<br>
		</div>
	</div>
	<div class="category-container">
		<div class="row">
		<?php foreach ($menu as $maincategory) { ?>
			<?php foreach ($maincategory['categories'] as $key=>$category) { ?>
			<div class="col-sm-4 item-card" >
				<div class="card">
					<div class="item-image">
						<a href="<?php echo base_url();?>menu<?php if($key > 0) {?>#category<?php echo $category['id']; }?>">
						<?php if(!empty($category['image'])) { ?>
						<img src="<?php echo asset_url();?><?php echo $category['image'];?>" title="<?php echo $category['name'];?>" class=""/>
						<?php } else { ?>
						<img src="<?php echo asset_url();?>images/menu/category/img-10.jpg" title="<?php echo $category['name'];?>" class=""/>
						<?php } ?>
						<div class="category-name">
							<?php echo $category['name'];?>
						</div>
						</a>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
		</div>
	</div>
	<div id="deliveryModal" class="modal fade" role="dialog">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal">&times;</button>
	        		<h4 class="modal-title">Please tell us your delivery location</h4>
	      		</div>
	      		<div class="modal-body">
	      			<div class="row">
		        		<div class="col-xs-12">
		        			<input type="text" name="location" id="location" placeholder="Enter your delivery location" value=""/>
		        		</div>
		        		<div class="col-xs-12">
		        			&nbsp;
		        			<input type="hidden" name="latitude" id="latitude" value="" />
		        			<input type="hidden" name="longitude" id="longitude" value="" />
		        		</div>
		        		<div class="pull-right">
		        			<button type="button" class="btn btn-primary" id="ordernow">Order Now</button>
		        		</div>
		        	</div>
	      		</div>
	    	</div>
	
	  	</div>
	</div>
	
<script type="text/javascript">
	$.getScript("https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=<?php echo $google_api_key;?>&callback=initMap");
	function initMap() {
		var options = {
			types: ["geocode"],
		  	componentRestrictions: {country: 'in'}
		};
		var input =  document.getElementById('location');
		var autocomplete = new google.maps.places.Autocomplete(input,options);
		autocomplete.addListener('place_changed', function() {
			var place = autocomplete.getPlace();
		    if (!place.geometry) {
		      window.alert("Autocomplete's returned place contains no geometry");
		      return;
		    }
		    $('#latitude').val(place.geometry.location.lat());
		    $('#longitude').val(place.geometry.location.lng());
		});
	}

	$("#ordernow").click(function(){
		if($('#latitude').val() != "" && $('#latitude').val() != "") {
			$.post(base_url+"ordernow",{latitude:$('#latitude').val(), longitude:$('#longitude').val(),locality:$('#search').val()},function(data) {
				if(data.status == 1) {
					window.location.href = base_url+"menu";
				} else {
					alert("Sorry we do not deliver to your location.")
				}
			},'json');
		} else {
			alert("Please Select Delivery Location");
		}
	});

</script>