<?php 

include('entete.php');
?>
<br>
<?php 
include('menuVertical.php');
?>
<div id="content">

    <h1>Nous contacter</h1>
	<div>
	  <div class="contact-info">
          <div class="content">
            <div class="left">
              <h4><b>Address:</b></h4>
              <p>Villa 183, Bois des cars 3, Dely Ibrahim ALGER ALGERIE</p>
			  <h4><b>Telephone:</b></h4>
              <p>+213 21 33 63 63 / +213 21 33 63 64</p> 
			  <h4><b>Fax:</b></h4>
              <p>+213 21 33 63 49</p>
			  <h4><b>E-Mail:</b></h4>
              <p>commercial@eurequat-algerie.com</p>
			  
            </div>
            <div class="right">
			
            <div class="image"><a href="image/plan/planEurequat.jpg" title="Canon EOS 5D" class="cloud-zoom colorbox" id='zoom1' rel="adjustX: 0, adjustY:0, tint:'#000000',tintOpacity:0.2, zoomWidth:360, position:'inside', showTitle:false"><img src="image/plan/planEurequat.jpg" width="360px;" height="310px;" title="Canon EOS 5D" alt="Canon EOS 5D" id="image" /><span id="zoom-image">
			<i class="zoom_bttn"></i> Zoom</span></a></div>
            
          
			
			 
				
            </div>
          </div>
		<h2>Nous contacter</h2>
		<?php 

		if(isset($_POST['submit']))
		{
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$objet=$_POST['objet'];
		$email=$_POST['email'];
		$message=$_POST['message'];
		
			if(empty($nom) || empty($prenom) ||empty($objet) ||empty($email))
			{
		?>
			<div class="warning">Error: veuillez remplir tous les champs obligatoires!<img class="close" alt=""></div>
		<?php 
			}
			else 
			{
			
			$entete = "MIME-Version: 1.0\r\n";
			$entete .= "Content-Type: multipart/related;\r\n";
			$entete .= "\r\n";	
			
			
			$msg = "Nom: ".$nom."\r\n";
			$msg .= "Prenom: ".$prenom."\r\n";
			$msg .= "Mail: ".$email."\r\n";
			$msg .= "\r\n";
			$msg .= "Objet: ".$objet; 
			$msg .= "\r\n";
			$msg .= "\r\n";
			$msg .= "Message: \r\n";
			$msg .= "\r\n";
			$msg .=$message;
			
			

			//$destinataire = "kira13_ilyes@hotmail.com";
			$destinataire = "commercial@eurequat-algerie.com";
			$expediteur   = $email;
			$reponse      = $expediteur;
	 
			mail($destinataire,$objet, $msg,"Reply-to: $reponse\r\nFrom: $expediteur\r\n".$entete);
			}
		}
		?>
        <form action="nousContacter.php" method="POST">
			<div class="content"> 
			<b>Nom *:</b><br>
			  <input class="large-field" type="text" value="" name="nom">
			  <br>
			 
			<b>Prenom *:</b><br>
			  <input class="large-field" type="text" value="" name="prenom">
			  <br> 
			  
			<b>objet *:</b><br>
			  <input class="large-field" type="text" value="" name="objet">
			  <br>
			
		
		 
			 <b>E-Mail *:</b><br>
			  <input class="large-field" type="text" placeholder="mail@mail.com" name="email">
			  <br>
			  <br>
			  <b>message:</b><br>
			  <textarea style="width: 98%;" rows="10" cols="40" name="message"></textarea>
			  <div class="buttons">
				  <div class="right">
					<input type="submit" name="submit" class="button" value="Envoyer">
				  </div>
				</div>
			</div>
		</form>	 
        </div>
       </div>
	
	</div>

</div>

<?php 
include('footer.php');

?>
