<?php ob_start(); ?>
<?php
include('load.php');
if(isset($_GET['monact']))
{
	$monActualite=$_GET['monact'];
	$monActualite = mysql_real_escape_string($monActualite); 
	$getActualite = mysql_query("SELECT * FROM actualite WHERE id_actualite='$monActualite'") or die(mysql_error());
	$nombreResultat=mysql_num_rows($getActualite);
	
	
	if($nombreResultat==0)
	{
	echo ("<p class='bg-danger'>Actualité introuvable.</p>");
	}
	else
	{
	$actualite= mysql_fetch_assoc($getActualite);
	$IDActualite = $actualite['id_actualite'];
			
	$imageActualite = $actualite['image_actualite'];			
	$titreActualite = $actualite['titre_actualite'];			
				
	

	
			if (isset ($_POST['modifier']))
			{
		
			
			
			$content_dir = '../image/actualite/'; // dossier où sera déplacé le fichier
								
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
										$name_file1=$titreActualite.$ran.$name_file;
										imagejpeg ($image, $content_dir.$name_file1);
										
										$file_name = '../image/actualite/'.$imageActualite; //nom de ton fichier ici.
										unlink("../image/actualite/".$imageActualite);
										$ajouterProduit= mysql_query("UPDATE actualite SET image_actualite='$name_file1' WHERE id_actualite='$IDActualite' ") or die(mysql_error());
										header("location:modifierPhotoActualite.php?monact=".$IDActualite."#actualite");
										
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
										$name_file1=$titreActualite.$ran.$name_file;
										imagepng ($image, $content_dir.$name_file1);
										
										$file_name = '../image/actualite/'.$imageActualite; //nom de ton fichier ici.
										unlink("../image/actualite/".$imageActualite);
										$ajouterProduit= mysql_query("UPDATE actualite SET image_actualite='$name_file1' WHERE id_actualite='$IDActualite' ") or die(mysql_error());
										header("location:modifierPhotoActualite.php?monact=".$IDActualite."#actualite");
										
										
										
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
										$name_file1=$titreActualite.$ran.$name_file;
										imagegif ($image, $content_dir.$name_file1);
										
										$file_name = '../image/actualite/'.$imageActualite; //nom de ton fichier ici.
										unlink("../image/actualite/".$imageActualite);
										$ajouterProduit= mysql_query("UPDATE actualite SET image_actualite='$name_file1' WHERE id_actualite='$IDActualite' ") or die(mysql_error());
										header("location:modifierPhotoActualite.php?monact=".$IDActualite."#actualite");
										
									}
									else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
				


			}
			?>	
			  
			  <div class="text-left" href="#actualite">
			<h3>Actualités <small>Modifier l'image de l'actualité</small> <small><a href="modifierActualite.php?monact=<?php echo $monActualite; ?>#actualie"><span class="label label-primary">Modifier actualité</span></a></small></h3>
			<br>

				<div>

				<form action="modifierPhotoActualite.php?monact=<?php echo $monActualite; ?>#actualite" enctype="multipart/form-data" method="POST">
						
	
						
						<div class="form1">
							<div class="input-group-addon" >image de l'actualité " <?php echo $titreActualite; ?> " </div>
							<img src="../image/actualite/<?php echo $imageActualite; ?>" width="140px" height="110px">
						</div>
						<div class="form1">
						  <div class="input-group-addon">Upload image</div>
						  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
						  <input type="file" name="ImageNews" id="image" />
						</div>
						

					
					<br><br>
					<div class="form1">
					<button type="submit" name="modifier" class="btn btn-primary btn-block" >Modifier l'image de l'actualite</button>
					</div>
				</form>
				</div>
				
				
				
				
<?php
	}
}
else echo ("<p class='bg-danger'>Erreur! Veiller selectionner une actualité.</p>");
?>

</div>
<?php include('footer.php'); ?> 
<?php ob_flush(); ?>
