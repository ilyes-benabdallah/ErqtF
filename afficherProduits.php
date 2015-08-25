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
	if(!isset($_GET['categorie']))
	{
	echo('<div class="warning">Error: catégorie introvable!<a href="index.php"> <img class="close" alt="" src="image/close.png"></a></div>');
	exit;
	}
	else 
	{
	
		$maCategorie=$_GET['categorie'];
		$requeteVerification=mysql_query("SELECT * FROM categories WHERE id_categorie='$maCategorie' AND parent_categorie='0' and parent2_categorie='0'") or die(mysql_error());
		$categorieTrouve=mysql_num_rows($requeteVerification);
			if ($categorieTrouve==0)
			{
			echo('<div class="warning">Error: catégorie introvable!<a href="index.php"> <img class="close" alt="" src="image/close.png"></a></div>');
			
			}
			else // categorie existe 
			{
				$cateorie=mysql_fetch_assoc($requeteVerification);
				$IDCategorie=$cateorie['id_categorie'];
				$nomCategorie=$cateorie['nom_categorie'];
				?>
				
				<h1><?php echo $nomCategorie; ?></h1>
				<?php
				$requeteVerificationFlis=mysql_query("SELECT * FROM categories WHERE parent_categorie='$maCategorie' or parent2_categorie='$maCategorie'") or die(mysql_error());
				$flisTrouve=mysql_num_rows($requeteVerificationFlis);
					if ($flisTrouve==0)
					{
						$requeteProduit=mysql_query("SELECT * FROM produits WHERE categorie_produit='$IDCategorie' ORDER BY date_produit DESC") or die(mysql_error());
						$nbrProduit=mysql_num_rows($requeteProduit);
							if($nbrProduit==0)
							{
								echo('<br><div class="warning">produits introvable de cette catégorie!<a href="index.php"> <img class="close" alt="" src="image/close.png"></a></div>');
								
							}
							else // se  trouve des produits dans une catégorie parent
							{
							?>
							
								<div class="product-grid">
								
									<?php
									while ($getProduit=mysql_fetch_array($requeteProduit))
									{
										$IDProduit=$getProduit['id_produit'];
										$intituleProduit=$getProduit['intitule_produit'];
$referenceProduit=$getProduit['reference_produit'];
										$imageProduit=$getProduit['photo_produit'];
									?>
										
										<div>
											<div class="image"><a href="produit.php?produit=<?php echo $IDProduit ;?>"><img src="uploadImagesProduits/<?php echo $imageProduit ;?>" width="162px;" height="162px;" title="<?php echo $referenceProduit;?> alt="<?php echo $referenceProduit;?>/></a></div>
											<div class="name"><a href="produit.php?produit=<?php echo $IDProduit ;?>"><b><?php echo $referenceProduit;?></b></a></div>
											
										   
										</div>
									
									<?php
									}
									?>
								</div><!-- fin produit grid  -->
								<?php
								
							}
						
						
					}
					else // se trouve des catégories fils
					{	
					?>
						<div id="tabs" class="htabs">
							<?php
							$requeteGetFlis=mysql_query("SELECT * FROM categories WHERE parent_categorie='$maCategorie' or parent2_categorie='$maCategorie'") or die(mysql_error());
							while($getFils=mysql_fetch_array($requeteGetFlis))
							{
								$IDCategorieFils=$getFils['id_categorie'];
								$nomCategorieFils=$getFils['nom_categorie'];
								?>
								<a href="#tab-<?php echo $IDCategorieFils; ?>"><b><?php echo $nomCategorieFils; ?></b></a>
								<?php
								
							}
							
							?>
						</div> <!-- fin tabs -->
					
						<?php
						/****** * contenu tab ******/
						$requeteGetFlis1=mysql_query("SELECT * FROM categories WHERE parent_categorie='$maCategorie' or parent2_categorie='$maCategorie'") or die(mysql_error());
						while($getFils1=mysql_fetch_array($requeteGetFlis1))
							{
								$IDCategorieFils1=$getFils1['id_categorie'];
								$nomCategorieFils1=$getFils1['nom_categorie'];
								?>
								<div id="tab-<?php echo $IDCategorieFils1; ?>" class="tab-content">
									
									<!----------------produit----------------->
									<?php
									$requeteGetProduitFlis1=mysql_query("SELECT * FROM produits WHERE categorie_produit='$IDCategorieFils1' ORDER BY date_produit DESC") or die(mysql_error());
									$nbrProduitFils=mysql_num_rows($requeteGetProduitFlis1);
									if($nbrProduitFils==0) echo('<!--div class="warning">produits introvable de cette catégorie!<a href="index.php"> <img class="close" alt="" src="image/close.png"></a></div-->');
									else
									{
									?>
									
									<div class="product-grid">
									<?php
										while($getProduitFils1=mysql_fetch_array($requeteGetProduitFlis1))
										{
										$IDProduit1=$getProduitFils1['id_produit'];
										$intituleProduit1=$getProduitFils1['intitule_produit'];
$referenceProduit1=$getProduitFils1['reference_produit'];
										$imageProduit1=$getProduitFils1['photo_produit'];
										?>
											<div>
												<div class="image"><a href="produit.php?produit=<?php echo $IDProduit1 ;?>"><img src="uploadImagesProduits/<?php echo $imageProduit1 ;?>" width="162px;" height="162px;" title="<?php echo $referenceProduit1;?> alt="<?php echo $referenceProduit1;?>/></a></div>
												<div class="name"><a href="produit.php?produit=<?php echo $IDProduit1 ;?>"><b><?php echo $referenceProduit1;?></b></a></div>
												
											   
											</div>
											
										<?php
										}
										?>
									</div>
									<?php
									}
								
										?>
									 
									<!--------- fin produit------------------------> 
									
								</div>
								<?php
								
							}
						/****** * fin contenu ******/
						
						
						?>
						
					
						 <script>
							$(document).ready(function(){
							  $('#tabs a').tabs();
							});
						  </script>
						<?php
					
					}
				
			
			
			}
		
	
	
	
	}
?>
</div>


               <!--Tabs Start-->

  
      
        <!--Tabs End-->
        
        <!--Pagination Part Start>
        <div class="pagination">
          <div class="links"> <b>1</b> <a href="#">2</a> <a href="#">&gt;</a> <a href="#">&gt;|</a></div>
          <div class="results">Showing 1 to 15 of 16 (2 Pages)</div>
        </div>
        <Pagination Part End-->
 <!-- fin content -->

<?php 
include('footer.php');

?>
