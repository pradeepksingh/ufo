<div class="class">

    <div class="maincircle">
       <div class="inner">
            <div class="circle1 circle" data-angle="0">
                <div class="row">
                   <div class="col-sm-5">
                     <img src="<?php echo asset_url();?>images/INSTALLATION_ILLUSTRATION-04.png" alt="product_img" />
                   </div>
                   <div class="col-sm-7">
                     <p>Vision turns into reality.<br>Prototype of U.F. <br>Oreceived for testing.</p>
                   </div>
                </div>
            </div>
            <div class="circle2 circle" data-angle="45">
               <div class="row">
                   <div class="col-sm-5">
                     <img src="<?php echo asset_url();?>images/INSTALLATION_ILLUSTRATION-04.png" alt="product_img" />
                   </div>
                   <div class="col-sm-7">
                     <p>Vision turns into reality.<br>Prototype of U.F. <br>Oreceived for testing.</p>
                   </div>
                </div>
            </div>
            <div class="circle2 circle" data-angle="90">
               <div class="row">
                   <div class="col-sm-5">
                     <img src="<?php echo asset_url();?>images/INSTALLATION_ILLUSTRATION-04.png" alt="product_img" />
                   </div>
                   <div class="col-sm-7">
                     <p>Vision turns into reality.<br>Prototype of U.F. <br>Oreceived for testing.</p>
                   </div>
                </div>
            </div>
            <div class="circle1 circle" data-angle="135">
              <div class="row">
                   <div class="col-sm-5">
                     <img src="<?php echo asset_url();?>images/INSTALLATION_ILLUSTRATION-04.png" alt="product_img" />
                   </div>
                   <div class="col-sm-7">
                     <p>Vision turns into reality.<br>Prototype of U.F. <br>Oreceived for testing.</p>
                   </div>
                </div>
            </div>
            <div class="circle1 circle" data-angle="180">
               <div class="row">
                   <div class="col-sm-5">
                     <img src="<?php echo asset_url();?>images/INSTALLATION_ILLUSTRATION-04.png" alt="product_img" />
                   </div>
                   <div class="col-sm-7">
                     <p>Vision turns into reality.<br>Prototype of U.F. <br>Oreceived for testing.</p>
                   </div>
                </div>
            
            </div>
            <div class="circle2 circle" data-angle="225">
               <div class="row">
                   <div class="col-sm-5">
                     <img src="<?php echo asset_url();?>images/INSTALLATION_ILLUSTRATION-04.png" alt="product_img" />
                   </div>
                   <div class="col-sm-7">
                     <p>Vision turns into reality.<br>Prototype of U.F. <br>Oreceived for testing.</p>
                   </div>
                </div>
            </div>
            <div class="circle2 circle" data-angle="270">
               <div class="row">
                   <div class="col-sm-5">
                     <img src="<?php echo asset_url();?>images/INSTALLATION_ILLUSTRATION-04.png" alt="product_img" />
                   </div>
                   <div class="col-sm-7">
                     <p>Vision turns into reality.<br>Prototype of U.F. <br>Oreceived for testing.</p>
                   </div>
                </div>
            </div>
            <div class="circle2 circle" data-angle="315">
              <div class="row">
                   <div class="col-sm-5">
                     <img src="<?php echo asset_url();?>images/INSTALLATION_ILLUSTRATION-04.png" alt="product_img" />
                   </div>
                   <div class="col-sm-7">
                     <p>Vision turns into reality.<br>Prototype of U.F. <br>Oreceived for testing.</p>
                   </div>
                </div>
            </div>
        </div>
   
    </div>
	</div>
    <script>
	
    jQuery(function($){

    	  !jQuery.easing && (jQuery.easing = {});
    	  !jQuery.easing.easeOutQuad && (jQuery.easing.easeOutQuad = function( p ) { return 1 - Math.pow( 1 - p, 2 ); });
    	  
    	  var circleController = {
    	    create: function( circle ){
    	      var obj = {
    	        angle: circle.data('angle'),
    	        element: circle,
    	        measure: $('<div />').css('width', 360 * 8 + parseFloat(circle.data('angle'))),
    	        update: circleController.update,
    	        reposition: circleController.reposition,
    	      };
    	      obj.reposition();
    	      return obj;
    	    },
    	    update: function( angle ){
    	      this.angle = angle;
    	      this.reposition();
    	    },
    	    reposition: function(){
    	      var radians = this.angle * Math.PI / 180, radius = 1700 / 2;
    	      this.element.css({
    	        marginLeft: (Math.sin( radians ) * radius - 50) + 'px',
    	        marginTop: (Math.cos( radians ) * radius - 50) + 'px'
    	      });
    	    }
    	  };
    	  
    	  var spin = {
    	    circles: [],
    	    left: function(){
    	      var self = this;
    	      $.each(this.circles, function(i, circle){
    	        circle.measure.stop(true, false).animate(
    	          { 'width': '-=45' },
    	          {
    	            easing: 'easeOutQuad',
    	            duration: 1000,
    	            step: function( now ){ circle.update( now ); }
    	          }
    	        );
    	      });
    	    },
    	    right: function(){
    	      var self = this;
    	      $.each(this.circles, function(i, circle){
    	        circle.measure.stop(true, false).animate(
    	          { 'width': '+=45' },
    	          {
    	            easing: 'easeOutQuad',
    	            duration: 1000,
    	            step: function( now ){ circle.update( now ); }
    	          }
    	        );
    	      });
    	    },
    	    prep: function( circles ){
    	      for ( var i=0, circle; i<circles.length; i++ ) {
					//alert(circle.data('angle'));
    	        this.circles.push(circleController.create($(circles[i])));
    	      }
    	    }
    	  };
    	  $(document).ready(function(){
    	  $(window).scroll(function(){ spin.left() });
    	  $(window).scroll(function(){ spin.right() });
    	     spin.prep($('.circle'));
    	  });
    	});
    </script>
 
