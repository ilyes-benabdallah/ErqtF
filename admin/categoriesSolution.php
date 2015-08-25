<?php
include('load.php');
if(isset($_GET['o'])) $p=$_GET['o'];
else $p=0; 

?>


   <div class="text-left" href="#solution">
	<h3>Produits <small>Catégories des solutions</small></h3>

	<br>
	<div class="cat cat1 ">
	<h4>Ajouter une nouvelle catégorie<h4>
	<br>
	<?php 

	if(isset($_POST['ajouter']))
	{
	$nom=$_POST['nom'];
	

		if(empty($nom) || $nom==null || $nom=="")
		{
		?>
		<p class="bg-danger">Veiller donner un nom au catégorie</p>
		<?php 
		}
		
		else
		{
			$nom=mysql_real_escape_string($nom);
			
			
			$requetteVerifierCategorie = mysql_query("SELECT * FROM categorie_solution WHERE nom_categorie_solution='$nom'") or die(mysql_error());
			
			$nbrCategorie=mysql_num_rows($requetteVerifierCategorie);
				if($nbrCategorie==0)
				{
				
										
										$requetteAjouterCategorie = mysql_query("INSERT INTO categorie_solution (nom_categorie_solution) VALUES ('$nom')") or die(mysql_error());
										//header("location:categoriesSolution.php");
										echo "<script>window.location.replace('categoriesSolution.php');</script>";
										
									
				
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
	<form action="categoriesSolution.php#solution" enctype="multipart/form-data" method="POST">
	
		<label for="">Nom</label>
		<input type="text" name="nom" class="form-control" placeholder="">
		<br>
	
		<br>
		
		<input type="submit" name="ajouter" class="btn btn-default right" value="Ajouter">
	</form>

	</div>
	


	<div class="cat cat2">
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="" >ID catégorie</th>
				<th class="">nom</th>
				
				<th class="" >Action</th>
			</tr>
		</thead>
		<form action="categoriesSolution.php?o=<?php echo $p; ?>#solution" method="POST" >
		<tbody>
<?php 



$getNbrCategories=mysql_query("SELECT * FROM categorie_solution ") or die(mysql_error());
$nbrCategorie=mysql_num_rows($getNbrCategories);
$getCategories=mysql_query("SELECT * FROM categorie_solution  ORDER BY date_categorie_solution DESC LIMIT $p , 5 ") or die(mysql_error());

while($categories=mysql_fetch_array($getCategories))
{
$IDCategorie =$categories['id_categorie_solution'];
$nomCategorie =$categories['nom_categorie_solution'];

	if(isset($_POST["supprimerbutton".$IDCategorie]))
	{
	
	
	$requete = mysql_query("DELETE FROM categorie_solution WHERE id_categorie_solution='$IDCategorie'") or die(mysql_error());
	
	
	header("location:categoriesSolution.php?o=".$p."#solution");
	}
?>
	
		
		<tr class="success" >
		<td><?php echo $IDCategorie;?> </td>
		<td><?php echo $nomCategorie;?> </td>
		
		<td>
			<img  src="images/del.png" onclick="$('#sup<?php echo $IDCategorie; ?>').toggle('slow');" style="cursor: pointer;" />
		</td>
		</tr>
		<tr class="danger" id="sup<?php echo $IDCategorie; ?>" style="display: none;">
			<td colspan="2"> Vous êtes sur de vouloir supprimer cette categirie <b><?php echo $nomCategorie;?> </b>?</td>
			<td  colspan=""><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDCategorie; ?>" >Oui, je supprime !</button></td>
		</tr>
	
		
		
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

