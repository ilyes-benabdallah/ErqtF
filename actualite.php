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
	if (isset($_GET['actualite']))
	{
		$monActualite= $_GET['actualite'];
		$monActualite=mysql_real_escape_string($monActualite);
		
		$requeteActualite=mysql_query("SELECT * FROM actualite WHERE id_actualite='$monActualite' ") or die(mysql_query());
		$existeActualie=mysql_num_rows($requeteActualite);
		if($existeActualie==0) echo ("<p class='bg-danger'>Actualité introuvable.</p>");
		else
		{
			$actualite=mysql_fetch_assoc($requeteActualite);
			$IDActualite=$actualite['id_actualite'];
			$titreActualite=$actualite['titre_actualite'];
			$contenuActualite=$actualite['contenu_actualite'];
			$imageActualite=$actualite['image_actualite'];

	?>

			<h1><?php echo $titreActualite ;?></h1>
			<div style="max-width:720px; min-width:300px; position:relative;">
				<img class="imageActualite" src="image/actualite/<?php echo $imageActualite ;?> " style="width:100%;" >
			</div>
			<br>
			<div>
			<?php echo $contenuActualite ;?>
			</div>
	<?php 
		}
	}
	else echo ("<p class='bg-danger'>Actualité introuvable.</p>");
	?>


</div>

<?php 
include('footer.php');

?>
