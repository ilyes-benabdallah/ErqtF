<?php 
//include('config/db.php');
include('entete.php');
?>
<br>
<?php 
include('menuVertical.php');
?>


<div id="content">

    <h1>Nos actualités</h1>
	
	
		
		<?php
		if(isset($_GET['recherche'])) 
		{
		$recherche= $_GET['recherche'];
		$recherche=mysql_real_escape_string($recherche);
		
		if(isset($_GET['o'])) $p=$_GET['o'];
		else $p=0;
		
		
		$f=4;
		$getNbrProduits = mysql_query("SELECT * FROM produits WHERE intitule_produit LIKE '%".$recherche."%' or reference_produit LIKE '%".$recherche."%' or description_produit LIKE '%".$recherche."%'") or die(mysql_error());
		$getProduits = mysql_query("SELECT * FROM produits WHERE intitule_produit  LIKE '%".$recherche."%' or reference_produit LIKE '%".$recherche."%' or description_produit LIKE '%".$recherche."%' ORDER BY date_produit DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrProduits);
		

		while($produits=mysql_fetch_array($getProduits))
		{
			$IDProduit = $produits['id_produit'];
				$photoProduit = $produits['photo_produit'];
				$intituleProduit = $produits['intitule_produit'];
				$referenceProduit = $produits['reference_produit'];
				$statutProduit = $produits['statut_produit'];
				$categorieProduit = $produits['categorie_produit'];
				$descriptionProduit = $produits['description_produit'];
				
			$descriptionProduit= substr($descriptionProduit,0,200);
			
		?>
			<div class="product-list">
			<div class="left">
		
				<div class="image"><a href="produit.php?produit=<?php  echo $IDProduit; ?>"><img src="uploadImagesProduits/<?php  echo $photoProduit; ?>" title="iPad Classic" alt="iPad Classic" width="162px" height="100px"/></a></div>
				<div class="name"><a href="produit.php?produit=<?php  echo $IDProduit; ?>"><?php  echo $intituleProduit; ?></a></div>
				<div class="description"><?php  echo $descriptionProduit; ?></div>
				 
				<div class="cart">
					<a href="produit.php?produit=<?php  echo $IDProduit; ?>"><input type="button" class="button" value=" Lire "></a>
				   
				</div>
			</div>
			</div>
		<?php
		
		}
		if($p==0) {$classPager=""; $classFinPager="";} else {$classPager="<b>"; $classFinPager="</b>";} 
		if($p+6>$nombreResultat-1) {$classPager1=""; $classFinPager1="";} else {$classPager1="<b>"; $classFinPager1="</b>";}  
		?>
		
		  <!--Pagination Part Start-->
        <div class="pagination">
          <div class="links"><a href="recherche.php?recherche=<?php  echo $recherche; ?>&o=<?php $o=$p-6; if ($o<0) {$o=0; echo $o;} else echo $o;?>"><?php echo $classPager;?>Précedent<?php echo $classFinPager;?></a> &nbsp; &nbsp; <a href="recherche.php?recherche=<?php  echo $recherche; ?>&o=<?php $o=$p+6; if ($o >$nombreResultat-1) {$o=$p; echo $o;} else echo $o;?>"><?php echo $classPager1;?>Suivant<?php echo $classFinPager1;?></a> </div>
          
        </div>
        <!--Pagination Part End-->
		
		<?php
		}
		?>

</div>
</div>






<?php 
include('footer.php');

?>
