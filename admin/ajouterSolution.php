<?php
include('load.php');	
				

if (isset ($_POST['ajouter']))
{
$intituleSolution = $_POST['intituleSolution'];

$descriptionSolution= $_POST['descriptionSolution'];



$intituleSolution = mysql_real_escape_string($intituleSolution);  
$descriptionSolution = mysql_real_escape_string($descriptionSolution); 

 

	if(empty($intituleSolution) || $intituleSolution==null || $intituleSolution=="")
				{
				echo ("<p class='bg-danger'>Saisir l'intitulé du solution.</p>");
				}
				
				else
				{
				$verifierSolution= mysql_query("SELECT * FROM solution WHERE titre_solution='$intituleSolution'") or die(mysql_error());
				$nbrSolution=mysql_num_rows($verifierSolution);
					if($nbrSolution==0)
					{
					

						$content_dir = '../image/solution/'; // dossier où sera déplacé le fichier
								
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
										$rand=rand(1,999);
										$name_file1=$rand.$name_file;
										imagejpeg ($image, $content_dir.$name_file1);
										
										/* $objectBandeau = new myClassBandeau();
										$objectBandeau -> ajouterBandeau($_POST["titreBandeau"],$_POST["descriptionBandeau"],$name_file); */
										$ajouterProduit= mysql_query("INSERT INTO solution (titre_solution, contenu_solution, image_solution) VALUES ('$intituleSolution','$descriptionSolution','$name_file1')") or die(mysql_error());
										//header("location:afficherProduit.php#produit");
										echo "<script>window.location.replace('afficherSolution.php#solution');</script>";
										
										
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
										$rand=rand(1,999);
										$name_file1=$rand.$name_file;
										imagepng ($image, $content_dir.$name_file1);
										
										$ajouterProduit= mysql_query("INSERT INTO solution (titre_solution, contenu_solution, image_solution) VALUES ('$intituleSolution','$descriptionSolution','$name_file1')") or die(mysql_error());
										//header("location:afficherProduit.php#produit");
										echo "<script>window.location.replace('afficherSolution.php#solution');</script>";
										
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
										$rand=rand(1,999);
										$name_file1=$rand.$name_file;
										imagegif ($image, $content_dir.$name_file1);
										
										$ajouterProduit= mysql_query("INSERT INTO solution (titre_solution, contenu_solution, image_solution) VALUES ('$intituleSolution','$descriptionSolution','$name_file1')") or die(mysql_error());
										//header("location:afficherProduit.php#produit");
										echo "<script>window.location.replace('afficherSolution.php#solution');</script>";
									}
									else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
											
						
					}
					else echo ("<p class='bg-danger'>Cet intiluté est déja utilisé pour un autre produit.</p>");
				// header location : afficher produits
				
				}
}
?>
   <div class="text-left" href="#solution">
	<h3>Solutions <small>Ajouter une solution</small></h3>


	<form action="ajouterSolution.php#solution" enctype="multipart/form-data" method="POST">
			<div class="form-group form1">
				<div class="input-group" >
					<div class="input-group-addon">Intitulé du solution</div>
					<input class="form-control" type="text" name="intituleSolution" value="<?php  if (isset($_POST["intituleSolution"])) echo $_POST["intituleSolution"]; ?>" placeholder="Saisir l'intitulé du solution">
				</div>
			</div> 
			
		
	
			
			<div class="form1">
				<div class="input-group-addon">Description </div>
				<textarea  id="description" name="descriptionSolution" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre description ici"><?php  if (isset($_POST["descriptionSolution"])) echo $_POST["descriptionSolution"]; ?></textarea>
				 <script>
                // Replace the <textarea id="description"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description' );
				</script>
				
			</div>
			<br>

			
		<div class="form1">
		  <div class="input-group-addon">Upload image</div>
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

