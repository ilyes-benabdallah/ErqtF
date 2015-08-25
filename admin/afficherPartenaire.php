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
   <div class="text-left" href="#partenaire">
	<h3>Partenaires <small>Nos partenaires</small></h3>

	 
	
	
	
	<ul class="nav nav-tabs" role="tablist">
			<li class="<?php  if ($g=="KFTM0CF1K") echo "active"; else echo " "; ?>"><a href="afficherPartenaire.php?g=KFTM0CF1K#partenaire">Tous</a></li>
			  <form action="afficherPartenaire.php#partenaire" method="POST">
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
				<th class="">lien</th>
	
				<th class="" style="width: 140px;">Action</th>
			</tr>
		</thead>
		
		<tbody>
		<?php 
		
		if($g=="KFTM0CF1K")
		{
		$f=4;
		$getNbrPartenaire = mysql_query("SELECT * FROM partenaire ") or die(mysql_error());
		$getPartenaire = mysql_query("SELECT * FROM partenaire ORDER BY date_partenaire DESC LIMIT $p, $f " ) or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrPartenaire);
		}
	
		else
		{
		$f=4;
		$getNbrPartenaire = mysql_query("SELECT * FROM partenaire WHERE intitule_partenaire LIKE '%".$g."%' ") or die(mysql_error());
		$getPartenaire = mysql_query("SELECT * FROM partenaire WHERE intitule_partenaire  LIKE '%".$g."%'  ORDER BY date_partenaire DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrPartenaire);
		}
		
			while($partenaire= mysql_fetch_array($getPartenaire))
			{
				
				$IDPartenaire = $partenaire['id_partenaire'];
				$imagePartenaire = $partenaire['image_partenaire'];
				$intitulePartenaire = $partenaire['intitule_partenaire'];
				$lienPartenaire = $partenaire['lien_partenaire'];
				
				
				if(isset($_POST["supprimerbutton".$IDPartenaire]))
				{
				$file_name = '../image/partenaire/'.$imagePartenaire; //nom de ton fichier ici.
				unlink("../image/partenaire/".$imagePartenaire);
				$requette = mysql_query("DELETE FROM partenaire WHERE id_partenaire='$IDPartenaire'") or die(mysql_error());
				
				header("location:afficherPartenaire.php?g=".$g."&o=".$p."#partenaire");
				//echo "<script>window.location.replace('location:afficherPartenaire.php?g='$g'&o='$p'#partenaire');</script>";
				
				}
				
		?>	
		<form action="afficherPartenaire.php?g=<?php echo $g; ?>&o=<?php echo $p; ?>#partenaire" method="POST" >
		<tr>
			
			<td><img  src="../image/partenaire/<?php echo $imagePartenaire;?>" width="80px;" height="80px;"></td>
			<td><?php echo $intitulePartenaire;?></td>
			<td><?php echo $lienPartenaire;?></td>
			
			<td> 
				<button type="button" class="btn btn-success" onclick="window.location.replace('modifierPartenaire.php?monpro=<?php echo $IDPartenaire; ?>#partenaire');" >Modifier</button> &nbsp;
				<img  src="images/del.png" onclick="$('#sup<?php echo $IDPartenaire; ?>').toggle('slow');" style="cursor: pointer;" />
			</td>
		</tr>
		<tr class="danger" id="sup<?php echo $IDPartenaire; ?>" style="display: none;">
			<td colspan="3"> Vous êtes sur de vouloir supprimer ce partenaire ?</td>
			<td  style="width: 140px;"><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDPartenaire; ?>" >Oui, je supprime !</button></td>
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
    <li class="<?php echo $classPager;?>"><a href="afficherPartenaire.php?g=<?php echo $g?>&o=<?php $o=$p-4; if ($o<0) {$o=0; echo $o;} else echo $o;?>#partenaire" ><span aria-hidden="true">&larr;</span> Previous</a></li>
    <li class="<?php echo $classPager1;?>"><a href="afficherPartenaire.php?g=<?php echo $g?>&o=<?php $o=$p+4; if ($o >$nombreResultat-1) {$o=$p; echo $o;} else echo $o;?>#partenaire">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>


</nav>

</div>
<?php include('footer.php'); ?>      
<?php ob_flush(); ?>