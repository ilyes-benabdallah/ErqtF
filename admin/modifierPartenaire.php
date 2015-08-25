<?php
include('load.php');
if(isset($_GET['monpro']))
{
	$monPartenaire=$_GET['monpro'];
	$monPartenaire = mysql_real_escape_string($monPartenaire); 
	$getPartenaire = mysql_query("SELECT * FROM partenaire WHERE id_partenaire='$monPartenaire'") or die(mysql_error());
	$nombreResultat=mysql_num_rows($getPartenaire);
	
	
	if($nombreResultat==0)
	{
	echo ("<p class='bg-danger'>Partenaire introuvable.</p>");
	}
	else
	{
	$partenaire= mysql_fetch_assoc($getPartenaire);
	$IDPartenaire = $partenaire['id_partenaire'];
	$intitulePartenaire = $partenaire['intitule_partenaire'];
	$lienPartenaire = $partenaire['lien_partenaire'];
	 
	
			if (isset ($_POST['modifier']))
			{
			$intitulePartenaire = $_POST['intitulePartenaire'];
			$lienPartenaire= $_POST['lienPartenaire'];
			
			
				if(empty($intitulePartenaire) || $intitulePartenaire==null || $intitulePartenaire=="")
				{
				echo ("<p class='bg-danger'>Veuillez saisir l'intitulé du partenaire.</p>");
				}
				else
				{
				$verifierProduit= mysql_query("SELECT * FROM partenaire WHERE intitule_partenaire='$intitulePartenaire' and id_partenaire !='$IDPartenaire'") or die(mysql_error());
				$nbrProduit=mysql_num_rows($verifierProduit);
					if($nbrProduit==0)
					{
					
						$updateProduit=mysql_query ("
						UPDATE partenaire
						SET 
						intitule_partenaire='$intitulePartenaire', 
						lien_partenaire='$lienPartenaire'
						WHERE id_partenaire='$IDPartenaire' ");
						
					}
					else echo ("<p class='bg-danger'>Cet intiluté est déja utilisé pour un autre partenaire.</p>");
				}


			}
			?>	
  <div class="text-left" href="#partenaire">
	<h3>Partenaires <small>Modifier un partenaire</small> <small><a href="modifierPhotoPartenaire.php?monpro=<?php echo $monPartenaire; ?>#partenaire"><span class="label label-primary">Modifier la photo du partenaire</span></a></small></h3>
	<br>
				
				<div>

				<form action="modifierPartenaire.php?monpro=<?php echo $monPartenaire; ?>#partenaire" enctype="multipart/form-data" method="POST">
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Intitulé du partenaire</div>
								<input class="form-control" type="text" name="intitulePartenaire" value="<?php  if (isset($_POST["intitulePartenaire"])) echo $_POST["intitulePartenaire"]; else echo$intitulePartenaire; ?>" placeholder="Saisir l'intitulé du partenaire">
							</div>
						</div> 
						
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Réference du partenaire</div>
								<input class="form-control" type="text" name="lienPartenaire" value="<?php  if (isset($_POST["lienPartenaire"])) echo $_POST["lienPartenaire"]; else echo $lienPartenaire; ?>" placeholder="Saisir la réference du partenaire">
							</div>
						</div> 
				
						
						<br>
					<div class="form1">
					<button type="submit" name="modifier" class="btn btn-primary btn-block" >Modifier</button>
					</div>
				</form>
				</div>
				
				
				
				
				<?php
	}
}
else echo ("<p class='bg-danger'>Erreur! Veiller selectionner un partenaire.</p>");
				?>
</div>
 <?php include('footer.php'); ?> 