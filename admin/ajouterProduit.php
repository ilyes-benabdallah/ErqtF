<?php
include('load.php');	
				

if (isset ($_POST['ajouter']))
{
$intituleProduit = $_POST['intituleProduit'];
$referenceProduit= $_POST['referenceProduit'];
$descriptionProduit= $_POST['descriptionProduit'];
$caracteristiqueProduit= $_POST['caracteristiqueProduit'];
$prixProduit= $_POST['prixProduit'];
$prixPromotionProduit= $_POST['prixPromotionProduit'];
$categorieProduit= $_POST['categorieProduit'];
$statutProduit= $_POST['statutProduit'];

$intituleProduit = mysql_real_escape_string($intituleProduit); 
$referenceProduit = mysql_real_escape_string($referenceProduit); 
$descriptionProduit = mysql_real_escape_string($descriptionProduit); 
$caracteristiqueProduit = mysql_real_escape_string($caracteristiqueProduit); 
$prixProduit = mysql_real_escape_string($prixProduit); 
$prixPromotionProduit = mysql_real_escape_string($prixPromotionProduit); 
$categorieProduit = mysql_real_escape_string($categorieProduit); 
$statutProduit = mysql_real_escape_string($statutProduit); 

	if(empty($intituleProduit) || $intituleProduit==null || $intituleProduit=="")
				{
				echo ("<p class='bg-danger'>Saisir l'intitulé du produit.</p>");
				}
				elseif(empty($referenceProduit) || $referenceProduit==null || $referenceProduit=="")
				{
				echo ("<p class='bg-danger'>Saisir la réference du produit.</p>");
				}
				else
				{
				//$verifierProduit= mysql_query("SELECT * FROM produits WHERE intitule_produit='$intituleProduit'") or die(mysql_error());
				$nbrProduit=0;
					if($nbrProduit==0)
					{
					$verifierProduit1= mysql_query("SELECT * FROM produits WHERE reference_produit='$referenceProduit' ") or die(mysql_error());
					$nbrProduit1=mysql_num_rows($verifierProduit1);
						if($nbrProduit1==0)
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
										$ajouterProduit= mysql_query("INSERT INTO produits (intitule_produit, reference_produit, description_produit, caracteristique_produit, prix_produit, prix_promotion_produit,categorie_produit,statut_produit, photo_produit) VALUES ('$intituleProduit','$referenceProduit','$descriptionProduit','$caracteristiqueProduit','$prixProduit','$prixPromotionProduit','$categorieProduit','$statutProduit','$name_file1')") or die(mysql_error());
										//header("location:afficherProduit.php#produit");
										echo "<script>window.location.replace('afficherProduit.php#produit');</script>";
										
										
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
										
										$ajouterProduit= mysql_query("INSERT INTO produits (intitule_produit, reference_produit, description_produit, caracteristique_produit, prix_produit, prix_promotion_produit,categorie_produit,statut_produit, photo_produit) VALUES ('$intituleProduit','$referenceProduit','$descriptionProduit','$caracteristiqueProduit','$prixProduit','$prixPromotionProduit','$categorieProduit','$statutProduit','$name_file1')") or die(mysql_error());
										//header("location:afficherProduit.php#produit");
										echo "<script>window.location.replace('afficherProduit.php#produit');</script>";
										
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
										
										$ajouterProduit= mysql_query("INSERT INTO produits (intitule_produit, reference_produit, description_produit, caracteristique_produit, prix_produit, prix_promotion_produit,categorie_produit,statut_produit, photo_produit) VALUES ('$intituleProduit','$referenceProduit','$descriptionProduit','$caracteristiqueProduit','$prixProduit','$prixPromotionProduit','$categorieProduit','$statutProduit','$name_file1')") or die(mysql_error());
										//header("location:afficherProduit.php#produit");
										/* $objectBandeau = new myClassBandeau();
										$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$name_file); */
										echo "<script>window.location.replace('afficherProduit.php#produit');</script>";
									}
									else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
											}
						else echo ("<p class='bg-danger'>Cette réference est déja utilisé pour un autre produit.</p>");
					}
					else echo ("<p class='bg-danger'>Cet intiluté est déja utilisé pour un autre produit.</p>");
				// header location : afficher produits
				
				}
}
?>
   <div class="text-left" href="#produit">
	<h3>Produits <small>Ajouter un produit</small></h3>


	<form action="ajouterProduit.php#produit" enctype="multipart/form-data" method="POST">
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">Intitulé du produit</div>
					<input class="form-control" type="text" name="intituleProduit" value="<?php  if (isset($_POST["intituleProduit"])) echo $_POST["intituleProduit"]; ?>" placeholder="Saisir l'intitulé du produit">
				</div>
			</div> 
			
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">Réference du produit</div>
					<input class="form-control" type="text" name="referenceProduit" value="<?php  if (isset($_POST["referenceProduit"])) echo $_POST["referenceProduit"]; ?>" placeholder="Saisir la réference du produit">
				</div>
			</div> 
	
			
			<div class="form1">
				<div class="input-group-addon">Description </div>
				<textarea  id="description" name="descriptionProduit" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre description ici"><?php  if (isset($_POST["descriptionProduit"])) echo $_POST["descriptionProduit"]; ?></textarea>
				 <script>
                // Replace the <textarea id="description"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description' );
				</script>
				
			</div>
			<br>
			<div class="form1">
				<div class="input-group-addon">Caractéristique du produit</div>
				<textarea  id="caracteristique" name="caracteristiqueProduit" class="form-control" rows="3" cols="80"  placeholder="Ajouter ici les catractéristique du produit"><?php  if (isset($_POST["caracteristiqueProduit"])) echo $_POST["caracteristiqueProduit"]; ?></textarea>
			</div>
			 <script>
                // Replace the <textarea id="caracteristique"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'caracteristique' );
				</script>
			<br>
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">Prix du produit</div>
					<input class="form-control" type="text" name="prixProduit" value="<?php  if (isset($_POST["prixProduit"])) echo $_POST["prixProduit"]; ?>" placeholder="Prix">
				</div>
			</div> 
			
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">Prix de promotion</div>
					<input class="form-control" type="text" name="prixPromotionProduit" value="<?php  if (isset($_POST["prixPromotionProduit"])) echo $_POST["prixPromotionProduit"]; ?>" placeholder="Prix de promotion">
				</div>
			</div> 
			
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">Catégorie du produit</div>
					
					<select name="categorieProduit" class="form-control">
					
						<option  value="autre" selected > Choisir la catégorie du produit</option>
						<?php
						$requeteCagegorie = mysql_query("SELECT * From categories WHERE parent_categorie='0' ORDER BY date_categorie DESC") or die (mysql_error());
						While($getCategorie=mysql_fetch_array($requeteCagegorie))
						{
						$IDCategorie = $getCategorie['id_categorie'];
						$nomCategorie = $getCategorie['nom_categorie'];
						?>
						<option <?php  if ((isset($_POST["categorieProduit"])) && ($_POST["categorieProduit"] == "$nomCategorie")) echo "selected";  ?> value="<?php echo $IDCategorie ;  ?>" ><?php echo $nomCategorie ; ?></option>
							
							<?php
							$requeteCagegorieFils = mysql_query("SELECT * From categories WHERE parent_categorie='$IDCategorie' ORDER BY date_categorie DESC") or die (mysql_error());
							While($getCategorieFils=mysql_fetch_array($requeteCagegorieFils))
							{
							$IDCategorieFils = $getCategorieFils['id_categorie'];
							$nomCategorieFils = $getCategorieFils['nom_categorie'];
							?>
							<option <?php  if ((isset($_POST["categorieProduit"])) && ($_POST["categorieProduit"] == "$nomCategorieFils")) echo "selected";  ?> value="<?php echo $IDCategorieFils ; ?>" >---- &nbsp;<?php echo $nomCategorieFils ; ?></option>
							<?php
							}
							?>
							
						
						<?php
						}
						?>
					</select>
				</div>
			</div> 
			
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">Statut du produit</div>
					<select name="statutProduit" class="form-control">
					
					<option <?php  if ((isset($_POST["statutProduit"])) && ($_POST["statutProduit"] == "normal")) echo "selected"; else  echo "selected"; ?> value="normal" > Normal</option>
					<option <?php  if ((isset($_POST["statutProduit"])) && ($_POST["statutProduit"] == "promotion")) echo "selected"; ?> value="promotion" > Promotion</option>
					<option <?php  if ((isset($_POST["statutProduit"])) && ($_POST["statutProduit"] == "nouveau")) echo "selected"; ?> value="nouveau" > Nouveau</option>
					</select>
					</div>
			</div> 
			
		<div class="form1">
		  <div class="input-group-addon">Upload image 400px*400px</div>
		  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
          <input type="file" name="ImageNews" id="image" />
		</div>
		<br><br>
		<div class="form1">
		<button type="submit" name="ajouter" class="btn btn-primary btn-block" >Ajouter produit</button>
		</div>
	</form>
	
	</div>

   

         
  <?php include('footer.php'); ?>      

