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
   <h1> <a href="<?php echo base_url();?>support"><img src="<?php echo asset_url();?>images/back-arrow-circular-symbol.png" alt="back" /></a> Getting Started  <img src="<?php echo asset_url();?>images/search.png" alt="back" id="search-button"/></h1>
   <h2>What should i do to get started with Phynart products and services?</h2>
   <p>You will have to create a Phynart account either on the website or by downloading the app on the playstore or app store to get started to make purchases, creating an account is mandatory for you to purchase our products.</p>
   
   <h2>What should I do after the account has been created?</h2>
   <p>You can than purchase different products and have them shipped to your address, after that we will take care of everything else.</p>
   
   <h2>Do i need to buy smart appliances besides Phynart’s devices to automate my home?</h2>
   <p>Phynart’s devices are self sufficient to automate every appliance you have at home, you won’t have to spend a dime on anything else.</p>
   
   <h2>What all will be required at my end to automate my house?</h2>
   <P>You will require a wifi router with a good steady internet connection, a compatible Android phone (software version 4.0 or higher) or iPhone (software version 8.0 or higher). You may also need a wifi repeater depending on how strong the wifi signal is around your house.</P>
   
   <h2>Why the name Phynart?</h2>
   <p>Phynart is a combination of two words “Physics” and “Art”. We want to build experiences and products using the best of the two to give you the best possible combination.</p>
   
   <h3>Have a question that isn’t answered here? Send it our way and we’ll notify you as soon as we answer and post it.</h3>
    
   <button onclick="location.href = '<?php echo base_url();?>ask-a-question';" class="ask">Ask a Question</button>
   
    <h4>Was this article helpful?</h4>
    
    <h5>If you have any feedback that could help us improve this article, please leave it below.</h5>
    
    <form class="article">
      <label><input type="radio" checked value="It doesnt answer my question" name="article">It doesnt answer my question</label>
      <label><input type="radio" value="It contains incorrect info" name="article">It contains incorrect info</label>
      <label><input type="radio" value="It's confusing" name="article">It's confusing</label>
      <label><input type="radio" value="It's too much to read" name="article">It's too much to read</label>
      <label><input type="radio" value="I don't like the answer" name="article">I don't like the answer</label>
      <label><input type="radio" value="Other" name="article">Other</label>
       <div class="inline">
          <button type="submit" class="btn btn-info">Submit</button>
          <button type="submit" class="btn btn-default">Cancel</button>
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