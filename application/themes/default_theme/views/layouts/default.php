 <?php $version = "v1.1";?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title><?php echo $template['title']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
     <meta name="description" content="<?php //echo $description;?>">
    <meta name="author" content="Brandzgarage">
	<meta name="categories" content="ngo">
	<meta name="generator" content="Brandzgarage">
	<link rel="icon" href="<?php echo asset_url();?>images/icon.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?php echo asset_url();?>images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/style.css">
	<link href="<?php echo asset_url();?>css/font.css" rel="stylesheet">
	<link href="<?php echo asset_url();?>css/<?php echo $page;?>.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo asset_url();?>js/js/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>js/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo asset_url();?>js/script.js"></script>
	
    <!--[if lt IE 9]>
 <script src="<?php echo asset_url();?>js/html5shiv.js" type="text/javascript"></script>
 <script src="<?php echo asset_url();?>js/respond.min.js" type="text/javascript"></script>
<![endif]-->
        <script type="text/javascript">
			var base_url = '<?php echo base_url(); ?>';
			var asset_url = '<?php echo asset_url();?>'; 
		</script>
	</head>
	<body>
	    <?php echo $template['partials']['header']; ?>
	    <?php echo $template['body']; ?>
		<?php echo $template['partials']['footer']; ?>
	</body>
        


<script>
<?php if($page == "home") { ?>
    var top1 = $('#home11').offset().top;
    var top2 = $('#featuredWork').offset().top;
    var top3 = $('#caseStudy').offset().top;
    var top4 = $('#forth').offset().top;
    var top5 = $('#fifth').offset().top;
    $(document).scroll(function() {
      	var scrollPos = jQuery(document).scrollTop();
      	if (scrollPos >= top1 && scrollPos < top2) {
    	  		jQuery('.container-fluid').css('background-color', '#fefefe');
    	  		jQuery('.header a').css('color', '#9d9d9d');
    	  		jQuery('.header a:hover').css('color', 'grey');
    	  		jQuery('.Buy-Now').css('color', '#4ab0e3');
    	  		jQuery('#caseStudy').css('background-color', '#fefefe');
    	  		jQuery('.desktop-pagination').css('display', 'block');
      	} else if (scrollPos >= top2 && scrollPos < top3) {
    	  		jQuery('.container-fluid').css('background-color', '#fefefe');
            jQuery('.desktop-pagination').css('display', 'block');
    	  		jQuery('.header a').css('color', '#9d9d9d');
    	  		jQuery('.header a:hover').css('color', 'grey');
			jQuery('#caseStudy').css('background-color', '#fefefe');
    	  		jQuery('.Buy-Now').css('color', '#4ab0e3');
      	} else if (scrollPos >= top3 && scrollPos < top4) {
        		jQuery('.container-fluid').css('background-color', '#000');
			jQuery('.desktop-pagination').css('display', 'block');
			jQuery('.header a').css('color', '#ffffff');
			jQuery('.header a:hover').css('color', '#f2f2f2');
        		jQuery('#caseStudy').css('background-color', '#000');
        		jQuery('.black-section').css('background-color', '#000');
        		jQuery('.Buy-Now').css('color', '#ffffff');
      	} else if (scrollPos >= top4 && scrollPos < top5) {
    	  		jQuery('.container-fluid').css('background-color', '#4ab0e6');
    	  		jQuery('.header a').css('color', '#000000');
    	  		jQuery('.header a:hover').css('color', 'grey');
    	  		jQuery('.black-section').css('display', 'none');
    	  		jQuery('.desktop-pagination').css('display', 'none');
    	  		jQuery('.Buy-Now').css('color', '#000000');
    		} else if (scrollPos >= top5) {
        		jQuery('.container-fluid').css('background-color', '#fefefe');
        		jQuery('.header a').css('color', '#9d9d9d');
        		jQuery('.header a:hover').css('color', 'grey');
			jQuery('.desktop-pagination').css('display', 'block');
        		jQuery('.Buy-Now').css('color', '#4ab0e3');
        }
    });
<?php } ?>
</script>
<script src="<?php echo asset_url();?>js/application-b0dcffe3.js"></script>
<script>
	jQuery(document).ready(function(){
          // Add smooth scrolling to all links
          jQuery(".a1").on('click', function(event) {
        
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
              	var hash = this.hash;
              	var scroll_top = 0;
              	if(hash == "#product") {
                	  	scroll_top = top3;
              	} else if(hash == "#features") {
              		scroll_top = top4;
              	} else if(hash == "#installation-1") {
              		scroll_top = top5;
              	} else {
              		scroll_top = top1;
              	}
    				jQuery('html, body').animate({
    	                scrollTop: scroll_top
    	            	}, 800, function(){
    	                // Add hash (#) to URL when done scrolling (default click behavior)
    	                window.location.hash = hash;
    	           	});
              // Using jQuery's animate() method to add smooth page scroll
              // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
              /*jQuery('html, body').animate({
                scrollTop: jQuery(hash).offset().top
              }, 800, function(){
           
                window.location.hash = hash;
              });*/
            } // End if
          });
        });
</script>

<script>
function ajaxindicatorstart(text)
{
	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
	jQuery('body').append('<div id="resultLoading" style="display:none"><div><i class="fa fa-spinner fa-5x"></i><div>'+text+'</div></div><div class="bg"></div></div>');
	}

	jQuery('#resultLoading').css({
		'width':'100%',
		'height':'100%',
		'position':'fixed',
		'z-index':'10000000',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto'
	});

	jQuery('#resultLoading .bg').css({
		'background':'#000000',
		'opacity':'0.7',
		'width':'100%',
		'height':'100%',
		'position':'absolute',
		'top':'0'
	});

	jQuery('#resultLoading>div:first').css({
		'width': '250px',
		'height':'75px',
		'text-align': 'center',
		'position': 'fixed',
		'top':'0',
		'left':'0',
		'right':'0',
		'bottom':'0',
		'margin':'auto',
		'font-size':'16px',
		'z-index':'10',
		'color':'#ffffff'

	});

    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}
function ajaxindicatorstop()
{
    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}
</script>
</html>