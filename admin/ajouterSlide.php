<?php
include('load.php');	

if (isset ($_POST['ajouter']))
{
$lienSlide = $_POST["lienSlide"];

	
		

							$content_dir = '../image/slider/'; // dossier où sera déplacé le fichier
									
									$tmp_file = $_FILES['ImageNews']['tmp_name'];
									
									if( !is_uploaded_file($tmp_file) )
									{
									echo ("<p class='bg-danger'Le fichier est introuvable</p>");
											}
									
									// on vérifie maintenant l'extension
									$type_file = $_FILES['ImageNews']['type'];
											if( strstr($type_file, 'jpg') || strstr($type_file, 'jpeg'))
											{
												//$objectErreur->initialiserErreur("Le fichier n'est pas une image",0);
											
											
											// on copie le fichier dans le dossier de destination
											$name_file = $_FILES['ImageNews']['name'];
											if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
											{
											echo ("<p class='bg-danger'>Nom de fichier non valide</p>"); 
											}
											
											$taille_min=620;
											$donnees= getimagesize($tmp_file);
											$image = imagecreatefromjpeg($tmp_file);
											if ($donnees[0] > $donnees[1]) { //paysage
												$largeur_finale=round(($taille_min/$donnees[1])*$donnees[0]);
												$hauteur_finale=$taille_min;
											}
											else
											{//portrait
												$hauteur_finale=round(($taille_min/$donnees[0])*$donnees[1]);
												$largeur_finale=$taille_min;
											}
											
											$image_mini = imagecreatetruecolor($largeur_finale, $hauteur_finale); //création image finale
											imagecopyresampled($image_mini, $image, 0, 0, 0, 0, $largeur_finale, $hauteur_finale, $donnees[0], $donnees[1]);//copie avec redimensionnement
											
											/* $image_mini = imagecreatetruecolor(620,384 ); //création image finale
											imagecopyresampled($image_mini, $image, 0, 0, 0, 0, 620, 384, $donnees[0], $donnees[1]);//copie avec redimensionnement */
											$ran=rand(1, 999);
											$name_file1=$ran.$name_file;
											imagejpeg ($image, $content_dir.$name_file1);
											$requeteAjouterSlide= mysql_query("INSERT INTO slide (image_slide, lien_slide) VALUE('$name_file1','$lienSlide')") or die(mysql_error());
											
													
											//header("location:afficherSlide.php#slide");
											echo "<script>window.location.replace('afficherSlide.php#slide');</script>";
											
											
										}
										elseif( strstr($type_file, 'png')){
												
											// on copie le fichier dans le dossier de destination
											$name_file = $_FILES['ImageNews']['name'];
											if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
											{
											echo ("<p class='bg-danger'>Nom de fichier non valide</p>"); 
											}
											
											$taille_min=620;
											
											$donnees= getimagesize($tmp_file);
											$donnees= getimagesize($tmp_file);
											$image = imagecreatefrompng($tmp_file);
											if ($donnees[0] > $donnees[1]) { //paysage
												$largeur_finale=round(($taille_min/$donnees[1])*$donnees[0]);
												$hauteur_finale=$taille_min;
											}
											else
											{//portrait
												$hauteur_finale=round(($taille_min/$donnees[0])*$donnees[1]);
												$largeur_finale=$taille_min;
											}
											//$image_mini = imagecreatetruecolor($largeur_finale, $hauteur_finale); //création image finale
											//imagecopyresampled($image_mini, $image, 0, 0, 0, 0, $largeur_finale, $hauteur_finale, $donnees[0], $donnees[1]);//copie avec redimensionnement
											/* $image_mini = imagecreatetruecolor(384, 620); //création image finale
											imagecopyresampled($image_mini, $image, 0, 0, 0, 0, 384, 620, $donnees[0], $donnees[1]);//copie avec redimensionnement */
											$ran=rand(1, 999);
											$name_file1=$ran.$name_file;
											imagepng ($image, $content_dir.$name_file1);
											
											imagejpeg ($image, $content_dir.$name_file1);
											$requeteAjouterSlide= mysql_query("INSERT INTO slide (image_slide, lien_slide) VALUE('$name_file1','$lienSlide')") or die(mysql_error());
											
											//header("location:afficherSlide.php#slide");
											echo "<script>window.location.replace('afficherSlide.php#slide');</script>";		
											
											
										}
										elseif( strstr($type_file, 'gif')){
												
											// on copie le fichier dans le dossier de destination
											$name_file = $_FILES['ImageNews']['name'];
											if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $name_file) )
											{
											echo ("<p class='bg-danger'>Nom de fichier non valide</p>"); 
											}
									
											$donnees= getimagesize($tmp_file);
											$image = imagecreatefromgif($tmp_file);
											
											$image_mini = imagecreatetruecolor(384, 620); //création image finale
											imagecopyresampled($image_mini, $image, 0, 0, 0, 0, 384, 620, $donnees[0], $donnees[1]);//copie avec redimensionnement
											$ran=rand(1, 999);
											$name_file1=$ran.$name_file;
											imagegif ($image, $content_dir.$name_file1);
											imagejpeg ($image, $content_dir.$name_file1);
											$requeteAjouterSlide= mysql_query("INSERT INTO slide (image_slide, lien_slide) VALUE('$name_file1','$lienSlide')") or die(mysql_error());
											//header("location:afficherSlide.php#slide");	
											echo "<script>window.location.replace('afficherSlide.php#slide');</script>";
										}
										else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
						
	
		

}
				
				// header location : afficher produits
				

?>
   <div class="text-left" href="#slide">
	<h3>Slides <small>Ajouter un slide</small></h3>


	<form action="ajouterSlide.php#slide" enctype="multipart/form-data" method="POST">
			 
			
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">lien</div>
					<input class="form-control" type="text" name="lienSlide" value="<?php  if (isset($_POST["lienSlide"])) echo $_POST["lienSlide"]; ?>" placeholder="Saisir le lien de slide">
				</div>
			</div> 

			
		<div class="form1">
		  <div class="input-group-addon">Upload image    " taille : 1000px  *  350px "</div>
		  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
          <input type="file" name="ImageNews" id="image" />
		</div>
		<br><br>
		<div class="form1">
		<button type="submit" name="ajouter" class="btn btn-primary btn-block" >Ajouter </button>
		</div>
	</form>
	
	</div>

     

         
  <?php include('footer.php'); ?>      

