<style>
.scrolloff {
    pointer-events: none;
}
</style>
<div style="padding-top:10px;" style="margin-top:70px;">
	<h2 class="text-center">CONTACT US</h2>
	<br>
</div>
<div id="map-overlay" data-wow-delay=".1s" style="width: 100%;" class="wow fadeIn">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.092182262313!2d73.79287911431993!3d18.569882372512154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTjCsDM0JzExLjYiTiA3M8KwNDcnNDIuMiJF!5e0!3m2!1sen!2sin!4v1483783776811" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen class="scrolloff" id="map-new"></iframe>
</div>
<br><br>
<div class="container">
	<div class="row">
		<div class="col-sm-6">
			<div class="">
				<h2 class="text-left">Our Location</h2>
				<div style="font-size:16px;line-height:28px;">
					Spoonbell <br>
					Spoonbell Food Solutions Pvt Ltd<br>
					Regd Office: 4 Jeevan Shree, Pimpri, Pune-17<br>
					Branches-Aundh, Pimple Saudagar,Baner, Wakad<br>
					<br>
					<b>Telephone:</b>
					+91 78880 47755
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div><h2>Submit Enquiry</h2></div>
			<form action="">
				<div class="row" style="padding:0px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="name" class="control-label">Name</label>
                       		<input type="text" name="contact_name" id="contact_name" class="form-control" value=""/>
                  		</div>
                  		<div class="messageContainer"></div>
              		</div>
              	</div>
              	<div class="row" style="padding:0px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="name" class="control-label">Email</label>
                       		<input type="text" name="contact_email" id="contact_email" class="form-control" value=""/>
                  		</div>
                  		<div class="messageContainer"></div>
              		</div>
              	</div>
              	<div class="row" style="padding:0px">
              		<div class="col-xs-12">
                  		<div class="form-group">
                       		<label for="name" class="control-label">Enquiry</label>
                       		<textarea name="contact_message" id="contact_message" class="form-control"></textarea>
                  		</div>
                  		<div class="messageContainer"></div>
              		</div>
              	</div>
              	<div class="row">
              		<div class="col-xs-12">
              			<button type="submit" class="btn btn-primary" >SUBMIT</button>
              		</div>
              	</div>
			</form>
			<br>
		</div>
	</div>
</div>
<br>
<br>
<script type="text/javascript">
$('#contact_frm').bootstrapValidator({
	container: function($field, validator) {
		return $field.parent().next('.messageContainer');
   	},
    feedbackIcons: {
        validating: 'glyphicon glyphicon-refresh'
    },
    excluded: ':disabled',
    fields: {
        contact_name: {
            validators: {
                notEmpty: {
                    message: 'Your name is required'
                }
            }
        },
        contact_email: {
            validators: {
            	notEmpty: {
                    message: 'Email is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                    message: 'The value is not a valid email address'
                }
            }
        },
        contact_mobile: {
            validators: {
            	notEmpty: {
                    message: 'Mobile is required and cannot be empty'
                },
                regexp: {
                    regexp: '^[7-9][0-9]{9}$',
                    message: 'Invalid Mobile Number'
                }
            }
        },
        contact_message: {
            validators: {
                notEmpty: {
                    message: 'Message is required'
                },
            }
        },
    }
}).on('success.form.bv', function(event,data) {
	event.preventDefault();
	contactUs();
});

function contactUs() {
	ajaxindicatorstart("Please wait.. while we submit your query...");
	$.post(base_url+"contactus",{name: $("#contact_name").val(), email: $("#contact_email").val(), mobile: $("#contact_mobile").val(), message: $("#contact_message").val()},function(data) {
		alert(data.msg);
		ajaxindicatorstop();
		$("#myModal").modal('hide');
	},'json');
}
$(document).ready(function () {
	$('#map-new').addClass('scrolloff');
    $('#map-overlay').on("mouseup",function(){
      	$('#map-new').addClass('scrolloff'); 
   	});
   	$('#map-overlay').on("mousedown",function(){
     	$('#map-new').removeClass('scrolloff');
   	});

   	$("#map-new").mouseleave(function () {
    	$('#map-new').addClass('scrolloff');
    });
});
</script>