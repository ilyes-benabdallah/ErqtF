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
		
		
		if(isset($_GET['o'])) $p=$_GET['o'];
		else $p=0;
		
		
		$f=6;
		$getNbrActualite= mysql_query("SELECT * from actualite WHERE statut_actualite='1'") or die (mysql_error());
		$getActualite = mysql_query("SELECT * FROM actualite WHERE statut_actualite='1' ORDER BY date_actualite DESC LIMIT $p, $f " ) or die(mysql_error());
		$nombreResultat = mysql_num_rows($getNbrActualite);
		

		while($actualite=mysql_fetch_array($getActualite))
		{
			$IDActualite=$actualite['id_actualite'];
			$titreActualite=$actualite['titre_actualite'];
			$contenuActualite=$actualite['contenu_actualite'];
			$contenuActualite= substr($contenuActualite,0,140)." ..." ;
			$imageActualite=$actualite['image_actualite'];
		?>
			<div class="product-list">
			<div class="left">
		
				<div class="image"><a href="actualite.php?actualite=<?php  echo $IDActualite; ?>"><img src="image/actualite/<?php  echo $imageActualite; ?>" title="iPad Classic" alt="iPad Classic" width="162px" height="100px"/></a></div>
				<div class="name"><a href="actualite.php?actualite=<?php  echo $IDActualite; ?>"><?php  echo $titreActualite; ?></a></div>
				<div class="description"><?php  echo $contenuActualite; ?></div>
				 
				<div class="cart">
					<input type="button" class="button" value=" Lire " onclick="window.location.replace('actualite.php?actualite=<?php  echo $IDActualite; ?>')">
				   
				</div>
			</div>
			</div>
		<?php
		
		}
		if($p==0) {$classPager=""; $classFinPager="";} else {$classPager="<b>"; $classFinPager="</b>";} 
		if($p+6>$nombreResultat-1) {$classPager1=""; $classFinPager1="";} else {$classPager1="<b>"; $classFinPager1="</b>";}  
		?>
		
		  <!--Pagination Part Start-->
        <!--div class="pagination">
          <div class="links"><a href="afficherActualite.php?o=<?php// $o=$p-6; if ($o<0) {$o=0; echo $o;} else echo $o;?>"><?php //echo $classPager;?>Précedent<?php //echo $classFinPager;?></a> &nbsp; &nbsp; <a href="afficherActualite.php?o=<?php $o=$p+6; if ($o >$nombreResultat-1) {$o=$p; echo $o;} else echo $o;?>"><?php echo $classPager1;?>Suivant<?php echo $classFinPager1;?></a> </div>
          
        </div-->
        <!--Pagination Part End-->

</div>
</div>






<?php 
include('footer.php');

?>
