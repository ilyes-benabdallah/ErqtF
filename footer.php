	
		</div>
	</div>
	</div>
	</div>
	<footer id="footer">
    <div class="fpart-inner">
      <div class="social-part">
        <!-- Custom Column Part Start-->
        <div class="contact contact_icon">
        <h3>Contactez nous</h3>
        <ul>
          <li class="address">Villa 183, Bois des cars 3, Dely Ibrahim ALGER ALGERIE</li>
          <li class="mobile">+213 21 336 363</li>
          <li class="mobile">+213 21 336 364</li>
          <li class="fax">+213 21 336 349</li>
          <li class="email"><a href="mailto:info@contact.com">commercial@eurequat-algerie.com</a></li>
        </ul>
      </div>
        <!-- Custom Column Part End-->
        <!-- Twitter Feeds Part Start-->
		
      
        <!-- Twitter Feeds Part End-->
        <!-- Facebook Box Part Start-->
        <div id="facebook" class="part3">
          <h3>rejoignez nous sur facebook</h3>
          <div class="line"></div>
          <div id="fb-root"></div>
          <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
          <div class="fb-like-box" data-href="https://www.facebook.com/Eurequat" data-width="322" data-show-faces="true" data-stream="false" data-header="false" data-colorscheme="dark" data-connections="16" data-color-scheme="dark" data-border-color="#222222"></div>
        </div>
        <!-- Facebook Box Part End-->
		<h3>Suivez nous</h3>
        <div class="line"></div>
	
		 <div class="social part3"> 
		<a href="https://www.facebook.com/Eurequat" target="_blank"><img src="image/facebook.png" alt="Facebook" title="Facebook"></a>  
		<a href="https://plus.google.com/u/0/111465932580254675815" target="_blank"> <img src="image/googleplus.png" alt="Google+" title="Google+"> </a> 
		<a href="http://www.youtube.com/channel/UCtz9ys57tp5ORUdIY9jYlYg" target="_blank"> <img src="image/youtube.png" alt="youtube" title="youtube"> </a> 
		<a href="https://www.linkedin.com/company/eurequat-alg-rie" target="_blank"> <img src="image/linkedin.png" alt="Google+" title="linkedin"> </a> 
		<!--a href="" target="_blank"> <img src="image/blog.png" alt="blog" title="blog"> </a--> 
		
		</div>
      </div>
  

      <!-- Contact Details End-->
      
      <div id="powered">
        <!-- Payment Images Icon Start-->
        <!-- Payment Images Icon End-->
        <!-- Powered by Text Start-->
        <div class="powered_text part3">
          <p>Eurequat Algerie ©2015 <!--a target="_blank" href="https://www.facebook.com/ilyesBenTlm"> Ilyes BENABDALLAH</a--></p>
       </div>
        <!-- Powered by Text End-->
        <!-- Follow Social Icons Start-->
       
        <!-- Follow Social Icons End-->
        <div class="clear"></div>
      </div>
      <!-- Back to Top Button Start-->
      <div class="back-to-top" id="back-top"><a title="Back to Top" href="javascript:void(0)" class="backtotop">Top</a></div>
      <!-- Back to Top Button End-->  
	 
		<div id="divfixbtn">
		
			<input  class="btnMessage button " type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;Laissez nous un message" onclick="$('#divfix').toggle('slow');" style="cursor: pointer;  background: url('image/message.jpg') left no-repeat; margin-left:0px;"/>
		</div> 
		
	 	<?php
		if(isset($_POST['env']))
		{
			$objet="pas d'objet";
			$email=$_POST['email1'];
			$msg1=$_POST['msg1'];
			if(($email=='') || ($message='')) echo ("<p class='bg-danger'>Veuillez remplir tous les champs.</p>");
			else
			{
					$entete = "MIME-Version: 1.0\r\n";
					$entete .= "Content-Type: multipart/related;\r\n";
					$entete .= "\r\n";	
					
					
					$msg = "";
					
					$msg .= "Mail: ".$email."\r\n";
					
					$msg .= "\r\n";
					$msg .= "Message: \r\n";
					$msg .= "\r\n";
					$msg .=$msg1;
			
			

			//$destinataire = "kira13_ilyes@hotmail.com";
			$destinataire = "commercial@eurequat-algerie.com";
			$expediteur   = $email;
			$reponse      = $expediteur;
	 
			mail($destinataire, $objet, $msg, "Reply-to: $reponse\r\nFrom: $expediteur\r\n".$entete);
			}
		
		}
		
		?>
	
	 <div id="divfix" style="display: none;">
	
		 <form action="#" method="POST">
			<label onclick="$('#divfix').toggle('slow');" style="cursor: pointer; float:right; margin-right:2px;">Fermer</label>
			<br>
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email(*) :</label>
			<br>
			<br>
			&nbsp;&nbsp;&nbsp;&nbsp;<input class="" name="email1" type="text" style="margin: 0px;  width: 258px;  background: rgba(255, 255, 255, 0.27); color:#fff; " placeholder="Veuillez saisier votre mail" >
			<br>
			
			<br>
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Méssage(*) :</label>
			<br>
			<br>
			&nbsp;&nbsp;&nbsp;&nbsp;<textarea id="sendFormTextarea" name="msg1" maxlength="1000" style="margin: 0px; height: 150px; width: 258px; background: rgba(255, 255, 255, 0.27); color:#fff;" class="form-control" placeholder="Écrivez ici votre méssage"></textarea>
			<br>
			<br>
			<br>
			<input class="button" name="env" type="submit" value="envoyer" style="float:right; margin-right:15px;">
		</form>
	 </div>
	 
    </div>
  </footer>
</body>
</html>