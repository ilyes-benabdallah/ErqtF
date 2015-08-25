<?php ob_start(); ?>
<?php
include('load.php');



if(isset($_GET['o'])) $p=$_GET['o'];
else $p=0;


?>
   <div class="text-left" href="#slide">
	<h3>Gallery <small>Nos photos</small></h3>

	 
	

		<?php 
		
		
		$f=4;
		$getNbrGallery = mysql_query("SELECT * FROM gallery ") or die(mysql_error());
		$getGallery = mysql_query("SELECT * FROM gallery ORDER BY date_gallery DESC LIMIT $p, $f " ) or die(mysql_error());
		$nombreResultat=mysql_num_rows($getNbrGallery);
		?>
		<span class="label label-danger">(<?php echo $nombreResultat?>) elements</span>
		<?php 
			while($gallery= mysql_fetch_array($getGallery))
			{
				
				$IDGallery = $gallery['id_gallery'];
				$imageGallery = $gallery['image_gallery'];
				
				
				
				
				if(isset($_POST["supprimerbutton".$IDGallery]))
				{
				$file_name = '../image/gallery/'.$imageGallery; //nom de ton fichier ici.
				unlink("../image/gallery/".$imageGallery);
				$requette = mysql_query("DELETE FROM gallery WHERE id_gallery='$IDGallery'") or die(mysql_error());
				
				header("location:afficherGallery.php?o=".$p."#gallery");
				//echo "<script>window.location.replace('afficherGallery.php?o='.$p.'#gallery');</script>";
				}
				
		?>	
		<table class="table table-hover" width="400 px;">

			
			<tbody>
			<form action="afficherGallery.php?o=<?php echo $p; ?>#gallery" method="POST" >
				<tr >
					
					<td><img  src="../image/gallery/<?php echo $imageGallery;?>" width="350px;" height="120;"></td>
					<td> 
				
						<img  src="images/del.png" onclick="$('#sup<?php echo $IDGallery; ?>').toggle('slow');" style="cursor: pointer;" />
					</td>
			
				</tr>
				
			
				<tr class="danger" id="sup<?php echo $IDGallery; ?>" style="display: none;">
					<td colspan=""> Vous êtes sur de vouloir supprimer cette image ? &nbsp; </td>
					<td colspan=""> <button type="submit" class="btn btn-danger"  name="supprimerbutton<?php echo $IDGallery; ?>" >Oui, je supprime !</button></td>
					
				</tr>
			</form>
			</tbody>
		</table>

		<?php 	
				
			}
			

			if($p==0) $classPager="disabled"; else $classPager=""  ;
			if($p+4>$nombreResultat-1) $classPager1="disabled"; else $classPager1=""  ;

		?>
		
		

<nav>
  <ul class="pager">
    <li class="<?php echo $classPager;?>"><a href="afficherGallery.php?o=<?php $o=$p-4; if ($o<0) {$o=0; echo $o;} else echo $o;?>#gallery" ><span aria-hidden="true">&larr;</span> Previous</a></li>
    <li class="<?php echo $classPager1;?>"><a href="afficherGallery.php?o=<?php $o=$p+4; if ($o >$nombreResultat-1) {$o=$p; echo $o;} else echo $o;?>#gallery">Next <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>


</nav>

</div>
<?php
include('footer.php');
?>
<?php ob_flush(); ?>
