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
   <div class="text-left" href="#solution">
	<h3>Slotions <small>Nos solutions</small></h3>

	 
	
	
	
	<ul class="nav nav-tabs" role="tablist">
	  <li class="<?php  if ($g=="KFTM0CF1K") echo "active"; else echo " "; ?>"><a href="afficherSolution.php?g=KFTM0CF1K#solution">Tous</a></li>
	  
			  <form action="afficherSolution.php#solution" method="POST">
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
				<!--th class="">contenu</th-->
				
				<th class="" style="width: 140px;">Action</th>
			</tr>
		</thead>
		
		<tbody>
		<?php 
		
		if($g=="KFTM0CF1K")
		{
		$f=4;
		$getNbrSolution = mysql_query("SELECT * FROM solution ") or die(mysql_error());
		$getSolution = mysql_query("SELECT * FROM solution ORDER BY date_solution DESC LIMIT $p, $f " ) or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrSolution);
		}
		
		else
		{
		$f=4;
		$getNbrSolution = mysql_query("SELECT * FROM solution WHERE titre_solution LIKE '%".$g."%' or contenu_solution LIKE '%".$g."%'") or die(mysql_error());
		$getSolution = mysql_query("SELECT * FROM solution WHERE titre_solution  LIKE '%".$g."%' or contenu_solution LIKE '%".$g."%' ORDER BY date_solution DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrSolution);
		}
		
			while($solution= mysql_fetch_array($getSolution))
			{
				
				$IDSolution = $solution['id_solution'];
				$photoSolution = $solution['image_solution'];
				$intituleSolution = $solution['titre_solution'];
				$contenuSolution = $solution['contenu_solution'];
				$contenuSolution= substr($contenuSolution ,0,170);
		
				
				if(isset($_POST["supprimerbutton".$IDSolution]))
				{
				$file_name = '../image/solution/'.$photoSolution; //nom de ton fichier ici.
				unlink("../image/solution/".$photoSolution);
				$requette = mysql_query("DELETE FROM solution WHERE id_solution='$IDSolution'") or die(mysql_error());
				
				header("location:afficherSolution.php?g=".$g."&o=".$p."#solution");
				}
				
		?>	
		<form action="afficherSolution.php?g=<?php echo $g; ?>&o=<?php echo $p; ?>#solution" method="POST" >
		<tr>
			
			<td><img  src="../image/solution/<?php echo $photoSolution;?>" width="100px;" height="100px;"></td>
			<td><?php echo $intituleSolution;?></td>
			<!--td><?php //echo $contenuSolution;?></td-->
			
			
			<td> 
				<button type="button" class="btn btn-success" onclick="window.location.replace('modifierSolution.php?solution=<?php echo $IDSolution; ?>#solution');" >Modifier</button> &nbsp;
				<img  src="images/del.png" onclick="$('#sup<?php echo $IDSolution; ?>').toggle('slow');" style="cursor: pointer;" />
			</td>
		</tr>
		<tr class="danger" id="sup<?php echo $IDSolution; ?>" style="display: none;">
			<td colspan="2"> Vous êtes sur de vouloir supprimer cette solution?</td>
			<td  colspan=""><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDSolution; ?>" >Oui, je supprime !</button></td>
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