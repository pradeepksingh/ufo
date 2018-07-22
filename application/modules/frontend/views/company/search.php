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
   <h1> “<span>UFO</span>” related articles </h1>
   
   <p>What should i do to get started with Phynart products and services?</p>
   <p>What should I do after the account has been created?</p>
   <p>Do i need to buy smart appliances besides Phynart’s devices to automate my home?</p>
   <p>What all will be required at my end to automate my house?</p>
   <p>Why the name Phynart?</p>
    
   <h3>Have a question that isn’t answered here? Send it our way and we’ll notify you as soon as we answer and post it.</h3>
   <button onclick="location.href = '<?php echo base_url();?>ask-a-question';" class="ask">Ask a Question</button>
   
    <h4>Was this article helpful?</h4>
    <form class="article">
       <div class="inline">
          <button type="submit" class="btn btn-info">Yes</button>
          <button type="submit" class="btn btn-default">No</button>
       </div>
    </form>
</div>
<script>
$(".cross").click(function(){
    $("#search").hide();
    $(".spacer").show();
});
</script>