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
   <h1> <a href="<?php echo base_url();?>support"><img src="<?php echo asset_url();?>images/back-arrow-circular-symbol.png" alt="back" /></a>Ask a Question <img src="<?php echo asset_url();?>images/search.png" alt="back" id="search-button"/></h1>
          <form action="">
               <div class="row small-div nav1">
                <div class="col-sm-6">
                   <div class="form-group">
                     <input type="text" class="form-control" id="" placeholder="First Name" name="email">
                   </div>
                   <div class="form-group">
                     <input type="email" class="form-control" id="" placeholder="E-mail ID*" name="email">
                   </div>
                   <div class="form-group">
                     <input type="text" class="form-control" id="" placeholder="Contact No." name="email">
                   </div>
                </div>
               <div class="col-sm-6">
                 <div class="form-group">
                    <input type="text" class="form-control" id="" placeholder="Last Name" name="email">
                 </div>
               </div>
               </div>
                <div class="form-group">
                  <textarea rows="" cols="" placeholder="Submit question..."></textarea>
                </div>
                 <div class="form-group">
                    <button type="submit" class="btn btn-default submit">Submit</button>
                </div>
       </form>
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