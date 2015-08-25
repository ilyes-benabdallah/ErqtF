<?php
include('load.php');	

if (isset ($_POST['ajouter']))
{
$intitulePartenaire = $_POST["intitulePartenaire"];
$lienPartenaire = $_POST["lienPartenaire"];

	if ( empty($intitulePartenaire))
	{
	echo ("<p class='bg-danger'>Veuillez saisir l'intitué du partenaire.</p>");
	}
	else
	{
	$requete=mysql_query("SELECT * FROM partenaire WHERE intitule_partenaire='$intitulePartenaire'") or die(mysql_error());
	
	
	
	$Nbr=mysql_num_rows($requete);
		if($Nbr!=0)
		{
		 echo ("<p class='bg-danger'>Cet intitule existe déja!</p>");
		}
		else
		{
		

							$content_dir = '../image/partenaire/'; // dossier où sera déplacé le fichier
									
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
											
											$requeteAjouterPartenaire= mysql_query("INSERT INTO partenaire(intitule_partenaire, lien_partenaire, image_partenaire) VALUE('$intitulePartenaire','$lienPartenaire','$name_file1')") or die(mysql_error());
											
													
													//header("location:afficherPartenaire.php#partenaire");
													echo "<script>window.location.replace('afficherPartenaire.php#partenaire');</script>";
													
											
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
											
											$requeteAjouterPartenaire= mysql_query("INSERT INTO partenaire(intitule_partenaire, lien_partenaire, image_partenaire) VALUE('$intitulePartenaire','$lienPartenaire','$name_file1')") or die(mysql_error());
											
													
											echo "<script>window.location.replace('afficherPartenaire.php#partenaire');</script>";

											
											
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
											$requeteAjouterPartenaire= mysql_query("INSERT INTO partenaire(intitule_partenaire, lien_partenaire, image_partenaire) VALUE('$intitulePartenaire','$lienPartenaire','$name_file1')") or die(mysql_error());
											
													
													//header("location:afficherPartenaire.php#partenaire");
												echo "<script>window.location.replace('afficherPartenaire.php#partenaire');</script>";
												
											
										}
										else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
						
		}
		
	}
}
				
				// header location : afficher produits
				

?>
   <div class="text-left" href="#partenaire">
	<h3>Partenaires <small>Ajouter un partenaire</small></h3>


	<form action="ajouterPartenaire.php#partenaire" enctype="multipart/form-data" method="POST">
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">intitulé</div>
					<input class="form-control" type="text" name="intitulePartenaire" value="<?php  if (isset($_POST["intitulePartenaire"])) echo $_POST["intitulePartenaire"]; ?>" placeholder="Saisir l'intitulé de partenaire">
				</div>
			</div> 
			
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">lien</div>
					<input class="form-control" type="text" name="lienPartenaire" value="<?php  if (isset($_POST["lienPartenaire"])) echo $_POST["lienPartenaire"]; ?>" placeholder="Saisir le lien de partenaire">
				</div>
			</div> 

			
		<div class="form1">
		  <div class="input-group-addon">Upload image    "taille : 200px  *  125px "</div>
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

