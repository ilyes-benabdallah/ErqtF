<?php 
//include('config/db.php');
include('entete.php');
?>
<br>
<?php 
include('menuVertical.php');
?>


<div id="content">

    <h1>A propos de nous</h1>
	<div>
	
	<h2>Présentation:</h2>
	<p>
	La société <b>Eurequat Algérie</b> a démarré son activité en <b>mars 2006</b> avec le soutien et les moyens techniques de la société <b>Eurequat Technologie Europe</b> dans le domaine de la distribution des produits de traçabilité et d'identification ainsi que les points de vente.
	</p>
	
	<p>
	Notre société distribue et intègre des produitsde traçabilité et d'indentification à usages professionnels destinés aux grands entreprises de fabrication et de distribution,aux sociétés de communication spécialisés dans l'événementiel,aux administrations publiques et aux intégrateurs d'application utilisant le code barre ou la RFID.
	</p>
	
	<br>
	<h2>Domaine d'expertise:</h2>
	<h3>Identification:</h3>
	<p>
	L'identification englobe le domaine du badge et du contrôle d'accès(imprimantes, lecteurs de cartes, carte shifa, portes badge, cordons, clips,...).
	</p>
	
	<h3>Traçabilité:</h3>
	<p>
	La traçabilité est assurée aujourd'hui avec outils matériels et logiciels.Depuis de nombreuse années l'équipe <b>Eurequat</b>,spécialisée dans la traçabilité, a réalisé des logiciels "standards" afin de répondre aux exigences des entreprises manufacturières et de stockage. Ces logiciels de traçabilité sont également très ouverts a fin d'évoluer et de respecter les normes et les spécifités liées à un métier. Une solution clé en main chez <b>Eurequat</b>comprend l'analyse du besoin, le développemnt, l'instalation, la formation par experts de la traçabilité, tout en s'appuyant sur du matériel provenant des plus grands fournisseurs de matériels. Vous trouverez ci-après, un somaire des solutions de traçabilité que nous pouvons implémenter peut-être chez vous, en fonction de votre profil.
	</p>
	</div>

	<br>
	<!--h2>Gallery de photo</h2-->
	 <!-- Nivo Slider Start -->
        <!--section class="slider-wrapper">
          <div id="slideshow" class="nivoSlider"> 
		  	<?php
					/*$requeteGallery= mysql_query("SELECT * FROM gallery ORDER BY date_gallery DESC ") or die(mysql_error());
						while($resultatGallery=mysql_fetch_array($requeteGallery))
						{
							$IDGallery= $resultatGallery['id_gallery'];
							
							$imageGallery= $resultatGallery['image_gallery'];
							
						
				?>
				<a class="nivo-imageLink" href="#"><img src="image/gallery/<?php echo $imageGallery; ?>" alt="" /></a> 
			
					
				<?php
						}*/
				?>
		  
		  </div>
        </section-->
        <!--script type="text/javascript">S
$(document).ready(function() {
	$('#slideshow').nivoSlider();
});
</script-->
        <!-- Nivo Slider End-->
</div>

<?php 
include('footer.php');

?>
