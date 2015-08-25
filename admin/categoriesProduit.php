<?php ob_start(); ?>
<?php
include('load.php');
if(isset($_GET['o'])) $p=$_GET['o'];
else $p=0; 

?>


   <div class="text-left" href="#slide">
	<h3>Produits <small>Catégories des produits</small></h3>

	<br>
	<div class="cat cat1 ">
	<h4>Ajouter une nouvelle catégorie<h4>
	<br>
	<?php 

	if(isset($_POST['ajouter']))
	{
	$nom=$_POST['nom'];
	
	$parent= $_POST['parent'];
	$parent2= $_POST['parent2'];
		if(empty($nom) || $nom==null || $nom=="")
		{
		?>
		<p class="bg-danger">Veiller donner un nom au catégorie</p>
		<?php 
		}
		
		else
		{
			$nom=mysql_real_escape_string($nom);
			
			
			$requetteVerifierCategorie = mysql_query("SELECT * FROM categories WHERE nom_categorie='$nom'") or die(mysql_error());
			
			$nbrCategorie=mysql_num_rows($requetteVerifierCategorie);
				if($nbrCategorie==0)
				{
				$content_dir = '../image/categorie/'; // dossier où sera déplacé le fichier
								
								$tmp_file = $_FILES['ImageNews']['tmp_name'];
								
								if( !is_uploaded_file($tmp_file) )
								{
								echo ("<p class='bg-danger'>Le fichier est introuvable</p>");
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
										$requetteAjouterCategorie = mysql_query("INSERT INTO categories (nom_categorie, image_categorie, parent_categorie, parent2_categorie) VALUES ('$nom', '$name_file1','$parent' ,'$parent2')") or die(mysql_error());
										header("location:categoriesProduit.php#produit");
										//echo "<script>window.location.replace('categoriesProduit.php');</script>";
										
										
										
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
										$requetteAjouterCategorie = mysql_query("INSERT INTO categories (nom_categorie, image_categorie, parent_categorie, parent2_categorie) VALUES ('$nom', '$name_file1','$parent' ,'$parent2')") or die(mysql_error());
										header("location:categoriesProduit.php#produit");
										//echo "<script>window.location.replace('categoriesProduit.php');</script>";
										
										
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
										$requetteAjouterCategorie = mysql_query("INSERT INTO categories (nom_categorie, image_categorie, parent_categorie, parent2_categorie) VALUES ('$nom', '$name_file1','$parent' ,'$parent2')") or die(mysql_error());
										header("location:categoriesProduit.php#produit");
										
										//echo "<script>window.location.replace('categoriesProduit.php');</script>";
									}
									else echo ("<p class='bg-danger'>Le fichier n'est pas une image</p>");
									
				
				}
				else
				{
			?>
				<p class="bg-danger">Cette catégorie existe déja</p>
			<?php 
				}
		}
	}
	?>
	<form action="categoriesProduit.php#produit" enctype="multipart/form-data" method="POST">
	
		<label for="">Nom</label>
		<input type="text" name="nom" class="form-control" placeholder=""  value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>">
		<br>
		<label for="">Parent</label>
		<select class="form-control" name="parent" onchange="$('#parent2').show();">
		  <option value="0" selected>Pas de parent</option>
		
		  <?php
		  $getCategories1=mysql_query("SELECT * FROM categories where parent_categorie='0' and parent2_categorie='0' ORDER BY date_categorie DESC ") or die(mysql_error());

			while($categories1=mysql_fetch_array($getCategories1))
			{
			$IDCategorie1 =$categories1['id_categorie'];
			$nomCategorie1 =$categories1['nom_categorie'];
			?>
				<option value="<?php echo $IDCategorie1; ?>"><?php echo $nomCategorie1; ?></option>
			<?php
			}
			?>
		</select>
		<br>
		<div id="parent2" style="display:none;">
		<label for="">Parent 2</label>
		<select class="form-control" name="parent2">
		  <option value="0" selected>Pas de parent</option>
		
		  <?php
		  $getCategories2=mysql_query("SELECT * FROM categories where parent_categorie='0' and parent2_categorie='0'  ORDER BY date_categorie DESC ") or die(mysql_error());

			while($categories2=mysql_fetch_array($getCategories2))
			{
			$IDCategorie2 =$categories2['id_categorie'];
			$nomCategorie2 =$categories2['nom_categorie'];
			?>
				<option value="<?php echo $IDCategorie2; ?>"><?php echo $nomCategorie2; ?></option>
			<?php
			}
			?>
		</select>
		<br>
		</div>
		<label for="">Description (210px*210px)</label>
		
		 
		  <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
          <input type="file" name="ImageNews" id="image" />
		
		<br>
		<input type="submit" name="ajouter" class="btn btn-default right" value="Ajouter">
	</form>

	</div>
	


	<div class="cat cat2">
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="" style="width: 100px;">ID catégorie</th>
				<th class=""style="width: 150px;">nom</th>
				<th class="">image</th>
				<th class="" style="width: 240px;">Action</th>
			</tr>
		</thead>
		<form action="categoriesProduit.php?o=<?php echo $p; ?>#produit" method="POST" >
		<tbody>
<?php 



$getNbrCategories=mysql_query("SELECT * FROM categories WHERE parent_categorie='0' and parent2_categorie='0'") or die(mysql_error());
$nbrCategorie=mysql_num_rows($getNbrCategories);
$getCategories=mysql_query("SELECT * FROM categories WHERE parent_categorie='0' and parent2_categorie='0' ORDER BY date_categorie DESC LIMIT $p , 5 ") or die(mysql_error());

while($categories=mysql_fetch_array($getCategories))
{
$IDCategorie =$categories['id_categorie'];
$nomCategorie =$categories['nom_categorie'];
$imageCategorie =$categories['image_categorie'];

if(isset($_POST["modifierbutton".$IDCategorie]))
				{
				$nom= $_POST["nom".$IDCategorie];
				$requeteModifier = mysql_query("UPDATE categories SET nom_categorie='$nom' WHERE id_categorie='$IDCategorie ' ") or die(mysql_error());
				
				header("location:categoriesProduit.php?o=".$p."#produit");
				}
//----------------------------------------				
	if(isset($_POST["supprimerbutton".$IDCategorie]))
	{
	$getCategories1=mysql_query("SELECT * FROM categories WHERE parent_categorie='$IDCategorie' or parent2_categorie='$IDCategorie' ") or die(mysql_error()); // sup
	$nbrCategories=mysql_num_rows($getCategories1);
	if($nbrCategories!=0)
	{
		while($result=mysql_fetch_array($getCategories1))
		{
		$IDCategorieFils1 =$result['id_categorie'];
		$nomCategorieFils =$result['nom_categorie'];
		$imageCategorieFils1 =$result['image_categorie'];
		$parent1 =$result['parent_categorie'];
		$parent2 =$result['parent2_categorie'];
		
		if($parent1==0 or $parent2==0)
			{
				$file_name = '../image/categorie/'.$imageCategorieFils1; //nom de ton fichier ici.
				unlink("../image/categorie/".$imageCategorieFils1);
				$requette = mysql_query("DELETE FROM categories WHERE id_categorie='$IDCategorieFils1'") or die(mysql_error());
							
			
			}
			elseif($parent1==$IDCategorie)
			{
				$requeteModifierParent1 = mysql_query("UPDATE categories SET parent_categorie='0' WHERE id_categorie='$IDCategorieFils1 ' ") or die(mysql_error());
			
			}
			elseif($parent2==$IDCategorie)
			{
				$requeteModifierParent2 = mysql_query("UPDATE categories SET parent2_categorie='0' WHERE id_categorie='$IDCategorieFils1 ' ") or die(mysql_error());
							
			}
		}
	}
	
	$file_name = '../image/categorie/'.$imageCategorie; //nom de ton fichier ici.
	unlink("../image/categorie/".$imageCategorie);
	$requete = mysql_query("DELETE FROM categories WHERE id_categorie='$IDCategorie'") or die(mysql_error());
	
	
	header("location:categoriesProduit.php?o=".$p."#produit");
	//echo "<script>window.location.replace('location:categoriesProduit.php?o='.$p.'#produit');</script>";
	}
//----------------------------------------
?>
	
		
		<tr class="success" >
		<td><?php echo $IDCategorie;?> </td>
		<td><?php echo $nomCategorie;?> </td>
		<td><img src="../image/categorie/<?php echo $imageCategorie;?>" width="100px;" height="100px"> </td>
		<td>
<button type="button" class="btn btn-success" onclick="window.location.replace('modifierCategorie.php?cat=<?php echo $IDCategorie; ?>#produit');" >M image</button>
<button type="button" class="btn btn-success" onclick="$('#mod<?php echo $IDCategorie; ?>').toggle('slow');">M nom</button> 
			<img  src="images/del.png" onclick="$('#sup<?php echo $IDCategorie; ?>').toggle('slow');" style="cursor: pointer;" />
		</td>
		</tr>

<tr class="info" id="mod<?php echo $IDCategorie; ?>" style="display: none;">
			<td colspan="3"> <input type="text" class="form-control" id="exampleInputEmail1" name="nom<?php echo $IDCategorie; ?>" value="<?php if(isset($_POST["modifierbutton".$IDCategorie])) echo ($_POST["modifierbutton".$IDCategorie]); else echo $nomCategorie;  ?> "placeholder="Enter le lien"></td>
			<td  style="width: 240px;"><button type="submit" class="btn btn-info"  name="modifierbutton<?php echo $IDCategorie; ?>" >Oui, je modifie !</button></td>
		</tr>
		<tr class="danger" id="sup<?php echo $IDCategorie; ?>" style="display: none;">
			<td colspan="3"> Vous êtes sur de vouloir supprimer cette categirie <b><?php echo $nomCategorie;?> </b>? Attention les elements fils seront supprimés automatiquement</td>
			<td  colspan=""><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDCategorie; ?>" >Oui, je supprime !</button></td>
		</tr>
		<?php 



			
		
			$getCategoriesFils=mysql_query("SELECT * FROM categories WHERE parent_categorie='$IDCategorie'  or  parent2_categorie='$IDCategorie' ORDER BY date_categorie DESC ") or die(mysql_error());
			$NbrFils=mysql_num_rows($getCategoriesFils);
			if ($NbrFils!=0)
			{
				while($categoriesFils=mysql_fetch_array($getCategoriesFils))
				{
				$IDCategorieFils =$categoriesFils['id_categorie'];
				$nomCategorieFils =$categoriesFils['nom_categorie'];
				$imageCategorieFils =$categoriesFils['image_categorie'];
				$parent1 =$categoriesFils ['parent_categorie'];
				$parent2 =$categoriesFils ['parent2_categorie'];
				
				if(isset($_POST["modifierbutton".$IDCategorieFils.$IDCategorie]))
				{
				$nom1= $_POST["nom".$IDCategorieFils.$IDCategorie];
				$requeteModifier = mysql_query("UPDATE categories SET nom_categorie='$nom1' WHERE id_categorie='$IDCategorieFils ' ") or die(mysql_error());
				
				header("location:categoriesProduit.php?o=".$p."#produit");
				}
				
//----------------------------------------
					if(isset($_POST["supprimerbutton".$IDCategorieFils.$IDCategorie]))
					{
					
						//$requeteCategorieFilsSupprimer= mysql_query("SELECT * FROM categories WHERE id_categorie='$IDCategorieFils") or die(mysql_error());
						//$infoCategorie=mysql_fetch_assoc($requeteCategorieFilsSupprimer);
						if($parent1==0 or $parent2==0)
						{
							$file_name = '../image/categorie/'.$imageCategorieFils; //nom de ton fichier ici.
							unlink("../image/categorie/".$imageCategorieFils);
							$requette = mysql_query("DELETE FROM categories WHERE id_categorie='$IDCategorieFils'") or die(mysql_error());
						
							header("location:categoriesProduit.php?o=".$p."#produit");
						}
						elseif($parent1==$IDCategorie)
						{
							$requeteModifierParent1 = mysql_query("UPDATE categories SET parent_categorie='0' WHERE id_categorie='$IDCategorieFils ' ") or die(mysql_error());
							header("location:categoriesProduit.php?o=".$p."#produit");
						}
						elseif($parent2==$IDCategorie)
						{
							$requeteModifierParent2 = mysql_query("UPDATE categories SET parent2_categorie='0' WHERE id_categorie='$IDCategorieFils ' ") or die(mysql_error());
							header("location:categoriesProduit.php?o=".$p."#produit");
						}
					}
//----------------------------------------
			?>
				
					
					<tr>
					<td><?php echo $IDCategorieFils;?> </td>
					<td>---- &nbsp;<?php echo $nomCategorieFils;?> </td>
					<td><img src="../image/categorie/<?php echo $imageCategorieFils;?>"   width= "100px;"></td>
					<td>
<button type="button" class="btn btn-success" onclick="window.location.replace('modifierCategorie.php?cat=<?php echo $IDCategorieFils; ?>#produit');" >M image</button> 
<button type="button" class="btn btn-success" onclick="$('#mod<?php echo $IDCategorieFils.$IDCategorie; ?>').toggle('slow');">M nom</button> 
						<img  src="images/del.png" onclick="$('#sup<?php echo $IDCategorieFils.$IDCategorie; ?>').toggle('slow');" style="cursor: pointer;" />
					</td>
					</tr>

<tr class="info" id="mod<?php echo $IDCategorieFils.$IDCategorie; ?>" style="display: none;">
			<td colspan="3"> <input type="text" class="form-control" id="exampleInputEmail1" name="nom<?php echo $IDCategorieFils.$IDCategorie; ?>" value="<?php if(isset($_POST["modifierbutton".$IDCategorieFils.$IDCategorie])) echo ($_POST["modifierbutton".$IDCategorieFils.$IDCategorie]); else echo $nomCategorieFils;  ?> "placeholder="Enter le lien"></td>
			<td  style="width: 240px;"><button type="submit" class="btn btn-info"  name="modifierbutton<?php echo $IDCategorieFils.$IDCategorie; ?>" >Oui, je modifie !</button></td>
		</tr>
					<tr class="danger" id="sup<?php echo $IDCategorieFils.$IDCategorie; ?>" style="display: none;">
						<td colspan="3"> Vous êtes sur de vouloir supprimer cette categirie <b><?php echo $nomCategorieFils;?></b>? </td>
						<td  colspan=""><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDCategorieFils.$IDCategorie; ?>" >Oui, je supprime !</button></td>
					</tr>
					
					
			<?php

				}
			}

			?>
		
		
<?php

}
if($p==0) $classPager="disabled"; else $classPager=""  ;
if($p+5>$nbrCategorie-1) $classPager1="disabled"; else $classPager1=""  ; 

?>
</form>
<span class="label label-danger">(<?php echo $nbrCategorie;?>) elements parents</span>
		</tbody>
	</table>
	<nav>
  <ul class="pager">
    <li class="<?php echo $classPager;?>"><a href="categoriesProduit.php?o=<?php $o=$p-5; if ($o<0) {$o=0; echo $o;} else echo $o;?>#produit" ><span aria-hidden="true">&larr;</span> Previous</a></li>
    <li class="<?php echo $classPager1;?>"><a href="categoriesProduit.php?o=<?php $o=$p+5; if ($o >$nbrCategorie-1) {$o=$p; echo $o;} else echo $o;?>#produit">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>
	</div>
	
	
	
		
	</div>

     

         
<?php include('footer.php'); ?>      
<?php ob_flush(); ?>