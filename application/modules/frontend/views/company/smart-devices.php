<div class="search" id="search">
<div class="container">
   <div class="center">
     <h1>How can we help you?<img alt="cross" src="<?php echo asset_url();?>images/multiply.png" class="cross"></h1>
       <form action="">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" name="search">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><img src="<?php echo asset_url();?>images/search.png" alt="search"/></button>
          </div>
        </div>
      </form>
   </div>
 </div>
</div>
<div class="spacer">
</div>
<div class="container started">
   <h1> <a href="<?php echo base_url();?>support"><img src="<?php echo asset_url();?>images/back-arrow-circular-symbol.png" alt="back" /></a> Smart Devices  <img src="<?php echo asset_url();?>images/search.png" alt="back" id="search-button"/></h1>
  <div class="row">
      <div class="col-md-3 col-sm-3">
        <ul class="nav nav-pills smart-pills">
          <li class="active"><a data-toggle="pill" href="#home">SIRIUS</a></li>
          <li><a data-toggle="pill" href="#menu1">LUMOS</a></li>
          <li><a data-toggle="pill" href="#menu2">NOVA</a></li>  
          <li><a data-toggle="pill" href="#menu3">ELARA</a></li>
          <li><a data-toggle="pill" href="#menu4">AURORA</a></li>
        </ul>
      </div>
      <div class="col-md-9 col-sm-9">
          <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                
                 <h2>How do I register my Sirius?</h2>
                 <p>Once you have registered your UFO you will be taken to the homepage of the app, on the top left corner of the app, you will have the add device section, using which you can register your SIRIUS.</p>
   
                 <h2>What type of appliances can i control with my SIRIUS?</h2>
                 <p>The SIRIUS is specifically designed to control all your lights, fans at home, but you can also control low power appliances like your LED TV, Lamps etc</p>     
        
                 <h2>What is a dimmable and a non dimmable point on the SIRIUS?</h2>
                 <p>There are 5 load points on the SIRIUS , 2 of which are dimmable points and there are 3 non dimmable points. Using the dimmable points you can control the intensity of the light or fan’s connected to the dimmable points. For the non dimmable points you can only trigger an appliance to turn on or off.</p>
        
              </div>
              <div id="menu1" class="tab-pane fade">
                
                 <h2>How do I register my Sirius?</h2>
                 <p>Once you have registered your UFO you will be taken to the homepage of the app, on the top left corner of the app, you will have the add device section, using which you can register your SIRIUS.</p>
   
                 <h2>What type of appliances can i control with my SIRIUS?</h2>
                 <p>The SIRIUS is specifically designed to control all your lights, fans at home, but you can also control low power appliances like your LED TV, Lamps etc</p>     
        
                 <h2>What is a dimmable and a non dimmable point on the SIRIUS?</h2>
                 <p>There are 5 load points on the SIRIUS , 2 of which are dimmable points and there are 3 non dimmable points. Using the dimmable points you can control the intensity of the light or fan’s connected to the dimmable points. For the non dimmable points you can only trigger an appliance to turn on or off.</p>
        
              </div>
              <div id="menu2" class="tab-pane fade">
                
                 <h2>How do I register my Sirius?</h2>
                 <p>Once you have registered your UFO you will be taken to the homepage of the app, on the top left corner of the app, you will have the add device section, using which you can register your SIRIUS.</p>
   
                 <h2>What type of appliances can i control with my SIRIUS?</h2>
                 <p>The SIRIUS is specifically designed to control all your lights, fans at home, but you can also control low power appliances like your LED TV, Lamps etc</p>     
        
                 <h2>What is a dimmable and a non dimmable point on the SIRIUS?</h2>
                 <p>There are 5 load points on the SIRIUS , 2 of which are dimmable points and there are 3 non dimmable points. Using the dimmable points you can control the intensity of the light or fan’s connected to the dimmable points. For the non dimmable points you can only trigger an appliance to turn on or off.</p>
        
              </div> 
              <div id="menu3" class="tab-pane fade">
                
                 <h2>How do I register my Sirius?</h2>
                 <p>Once you have registered your UFO you will be taken to the homepage of the app, on the top left corner of the app, you will have the add device section, using which you can register your SIRIUS.</p>
   
                 <h2>What type of appliances can i control with my SIRIUS?</h2>
                 <p>The SIRIUS is specifically designed to control all your lights, fans at home, but you can also control low power appliances like your LED TV, Lamps etc</p>     
        
                 <h2>What is a dimmable and a non dimmable point on the SIRIUS?</h2>
                 <p>There are 5 load points on the SIRIUS , 2 of which are dimmable points and there are 3 non dimmable points. Using the dimmable points you can control the intensity of the light or fan’s connected to the dimmable points. For the non dimmable points you can only trigger an appliance to turn on or off.</p>
        
              </div>
              <div id="menu4" class="tab-pane fade">
                
                 <h2>How do I register my Sirius?</h2>
                 <p>Once you have registered your UFO you will be taken to the homepage of the app, on the top left corner of the app, you will have the add device section, using which you can register your SIRIUS.</p>
   
                 <h2>What type of appliances can i control with my SIRIUS?</h2>
                 <p>The SIRIUS is specifically designed to control all your lights, fans at home, but you can also control low power appliances like your LED TV, Lamps etc</p>     
        
                 <h2>What is a dimmable and a non dimmable point on the SIRIUS?</h2>
                 <p>There are 5 load points on the SIRIUS , 2 of which are dimmable points and there are 3 non dimmable points. Using the dimmable points you can control the intensity of the light or fan’s connected to the dimmable points. For the non dimmable points you can only trigger an appliance to turn on or off.</p>
        
              </div>
            </div>
      </div>
  </div>
</div>
<script>
$(".cross").click(function(){
    $("#search").hide();
    $(".spacer").show();
    $("#search-button").show();
});
$("#search-button").click(function(){
    $("#search").show();
    $("#search-button").hide();
    $(".spacer").hide();
});
</script>