<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $template['title']; ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo asset_url();?>backend/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>backend/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">  
    <!-- Menu CSS -->
    <link href="<?php echo asset_url();?>backend/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo asset_url();?>backend/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo asset_url();?>backend/css/style.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo asset_url();?>css/selectize.bootstrap3.css">
    <!-- color CSS -->
    <link href="<?php echo asset_url();?>backend/css/colors/default.css" id="theme" rel="stylesheet">
	<script src="<?php echo asset_url();?>backend/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
		var asset_url = '<?php echo asset_url();?>'; 
	</script>
	<!-- hello  -->
   <link href="<?php echo asset_url();?>backend/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" /> 
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> 
    <!-- Menu CSS -->
</head>

<body>

	<div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	<div id="wrapper">
		<?php echo $template['partials']['header']; ?>
		<?php echo $template['partials']['leftnav']; ?>
		<?php echo $template['body']; ?>
		<?php echo $template['partials']['footer']; ?>
	</div>
	
</body>

 <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script> 
<script>
 function ajaxindicatorstart(text)
{
	if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
	jQuery('body').append('<div id="resultLoading" style="display:none"><div><div class="spinner"></div><div>'+text+'</div></div><div class="bg"></div></div>');
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



<!--<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
<script>
<?php if(!empty($page)) { ?>
var page_controller = '<?php echo $page;?>';
<?php } else { ?>
var page_controller = '';
<?php } ?>
$(document).ready(function(){
	var audioElement = document.createElement('audio');
	audioElement.setAttribute('src', '<?php echo asset_url();?>images/doorbell.wav');
	audioElement.setAttribute('type', 'audio/wav');
	audioElement.setAttribute('id','order_alert_sound');
	//audioElement.setAttribute('loop','loop');
	audioElement.load()
	audioElement.addEventListener("load", function() {
	   audioElement.play();
	   audioElement.pause();
	}, true);
	document.getElementById('zyk-root').appendChild(audioElement);
});
    Pusher.logToConsole = false;

    var pusher = new Pusher('feb80626a1c08897aa15', {
      cluster: 'ap1',
      encrypted: true
    });

	var broadcast_channel = pusher.subscribe('crm_broadcast');
	broadcast_channel.bind('crm_broadcast_event', function(data) {
		var message = data.message.split("#");
		if(message.length > 1) {
			switch(message[0]) {
				case 'neworder':
					  new_sound_alerts();
					break;
			}
		}
	});
	

	function new_sound_alerts() {
		var beep = document.getElementById('order_alert_sound');
		if(beep != null)
		beep.play();
		if(page_controller == 'porders') {
			window.location.reload();
		}
	}
</script>-->
