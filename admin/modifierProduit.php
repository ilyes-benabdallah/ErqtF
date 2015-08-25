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
	$order   = array("\r\n\r\n","\r\n", "\n", "\r");
	$replace = '';
	// Traitement du premier \r\n, ils ne seront pas convertis deux fois.
	$descriptionProduit = str_replace($order, $replace, $descriptionProduit);
	
	$caracteristiqueProduit = $produits['caracteristique_produit'];
	$order1   = array("\r\n\r\n","\r\n", "\n", "\r");
	$replace1 = '';
	// Traitement du premier \r\n, ils ne seront pas convertis deux fois.
	$caracteristiqueProduit = str_replace($order1, $replace1, $caracteristiqueProduit);
	
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
			$intituleProduit = $_POST['intituleProduit'];
			$referenceProduit= $_POST['referenceProduit'];
			$descriptionProduit= $_POST['descriptionProduit'];
			$caracteristiqueProduit= $_POST['caracteristiqueProduit'];
			$prixProduit= $_POST['prixProduit'];
			$prixPromotionProduit= $_POST['prixPromotionProduit'];
			$categorieProduit= $_POST['categorieProduit'];
			$statutProduit= $_POST['statutProduit'];
			
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
				//$verifierProduit= mysql_query("SELECT * FROM produits WHERE intitule_produit='$intituleProduit' and id_produit !='$IDProduit'") or die(mysql_error());
				$nbrProduit=0;
					if($nbrProduit==0)
					{
					$verifierProduit1= mysql_query("SELECT * FROM produits WHERE reference_produit='$referenceProduit' and id_produit !='$IDProduit'") or die(mysql_error());
					$nbrProduit1=mysql_num_rows($verifierProduit1);
						if($nbrProduit1==0)
						{
						$updateProduit=mysql_query ("
						UPDATE produits
						SET 
						intitule_produit='$intituleProduit', 
						reference_produit='$referenceProduit',
						description_produit='$descriptionProduit',
						caracteristique_produit='$caracteristiqueProduit',
						prix_produit='$prixProduit',
						prix_promotion_produit='$prixPromotionProduit',
						categorie_produit='$categorieProduit',
						statut_produit='$statutProduit'
						WHERE id_produit='$IDProduit' ");
						}
						else echo ("<p class='bg-danger'>Cette réference est déja utilisé pour un autre produit.</p>");
					}
					else echo ("<p class='bg-danger'>Cet intiluté est déja utilisé pour un autre produit.</p>");
				}


			}
			?>	
  <div class="text-left" href="#produit">
	<h3>Produits <small>Modifier un produit</small> <small><a href="modifierPhotoProduit.php?monpro=<?php echo $monProduit; ?>#produit"><span class="label label-primary">Modifier la photo du produit</span></a></small></h3>
	<br>
				
				<div>

				<form action="modifierProduit.php?monpro=<?php echo $monProduit; ?>#produit" enctype="multipart/form-data" method="POST">
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Intitulé du produit</div>
								<input class="form-control" type="text" name="intituleProduit" value="<?php  if (isset($_POST["intituleProduit"])) echo $_POST["intituleProduit"]; else echo$intituleProduit; ?>" placeholder="Saisir l'intitulé du produit">
							</div>
						</div> 
						
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Réference du produit</div>
								<input class="form-control" type="text" name="referenceProduit" value="<?php  if (isset($_POST["referenceProduit"])) echo $_POST["referenceProduit"]; else echo $referenceProduit; ?>" placeholder="Saisir la réference du produit">
							</div>
						</div> 
				
						
						<div class="form1">
							<div class="input-group-addon">Description </div>
							<textarea  id="description" name="descriptionProduit" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre description ici"><?php  if (isset($_POST["descriptionProduit"])) echo $_POST["descriptionProduit"]; else echo $descriptionProduit;?></textarea>
						</div>
						<script>
						// Replace the <textarea id="description"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'description' );
						</script>
						<br>
						<div class="form1">
							<div class="input-group-addon">Caractéristique du produit</div>
							<textarea  id="description1" name="caracteristiqueProduit" class="form-control" rows="3" cols="80"  placeholder="Ajouter ici les catractéristique du produit"><?php  if (isset($_POST["caracteristiqueProduit"])) echo $_POST["caracteristiqueProduit"]; else echo $caracteristiqueProduit; ?></textarea>
						</div>
						<script>
						// Replace the <textarea id="description"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'description1' );
						</script>
						<br>
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Prix du produit</div>
								<input class="form-control" type="text" name="prixProduit" value="<?php  if (isset($_POST["prixProduit"])) echo $_POST["prixProduit"]; else echo$prixProduit;?>" placeholder="Prix">
							</div>
						</div> 
						
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Prix de promotion</div>
								<input class="form-control" type="text" name="prixPromotionProduit" value="<?php  if (isset($_POST["prixPromotionProduit"])) echo $_POST["prixPromotionProduit"]; else echo$prixPromotionProduit;?>" placeholder="Prix de promotion">
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
						<option <?php  if ((isset($_POST["categorieProduit"])) && ($_POST["categorieProduit"] == "$nomCategorie") or ($categorieProduit == "$IDCategorie")) echo "selected";  ?> value="<?php echo $IDCategorie ;  ?>" ><?php echo $nomCategorie ; ?></option>
							
							<?php
							$requeteCagegorieFils = mysql_query("SELECT * From categories WHERE parent_categorie='$IDCategorie' ORDER BY date_categorie DESC") or die (mysql_error());
							While($getCategorieFils=mysql_fetch_array($requeteCagegorieFils))
							{
							$IDCategorieFils = $getCategorieFils['id_categorie'];
							$nomCategorieFils = $getCategorieFils['nom_categorie'];
							?>
							<option <?php  if ((isset($_POST["categorieProduit"])) && ($_POST["categorieProduit"] == "$nomCategorieFils") or ($categorieProduit == "$IDCategorieFils")) echo "selected";  ?> value="<?php echo $IDCategorieFils ; ?>" >---- &nbsp;<?php echo $nomCategorieFils ; ?></option>
							<?php
							}
							?>
							
						
						<?php
						} //or ($categorieProduit == "$IDCategorie")
						?>
					</select>
								
								

							</div>
						</div> 
						
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Statut du produit</div>
								<select name="statutProduit" class="form-control">
								
								<option <?php  if (((isset($_POST["statutProduit"])) && ($_POST["statutProduit"] == "normal")) or ($statutProduit == "normal")) echo "selected";else  echo "selected"; ?> value="normal" > Normal</option>
								<option <?php  if (((isset($_POST["statutProduit"])) && ($_POST["statutProduit"] == "promotion")) or ($statutProduit == "promotion")) echo "selected";?> value="promotion" > Promotion</option>
								<option <?php  if (((isset($_POST["statutProduit"])) && ($_POST["statutProduit"] == "nouveau")) or ($statutProduit == "nouveau"))echo "selected"; ?> value="nouveau" > Nouveau</option>
								</select>
								</div>
						</div> 
						
					
					<br><br>
					<div class="form1">
					<button type="submit" name="modifier" class="btn btn-primary btn-block" >Modifier produit</button>
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