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
   <div class="text-left" href="#actualite">
	<h3>Actualités <small>Nos actualités</small></h3>

	 
	
	
	
	<ul class="nav nav-tabs" role="tablist">
	  <li class="<?php  if ($g=="KFTM0CF1K") echo "active"; else echo " "; ?>"><a href="afficherActualite.php?g=KFTM0CF1K#actualite">Tous</a></li>
	  <li class="<?php  if ($g=="KFTM1CF1K") echo "active"; else echo " ";  ?>"><a href="afficherActualite.php?g=KFTM1CF1K#actualite">Publier</a></li>
	  <li class="<?php  if ($g=="KFTM2CF1K") echo "active"; else echo " "; ?>"><a href="afficherActualite.php?g=KFTM2CF1K#actualite">Broullion</a></li>
	  
			  <form action="afficherActualite.php#actualite" method="POST">
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
				<th class="">titre</th>
				<!--th class=""style="width: 340px;">contenu</th-->
				<th class="">statut</th>
				
				<th class="" style="width: 140px;">Action</th>
			</tr>
		</thead>
		
		<tbody>
		<?php 
		
		if($g=="KFTM0CF1K")
		{
		$f=4;
		$getNbrActualite = mysql_query("SELECT * FROM actualite ") or die(mysql_error());
		$getActualite = mysql_query("SELECT * FROM actualite ORDER BY date_actualite DESC LIMIT $p, $f " ) or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrActualite);
		}
		elseif($g=="KFTM1CF1K")
		{
		$f=4;
		$getNbrActualite = mysql_query("SELECT * FROM actualite WHERE statut_actualite='1'") or die(mysql_error());
		$getActualite = mysql_query("SELECT * FROM actualite WHERE statut_actualite='1' ORDER BY date_actualite DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrActualite);
		
		}
		elseif($g=="KFTM2CF1K")
		{
		$f=4;
		$getNbrActualite = mysql_query("SELECT * FROM actualite WHERE statut_actualite='promotion'") or die(mysql_error());
		$getActualite = mysql_query("SELECT * FROM actualite WHERE statut_actualite='promotion' ORDER BY date_actualite DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrActualite);
		
		
		}
		
		else
		{
		$f=4;
		$getNbrActualite = mysql_query("SELECT * FROM actualite WHERE titre_actualite LIKE '%".$g."%'") or die(mysql_error());
		$getActualite = mysql_query("SELECT * FROM actualite WHERE  titre_actualite LIKE '%".$g."%' ORDER BY date_actualite DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrActualite);
		}
		
			while($actualite= mysql_fetch_array($getActualite))
			{
				
				$IDActualite = $actualite['id_actualite'];
				$titreActualite = $actualite['titre_actualite'];
				$imageActualite = $actualite['image_actualite'];
				$contenuActualite = $actualite['contenu_actualite'];
				$contenuActualite = substr($contenuActualite, 0, 150)."         ..."; 
				$statutActualite = $actualite['statut_actualite'];
				
				
				if(isset($_POST["supprimerbutton".$IDActualite]))
				{
				$file_name = '../image/actualite/'.$imageActualite; //nom de ton fichier ici.
				unlink("../image/actualite/".$imageActualite);
				$requette = mysql_query("DELETE FROM actualite WHERE id_actualite='$IDActualite'") or die(mysql_error());
				
				header("location:afficherActualite.php?g=".$g."&o=".$p."#actualite");
				//echo "<script>window.location.replace('afficherActualite.php?g='$g'&o='$p'#actualite');</script>";
				
				}
				
		?>	
		<form action="afficherActualite.php?g=<?php echo $g; ?>&o=<?php echo $p; ?>#actualite" method="POST" >
		<tr>
			
			<td><img  src="../image/actualite/<?php echo $imageActualite;?>" width="100px;" height="100px;"></td>
			<td><?php echo $titreActualite;?></td>
			<!--td style="width: 340px;"><?php //echo $contenuActualite;?></td-->
			
			<td class="<?php if($statutActualite=="0") echo"danger"; elseif($statutActualite=="1") echo"success"; else echo"";?>" ><?php if($statutActualite=="0") echo"Broullion"; elseif($statutActualite=="1") echo"Publier";?></td>
			<td> 
				<button type="button" class="btn btn-success" onclick="window.location.replace('modifierActualite.php?monact=<?php echo $IDActualite; ?>#actualite');" >Modifier</button> &nbsp;
				<img  src="images/del.png" onclick="$('#sup<?php echo $IDActualite; ?>').toggle('slow');" style="cursor: pointer;" />
			</td>
		</tr>
		<tr class="danger" id="sup<?php echo $IDActualite; ?>" style="display: none;">
			<td colspan="3"> Vous êtes sur de vouloir supprimer ce actualite ?</td>
			<td  style="width: 140px;"><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDActualite; ?>" >Oui, je supprime !</button></td>
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
    <li class="<?php echo $classPager;?>"><a href="afficherActualite.php?g=<?php echo $g?>&o=<?php $o=$p-4; if ($o<0) {$o=0; echo $o;} else echo $o;?>#actualite" ><span aria-hidden="true">&larr;</span> Previous</a></li>
    <li class="<?php echo $classPager1;?>"><a href="afficherActualite.php?g=<?php echo $g?>&o=<?php $o=$p+4; if ($o >$nombreResultat-1) {$o=$p; echo $o;} else echo $o;?>#actualite">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>


</nav>

</div>
<?php include('footer.php'); ?>      
<?php ob_flush(); ?>