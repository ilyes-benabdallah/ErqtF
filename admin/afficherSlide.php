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
   <div class="text-left" href="#slide">
	<h3>Slides <small>Nos slides</small></h3>

	 
	
	
	
	<ul class="nav nav-tabs" role="tablist">
			<li class="<?php  if ($g=="KFTM0CF1K") echo "active"; else echo " "; ?>"><a href="afficherSlide.php?g=KFTM0CF1K#slide">Tous</a></li>
			  <form action="afficherSlide.php#slide" method="POST">
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
				<th class="">lien</th>
	
				<th class="" style="width: 240px;">Action</th>
			</tr>
		</thead>
		
		<tbody>
		<?php 
		
		if($g=="KFTM0CF1K")
		{
		$f=4;
		$getNbrSlide = mysql_query("SELECT * FROM slide ") or die(mysql_error());
		$getSlide = mysql_query("SELECT * FROM slide ORDER BY date_slide DESC LIMIT $p, $f " ) or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrSlide);
		}
	
		else
		{
		$f=4;
		$getNbrSlide = mysql_query("SELECT * FROM slide WHERE lien_slide LIKE '%".$g."%' ") or die(mysql_error());
		$getSlide = mysql_query("SELECT * FROM slide WHERE lien_slide  LIKE '%".$g."%'  ORDER BY date_slide DESC LIMIT $p, $f") or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrSlide);
		}
		
			while($slide= mysql_fetch_array($getSlide))
			{
				
				$IDSlide = $slide['id_slide'];
				$imageSlide = $slide['image_slide'];
				$lienSlide = $slide['lien_slide'];
				
				
				if(isset($_POST["modifierbutton".$IDSlide]))
				{
				$lien= $_POST["lien".$IDSlide];
				$requeteModifier = mysql_query("UPDATE slide SET lien_slide='$lien' WHERE id_slide='$IDSlide ' ") or die(mysql_error());
				
				header("location:afficherSlide.php?g=".$g."&o=".$p."#slide");
				}
				
				
				if(isset($_POST["supprimerbutton".$IDSlide]))
				{
				$file_name = '../image/slider/'.$imageSlide; //nom de ton fichier ici.
				unlink("../image/slider/".$imageSlide);
				$requette = mysql_query("DELETE FROM slide WHERE id_slide='$IDSlide'") or die(mysql_error());
				
				header("location:afficherSlide.php?g=".$g."&o=".$p."#slide");
				}
				
		?>	
		<form action="afficherSlide.php?g=<?php echo $g; ?>&o=<?php echo $p; ?>#slide" method="POST" >
		<tr>
			
			<td><img  src="../image/slider/<?php echo $imageSlide;?>" width="350px;" height="120;"></td>
	
			<td><?php echo $lienSlide;?></td>
			
			<td> 
				<button type="button" class="btn btn-success" onclick="window.location.replace('modifierPhotoSlide.php?monpro=<?php echo $IDSlide; ?>#slide');" >Modifier image</button> &nbsp;
				<button type="button" class="btn btn-success" onclick="$('#mod<?php echo $IDSlide; ?>').toggle('slow');">Modifier lien</button> &nbsp;
				<img  src="images/del.png" onclick="$('#sup<?php echo $IDSlide; ?>').toggle('slow');" style="cursor: pointer;" />
			</td>
		</tr>
		<tr class="info" id="mod<?php echo $IDSlide; ?>" style="display: none;">
			<td colspan="2"> <input type="text" class="form-control" id="exampleInputEmail1" name="lien<?php echo $IDSlide; ?>" value="<?php if(isset($_POST["modifierbutton".$IDSlide])) echo ($_POST["modifierbutton".$IDSlide]); else echo $lienSlide;  ?> "placeholder="Enter le lien"></td>
			<td  style="width: 240px;"><button type="submit" class="btn btn-info"  name="modifierbutton<?php echo $IDSlide; ?>" >Oui, je modifie !</button></td>
		</tr>
		<tr class="danger" id="sup<?php echo $IDSlide; ?>" style="display: none;">
			<td colspan="2"> Vous êtes sur de vouloir supprimer ce slide ?</td>
			<td  style="width: 240px;"><button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDSlide; ?>" >Oui, je supprime !</button></td>
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
    <li class="<?php echo $classPager;?>"><a href="afficherSlide.php?g=<?php echo $g?>&o=<?php $o=$p-4; if ($o<0) {$o=0; echo $o;} else echo $o;?>#slide" ><span aria-hidden="true">&larr;</span> Previous</a></li>
    <li class="<?php echo $classPager1;?>"><a href="afficherSlide.php?g=<?php echo $g?>&o=<?php $o=$p+4; if ($o >$nombreResultat-1) {$o=$p; echo $o;} else echo $o;?>#slide">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>


</nav>

</div>
<?php include('footer.php'); ?>      
<?php ob_flush(); ?>