<?php ob_start(); ?>
<?php
include('load.php');

if(isset($_POST['recherche']))
{
$g=$_POST['testeRecherche'];
}
elseif(isset($_GET['g'])) $g=$_GET['g'];

else $g="KFTM0CF1K";


if(isset($_GET['o'])) $p=$_GET['o'];
else $p=0;


?>
   <div class="text-left" href="#produit">
	<h3>Produits <small>Nos produits</small></h3>

	 
	
	
	
	<ul class="nav nav-tabs" role="tablist">
	  <li class="<?php  if ($g=="KFTM0CF1K") echo "active"; else echo " "; ?>"><a href="afficherProduit.php?g=KFTM0CF1K#produit">Tous</a></li>
	  <li class="<?php  if ($g=="KFTM1CF1K") echo "active"; else echo " ";  ?>"><a href="afficherProduit.php?g=KFTM1CF1K#produit">Normal</a></li>
	  <li class="<?php  if ($g=="KFTM2CF1K") echo "active"; else echo " "; ?>"><a href="afficherProduit.php?g=KFTM2CF1K#produit">Promotion</a></li>
	  <li class="<?php  if ($g=="KFTM3CF1K") echo "active"; else echo " "; ?>"><a href="afficherProduit.php?g=KFTM3CF1K#produit">Nouveau</a></li>
			  <form action="afficherProduit.php#produit" method="POST">
				<div class="row">
				<div class="col-lg-6">
				<div class="input-group">
				  <input type="text" name="testeRecherche" class="form-control" value="<?php if(isset($_POST['testeRecherche'])) echo $_POST['testeRecherche']; else echo ""; ?>">
				  <span class="input-group-btn">
					<input type="submit" class="btn btn-default" name="recherche" value="Recherche">
				  </span>
				</div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
			 </form>
	</ul>
	

	<table class="table table-hover">
		<thead>
			<tr>
			
				<th class="">Photo</th>
				<th class="">Intitulé</th>
				<th class="">Réference</th>
				<th class="">Catégorie</th>
				<th class="">Statut</th>
				<th class="" style="width: 140px;">Action</th>
			</tr>
		</thead>
		
		<tbody>
		<?php 
		
		if($g=="KFTM0CF1K")
		{
		$f=4;
		$getNbrProduits = mysql_query("SELECT * FROM produits ") or die(mysql_error());
		$getProduits = mysql_query("SELECT * FROM produits ORDER BY date_produit DESC LIMIT $p, $f " ) or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrProduits);
		}
		elseif($g=="KFTM1CF1K")
		{
		$f=4;
		$getNbrProduits = mysql_query("SELECT * FROM produits WHERE statut_produit='normal'") or die(mysql_error());
		$getProduits = mysql_query("SELECT * FROM produits WHERE statut_produit='normal' ORDER BY date_produit DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrProduits);
		
		}
		elseif($g=="KFTM2CF1K")
		{
		$f=4;
		$getNbrProduits = mysql_query("SELECT * FROM produits WHERE statut_produit='promotion'") or die(mysql_error());
		$getProduits = mysql_query("SELECT * FROM produits WHERE statut_produit='promotion' ORDER BY date_produit DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrProduits);
		
		
		}
		elseif($g=="KFTM3CF1K")
		{
		$f=4;
		$getNbrProduits = mysql_query("SELECT * FROM produits WHERE statut_produit='nouveau'") or die(mysql_error());
		$getProduits = mysql_query("SELECT * FROM produits WHERE statut_produit='nouveau'ORDER BY date_produit DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrProduits);
		}
		else
		{
		$f=4;
		$getNbrProduits = mysql_query("SELECT * FROM produits WHERE intitule_produit LIKE '%".$g."%' or reference_produit LIKE '%".$g."%'") or die(mysql_error());
		$getProduits = mysql_query("SELECT * FROM produits WHERE intitule_produit  LIKE '%".$g."%' or reference_produit LIKE '%".$g."%' ORDER BY date_produit DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrProduits);
		}
		
			while($produits= mysql_fetch_array($getProduits))
			{
				
				$IDProduit = $produits['id_produit'];
				$photoProduit = $produits['photo_produit'];
				$intituleProduit = $produits['intitule_produit'];
				$referenceProduit = $produits['reference_produit'];
				$statutProduit = $produits['statut_produit'];
				$categorieProduit = $produits['categorie_produit'];
				
				$getCategorie=mysql_query("SELECT * FROM categories WHERE id_categorie='$categorieProduit'");
				$categorie= mysql_fetch_assoc($getCategorie);
				$nomCategorie=$categorie['nom_categorie'];
				
				if(isset($_POST["supprimerbutton".$IDProduit]))
				{
				$file_name = '../uploadImagesProduits/'.$photoProduit; //nom de ton fichier ici.
				unlink("../uploadImagesProduits/".$photoProduit);
				$requette = mysql_query("DELETE FROM produits WHERE id_produit='$IDProduit'") or die(mysql_error());
				
				header("location:afficherProduit.php?g=".$g."&o=".$p."#produit");
				}
				
		?>	
		<form action="afficherProduit.php?g=<?php echo $g; ?>&o=<?php echo $p; ?>#produit" method="POST" >
		<tr>
			
			<td><img  src="../uploadImagesProduits/<?php echo $photoProduit;?>" width="100px;" height="100px;"></td>
			<td><?php echo $intituleProduit;?></td>
			<td><?php echo $referenceProduit;?></td>
			<td><?php echo $nomCategorie;?></td>
			<td class="<?php if($statutProduit=="promotion") echo"danger"; elseif($statutProduit=="nouveau") echo"success"; else echo"";?>" ><?php echo $statutProduit;?></td>
			<td> 
				<button type="button" class="btn btn-success" onclick="window.location.replace('modifierProduit.php?monpro=<?php echo $IDProduit; ?>#produit');" >Modifier</button> &nbsp;
				<img  src="images/del.png" onclick="$('#sup<?php echo $IDProduit; ?>').toggle('slow');" style="cursor: pointer;" />
			</td>
		</tr>
		<tr class="danger" id="sup<?php echo $IDProduit; ?>" style="display: none;">
			<td colspan="5"> Vous êtes sur de vouloir supprimer ce produit ?</td>
			<td  colspan="2"><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDProduit; ?>" >Oui, je supprime !</button></td>
		</tr>
		</form>
		
		<?php 	
				
			}
			

			if($p==0) $classPager="disabled"; else $classPager=""  ;
			if($p+4>$nombreResultat-1) $classPager1="disabled"; else $classPager1=""  ;

		?>
		<span class="label label-danger">(<?php echo $nombreResultat?>) elements</span>
		</tbody>
	</table>

<nav>
  <ul class="pager">
    <li class="<?php echo $classPager;?>"><a href="afficherProduit.php?g=<?php echo $g?>&o=<?php $o=$p-4; if ($o<0) {$o=0; echo $o;} else echo $o;?>#produit" ><span aria-hidden="true">&larr;</span> Previous</a></li>
    <li class="<?php echo $classPager1;?>"><a href="afficherProduit.php?g=<?php echo $g?>&o=<?php $o=$p+4; if ($o >$nombreResultat-1) {$o=$p; echo $o;} else echo $o;?>#produit">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>


</nav>

</div>
<?php include('footer.php'); ?>      
<?php ob_flush(); ?>