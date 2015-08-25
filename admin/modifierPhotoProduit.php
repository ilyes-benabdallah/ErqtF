<?php ob_start(); ?>
<?php
include('load.php');
if(isset($_GET['monpro']))
{
	$monProduit=$_GET['monpro'];
	$monProduit = mysql_real_escape_string($monProduit); 
	$getProduits = mysql_query("SELECT * FROM produits WHERE id_produit='$monProduit'") or die(mysql_error());
	$nombreResultat=mysql_num_rows($getProduits);
	
	
	if($nombreResultat==0)
	{
	echo ("<p class='bg-danger'>Produit introuvable.</p>");
	}
	else
	{
	$produits= mysql_fetch_assoc($getProduits);
	$IDProduit = $produits['id_produit'];
	$intituleProduit = $produits['intitule_produit'];
	$referenceProduit = $produits['reference_produit'];
	$descriptionProduit = $produits['description_produit'];
	$caracteristiqueProduit = $produits['caracteristique_produit'];
	$prixProduit = $produits['prix_produit'];
	$prixPromotionProduit = $produits['prix_promotion_produit'];
	$categorieProduit = $produits['categorie_produit'];
	$statutProduit = $produits['statut_produit'];			
	$photoProduit = $produits['photo_produit'];			
				
	$IDProduit = mysql_real_escape_string($IDProduit); 
	$intituleProduit = mysql_real_escape_string($intituleProduit); 
	$referenceProduit = mysql_real_escape_string($referenceProduit); 
	$descriptionProduit = mysql_real_escape_string($descriptionProduit); 
	$caracteristiqueProduit = mysql_real_escape_string($caracteristiqueProduit); 
	$prixProduit = mysql_real_escape_string($prixProduit); 
	$prixPromotionProduit = mysql_real_escape_string($prixPromotionProduit); 
	$categorieProduit = mysql_real_escape_string($categorieProduit); 
	$statutProduit = mysql_real_escape_string($statutProduit); 
	
			if (isset ($_POST['modifier']))
			{
		
			
			
			$content_dir = '../uploadImagesProduits/'; // dossier où sera déplacé le fichier
								
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
										$name_file1=$intituleProduit.$name_file;
										imagejpeg ($image, $content_dir.$name_file1);
										
										/* $objectBandeau = new myClassBandeau();
										$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$name_file); */
										$file_name = '../uploadImagesProduits/'.$photoProduit; //nom de ton fichier ici.
										unlink("../uploadImagesProduits/".$photoProduit);
										$ajouterProduit= mysql_query("UPDATE produits SET photo_produit='$name_file1' WHERE id_produit='$IDProduit ' ") or die(mysql_error());
										header("location:modifierPhotoProduit.php?monpro=".$IDProduit."#produit");
										
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
										$name_file1=$intituleProduit.$name_file;
										imagepng ($image, $content_dir.$name_file1);
										
										$file_name = '../uploadImagesProduits/'.$photoProduit; //nom de ton fichier ici.
										unlink("../uploadImagesProduits/".$photoProduit);
										$ajouterProduit= mysql_query("UPDATE produits SET photo_produit='$name_file1' WHERE id_produit='$IDProduit ' ") or die(mysql_error());
										header("location:modifierPhotoProduit.php?monpro=".$IDProduit."#produit");
										
										
										
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
										$name_file1=$intituleProduit.$name_file;
										imagegif ($image, $content_dir.$name_file1);
										
										$file_name = '../uploadImagesProduits/'.$photoProduit; //nom de ton fichier ici.
										unlink("../uploadImagesProduits/".$photoProduit);
										$ajouterProduit= mysql_query("UPDATE produits SET photo_produit='$name_file1' WHERE id_produit='$IDProduit ' ") or die(mysql_error());
										header("location:modifierPhotoProduit.php?monpro=".$IDProduit."#produit");
										
										/* $objectBandeau = new myClassBandeau();
										$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$name_file); */
										
									}
									else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
				


			}
			?>	
			  
			  <div class="text-left" href="#produit">
			<h3>Produits <small>Modifier l'image du produit</small> <small><a href="modifierProduit.php?monpro=<?php echo $monProduit; ?>#produit"><span class="label label-primary">Modifier produit</span></a></small></h3>
			<br>

				<div>

				<form action="modifierPhotoProduit.php?monpro=<?php echo $monProduit; ?>#produit" enctype="multipart/form-data" method="POST">
						
	
						
						<div class="form1">
							<div class="input-group-addon">photo du produit "<?php echo $intituleProduit; ?> ( <?php echo $referenceProduit; ?> ) " </div>
							<img src="../uploadImagesProduits/<?php echo $photoProduit; ?>" width="99.8%"  height="60%">
						</div>
						<div class="form1">
						  <div class="input-group-addon">Upload image</div>
						  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
						  <input type="file" name="ImageNews" id="image" />
						</div>
						

					
					<br><br>
					<div class="form1">
					<button type="submit" name="modifier" class="btn btn-primary btn-block" >Modifier la photo du produit</button>
					</div>
				</form>
				</div>
				
				
				
				
<?php
	}
}
else echo ("<p class='bg-danger'>Erreur! Veiller selectionner un produit.</p>");
?>

</div>
 <?php include('footer.php'); ?> 
<?php ob_flush(); ?>
