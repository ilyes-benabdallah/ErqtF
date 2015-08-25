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
	echo ("<p class='bg-danger'>actualité introuvable.</p>");
	}
	else
	{
	$actualite= mysql_fetch_assoc($getActualite);
	$IDActualite = $actualite['id_actualite'];
	$titreActualite = $actualite['titre_actualite'];
	$contenuActualite = $actualite['contenu_actualite'];
	$statutActualite = $actualite['statut_actualite'];		
	$imageActualite = $actualite['image_actualite'];			
			 
	
			if (isset ($_POST['modifier']))
			{
			$titreActualite = $_POST['titreActualite'];
			$contenuActualite= $_POST['contenuActualite'];
			$statutActualite= $_POST['statutActualite'];
			
				if(empty($titreActualite) || $titreActualite==null || $titreActualite=="")
				{
				echo ("<p class='bg-danger'>Veuillez saisir le titre de l'actualité.</p>");
				}
				elseif(empty($contenuActualite) || $contenuActualite==null || $contenuActualite=="")
				{
				echo ("<p class='bg-danger'>Veuillez saisir le contenu de l'actualité.</p>");
				}
				else
				{
				
						
						$updateProduit=mysql_query ("
						UPDATE actualite
						SET 
						titre_actualite='$titreActualite', 
						contenu_actualite='$contenuActualite',
						statut_actualite='$statutActualite'
						WHERE id_actualite ='$IDActualite' ");
						
					
			
				}


			}
			?>	
  <div class="text-left" href="#produit">
	<h3>Actualités <small>Modifier l'actualité</small> <small><a href="modifierPhotoActualite.php?monact=<?php echo $monActualite; ?>#actualite"><span class="label label-primary">Modifier l'image de l'actualité</span></a></small></h3>
	<br>
				
				<div>

				<form action="modifierActualite.php?monact=<?php echo $monActualite; ?>#actualite" enctype="multipart/form-data" method="POST">
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Titre</div>
								<input class="form-control" type="text" name="titreActualite" value="<?php  if (isset($_POST["titreActualite"])) echo $_POST["titreActualite"]; else echo$titreActualite; ?>" placeholder="Saisir le titre de l'actualité">
							</div>
						</div> 
						 
				
						
						<div class="form1">
							<div class="input-group-addon">Contenu </div>
							<textarea  id="description" name="contenuActualite" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre description ici"><?php  if (isset($_POST["contenuActualite"])) echo $_POST["contenuActualite"]; else echo $contenuActualite;?></textarea>
						</div>
						<script>
						// Replace the <textarea id="description"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'description' );
						</script>
						<br>
					
						
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Statut du produit</div>
								<select name="statutActualite" class="form-control">
								
								<option <?php  if (((isset($_POST["statutActualite"])) && ($_POST["statutActualite"] == "1")) or ($statutActualite == "1")) echo "selected";else  echo "selected"; ?> value="1" > Publier</option>
								<option <?php  if (((isset($_POST["statutActualite"])) && ($_POST["statutActualite"] == "0")) or ($statutActualite == "0")) echo "selected";?> value="0" > Broullion</option>
								
								</select>
								</div>
						</div> 
						
					
					<br><br>
					<div class="form1">
					<button type="submit" name="modifier" class="btn btn-primary btn-block" >Modifier actualité</button>
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