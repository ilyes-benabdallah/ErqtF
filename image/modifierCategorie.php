<?php
include('load.php');
if(isset($_GET['cat']))
{
	$moncat=$_GET['cat'];
	$moncat = mysql_real_escape_string($moncat); 
	$getcat = mysql_query("SELECT * FROM categories WHERE id_categorie='$moncat'") or die(mysql_error());
	$nombreResultat=mysql_num_rows($getcat);
	
	
	if($nombreResultat==0)
	{
	echo ("<p class='bg-danger'>Categorie introuvable.</p>");
	}
	else
	{
	$categorie= mysql_fetch_assoc($getcat);
	$IDcategorie = $categorie['id_categorie'];
			
	$imageCategorie = $categorie['image_categorie'];			
	$nomCategorie = $categorie['nom_actualite'];			
				
	

	
			if (isset ($_POST['modifier']))
			{
		
			
			
			$content_dir = '../image/categorie/'; // dossier où sera déplacé le fichier
								
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
										
										$file_name = '../image/categorie/'.$imageActualite; //nom de ton fichier ici.
										unlink("../image/categorie/".$imageActualite);
										$ajouterProduit= mysql_query("UPDATE categories SET image_categorie='$name_file1' WHERE id_categorie='$IDCategorie' ") or die(mysql_error());
										header("location:modifierCategorie.php?cat=".$IDCategorie."#produit");
										
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
										
										$file_name = '../image/categorie/'.$imageActualite; //nom de ton fichier ici.
										unlink("../image/categorie/".$imageActualite);
										$ajouterProduit= mysql_query("UPDATE categories SET image_categorie='$name_file1' WHERE id_categorie='$IDCategorie' ") or die(mysql_error());
										header("location:modifierCategorie.php?cat=".$IDCategorie."#produit");
										
										
										
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
										
										$file_name = '../image/categorie/'.$imageActualite; //nom de ton fichier ici.
										unlink("../image/categorie/".$imageActualite);
										$ajouterProduit= mysql_query("UPDATE categories SET image_categorie='$name_file1' WHERE id_categorie='$IDCategorie' ") or die(mysql_error());
										header("location:modifierCategorie.php?cat=".$IDCategorie."#produit");
										
									}
									else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
				


			}
			?>	
			  
			  <div class="text-left" href="#produit">
			<h3>Catégorie <small>Modifier l'image du catégorie</small> <small><a href="categoriesProduit.php#produit"><span class="label label-primary">Afficher les catégories</span></a></small></h3>
			<br>

				<div>

				<form action="modifierCategorie.php?cat=<?php echo $moncat; ?>#produit" enctype="multipart/form-data" method="POST">
						
	
						
						<div class="form1">
							<div class="input-group-addon" >image du catégorie" <?php echo $nomCategorie; ?> " </div>
							<img src="../image/categorie/<?php echo $imageCategorie; ?>" width="140px" height="140px">
						</div>
						<div class="form1">
						  <div class="input-group-addon">Upload image</div>
						  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
						  <input type="file" name="ImageNews" id="image" />
						</div>
						

					
					<br><br>
					<div class="form1">
					<button type="submit" name="modifier" class="btn btn-primary btn-block" >Modifier l'image du categorie</button>
					</div>
				</form>
				</div>
				
				
				
				
<?php
	}
}
else echo ("<p class='bg-danger'>Erreur! Veiller selectionner une categorie.</p>");
?>

</div>
 <?php include('footer.php'); ?> 

				
				

