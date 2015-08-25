<?php 
//include('config/db.php');
include('entete.php');
?>
<br>
<?php 
include('menuVertical.php');
?>

<div id="content">
<?php 
$monProduit=$_GET['produit'];
$monProduit=mysql_real_escape_string($monProduit);

$requeteProduit=mysql_query("SELECT * FROM produits WHERE id_produit='$monProduit'") or die(mysql_error());
$existeProduit=mysql_num_rows($requeteProduit);
if($existeProduit==0)  echo ("<p class='bg-danger'>Produit introuvable!.</p>");
else
{
		$produits=mysql_fetch_assoc($requeteProduit);
				$IDProduit = $produits['id_produit'];
				$photoProduit = $produits['photo_produit'];
				$intituleProduit = $produits['intitule_produit'];
				$referenceProduit = $produits['reference_produit'];
				$statutProduit = $produits['statut_produit'];
				$categorieProduit = $produits['categorie_produit'];
				$descriptionProduit = $produits['description_produit'];
				$caracteristiqueProduit = $produits['caracteristique_produit'];
				
				$getCategorie=mysql_query("SELECT * FROM categories WHERE id_categorie='$categorieProduit'");
				$categorie= mysql_fetch_assoc($getCategorie);
				$nomCategorie=$categorie['nom_categorie'];
?>
        
        <h1><?php echo $referenceProduit ;?></h1>
        <div class="product-info">
          <div class="left">
            <div class="image"><a href="uploadImagesProduits/<?php echo $photoProduit ;?>" title="Canon EOS 5D" class="cloud-zoom colorbox" id='zoom1' rel="adjustX: 0, adjustY:0, tint:'#000000',tintOpacity:0.2, zoomWidth:360, position:'inside', showTitle:false"><img src="uploadImagesProduits/<?php echo $photoProduit ;?>" width="320px;" height="320px;" title="<?php echo $intituleProduit ;?>" alt="<?php echo $intituleProduit ;?>" id="image" /><span id="zoom-image">
			<i class="zoom_bttn"></i> Zoom</span></a></div>
            <!--   llllllllllllllllllll   -->

			 <div class="description" style="width: 350px;"> 
			 <span>catégorie :</span> <?php echo $nomCategorie ;?><br />
              <span>produit :</span> <?php echo $intituleProduit ;?><br />
              <span>réference :</span> <?php echo $referenceProduit ;?><br />
              
            
         
       
            
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a><a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
            <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-506f325f57fbfc95"></script>
            <!-- AddThis Button END -->
          </div>
          </div>
          <div class="right">
           	
		
        <!-- Description and Reviews Tab Start -->
        <div id="tabs" class="htabs"> <a href="#tab-description">Description</a> <!--a href="#tab-review">Caractéristiques</a--> </div>
        <div id="tab-description" class="tab-content">
        <br> <?php echo $descriptionProduit ;?>
        </div>
        <div id="tab-review" class="tab-content">
        <br> <?php //echo $caracteristiqueProduit ;?>
        </div>
        <script>
		  $(document).ready(function(){
		  $('#tabs a').tabs();
		  });
		  </script>
        <!-- Description and Reviews Tab Start -->
          </div>
        </div>
        

<?php 
}

?>	
	
  <br> <?php echo $caracteristiqueProduit ;?>

</div>

<?php 
include('footer.php');

?>
