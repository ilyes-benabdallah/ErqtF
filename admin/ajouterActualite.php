<?php
include('load.php');	
include('inc/actualites.php');

if (isset ($_POST['ajouter']))
{
$titreActualite = $_POST["titreActualite"];
$contenuActualite = $_POST["contenuActualite"];


						if(!empty($titreActualite) or $titreActualite!=null or $titreActualite!="")
						{
						if( !empty($contenuActualite) or $contenuActualite!=null or $contenuActualite!="")
						{
						$objectActualite = new myClassActualite();

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
										
										/* $objectBandeau = new myClassBandeau();
										$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$name_file); */
											
													$objectActualite->ajouterActualite ($_POST["titreActualite"],$_POST["contenuActualite"],$name_file1 ,$_POST["statutActualite"]);
												
												//header("location:afficherActualite.php#actualite");
												echo "<script>window.location.replace('afficherActualite.php#actualite');</script>";
												
										
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
										
										$objectActualite->ajouterActualite ($_POST["titreActualite"],$_POST["contenuActualite"],$name_file1 ,$_POST["statutActualite"]);
										//header("location:afficherActualite.php#actualite");
										echo "<script>window.location.replace('afficherActualite.php#actualite');</script>";
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
										
											$objectActualite->ajouterActualite ($_POST["titreActualite"],$_POST["contenuActualite"],$name_file1 ,$_POST["statutActualite"]);
											//header("location:afficherActualite.php#actualite");
											echo "<script>window.location.replace('afficherActualite.php#actualite');</script>";
										
									}
									else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
						}
						else echo ("<p class='bg-danger'>Veuillez remplir tous les champs.</p>");
						}
						else echo ("<p class='bg-danger'>Veuillez remplir tous les champs.</p>");
}
				
				// header location : afficher produits
				

?>
   <div class="text-left" href="#produit">
	<h3>Actualités <small>Ajouter une actualité</small></h3>


	<form action="ajouterActualite.php#actualite" enctype="multipart/form-data" method="POST">
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">titre</div>
					<input class="form-control" type="text" name="titreActualite" value="<?php  if (isset($_POST["titreActualite"])) echo $_POST["titreActualite"]; ?>" placeholder="Saisir le titre de l'actualité">
				</div>
			</div> 
 
	
			
			<div class="form1">
				<div class="input-group-addon">Contenu </div>
				<textarea  id="contenu" name="contenuActualite" class="form-control" rows="12" cols="80"  placeholder="Ajouter votre contenu ici"><?php  if (isset($_POST["contenuActualite"])) echo $_POST["contenuActualite"]; ?></textarea>
			</div>
			<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'contenu' );
            </script>
			<br>
			
		
			
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">Statut du produit</div>
					<select name="statutActualite" class="form-control">
					
					<option <?php  if ((isset($_POST["statutActualite"])) && ($_POST["statutActualite"] == "1")) echo "selected"; else  echo "selected"; ?> value="1" > Publier</option>
					<option <?php  if ((isset($_POST["statutActualite"])) && ($_POST["statutActualite"] == "0")) echo "selected"; ?> value="0" > Broullion</option>
					
					</select>
					</div>
			</div> 
			
		<div class="form1">
		  <div class="input-group-addon">Upload image</div>
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

