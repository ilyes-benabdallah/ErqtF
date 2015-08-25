<?php
//include('config/db.php');
include('entete.php');
?>
<br>
<?php 
include('menuVertical.php');
?>

<div id="content">

        
        <h1>HID DTC</h1>
        <div class="product-info">
          <div class="left">
            <div class="image"><a href="uploadImagesProduits/HID DTC100001gm.jpg" title="Canon EOS 5D" class="cloud-zoom colorbox" id='zoom1' rel="adjustX: 0, adjustY:0, tint:'#000000',tintOpacity:0.2, zoomWidth:360, position:'inside', showTitle:false"><img src="uploadImagesProduits/HID DTC100001gm.jpg" width="350px;" height="320px;" title="Canon EOS 5D" alt="Canon EOS 5D" id="image" /><span id="zoom-image">
			<i class="zoom_bttn"></i> Zoom</span></a></div>
            <!--   llllllllllllllllllll   -->
			 <div class="description"> <span>Brand:</span> <a href="#">Canon</a><br />
              <span>Product Code:</span> Product 3<br />
              <span>Reward Points:</span> 200<br />
              <span>Availability:</span> In Stock</div>
            
         
       
            
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a><a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
            <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-506f325f57fbfc95"></script>
            <!-- AddThis Button END -->
          </div>
          <div class="right">
           	
		
        <!-- Description and Reviews Tab Start -->
        <div id="tabs" class="htabs"> <a href="#tab-description">Description</a> <a href="#tab-review">Caractéristiques</a> </div>
        <div id="tab-description" class="tab-content">
          <p><strong>Revolutionary multi-touch interface.</strong><br>
            iPod touch features the same multi-touch screen technology as iPhone. Pinch to zoom in on a photo. Scroll through your songs and videos with a flick. Flip through your library by album artwork with Cover Flow.</p>
          <p><strong>Gorgeous 3.5-inch widescreen display.</strong><br>
            Watch your movies, TV shows, and photos come alive with bright, vivid color on the 320-by-480-pixel display.</p>
          <p><strong>Music downloads straight from iTunes.</strong><br>
            Shop the iTunes Wi-Fi Music Store from anywhere with Wi-Fi.1 Browse or search to find the music youre looking for, preview it, and buy it with just a tap.</p>
          <p><strong>Surf the web with Wi-Fi.</strong><br>
            Browse the web using Safari and watch YouTube videos on the first iPod with Wi-Fi built in<br>
            &nbsp;</p>
        </div>
        <div id="tab-review" class="tab-content">
          <div id="review"></div>
          <h2 id="review-title">Write a review</h2>
          <br />
          <b>Your Name:</b><br />
          <input type="text" name="name" value="" />
          <br />
          <br />
          <b>Your Review:</b>
          <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
          <span style="font-size: 11px;"><span style="color: #FF0000;">Note:</span> HTML is not translated!</span><br />
          <br />
          
          
          <div class="buttons">
            <div class="right"><a id="button-review" class="button">Continue</a></div>
          </div>
        </div>
        <script>
  $(document).ready(function(){
  $('#tabs a').tabs();
  });
  </script>
        <!-- Description and Reviews Tab Start -->
          </div>
        </div>
		
	


</div>

<?php 
include('footer.php');

?>
