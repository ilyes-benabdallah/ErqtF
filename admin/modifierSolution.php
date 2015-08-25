<?php
include('load.php');
if(isset($_GET['solution']))
{
	$maSolution=$_GET['solution'];
	$maSolution = mysql_real_escape_string($maSolution); 
	$getSolution = mysql_query("SELECT * FROM solution WHERE id_solution='$maSolution'") or die(mysql_error());
	$nombreResultat=mysql_num_rows($getSolution);
	
	
	if($nombreResultat==0)
	{
	echo ("<p class='bg-danger'>Solution introuvable.</p>");
	}
	else
	{
	$solution= mysql_fetch_assoc($getSolution);
	$IDSolution = $solution['id_solution'];
	$titreSolution = $solution['titre_solution'];
	$contenuSolution = $solution['contenu_solution'];	
	$imageSolution = $solution['image_solution'];			
			 
	
			if (isset ($_POST['modifier']))
			{
			$titreSolution = $_POST['titreSolution'];
			$contenuSolution= $_POST['contenuSolution'];
		
			
				if(empty($titreSolution) || $titreSolution==null || $titreSolution=="")
				{
				echo ("<p class='bg-danger'>Veuillez saisir le titre de la solution.</p>");
				}
				elseif(empty($contenuSolution) || $contenuSolution==null || $contenuSolution=="")
				{
				echo ("<p class='bg-danger'>Veuillez saisir le contenu de la solution.</p>");
				}
				else
				{
				
						
						$updateProduit=mysql_query ("
						UPDATE solution
						SET 
						titre_solution='$titreSolution', 
						contenu_solution='$contenuSolution'
						
						WHERE id_solution ='$IDSolution' ");
						
					
			
				}


			}
			?>	
  <div class="text-left" href="#solution">
	<h3>Solutions <small>Modifier la solution</small> <small><a href="modifierPhotoSolution.php?solution=<?php echo $maSolution; ?>#solution"><span class="label label-primary">Modifier l'image de la solution</span></a></small></h3>
	<br>
				
				<div>

				<form action="modifierSolution.php?solution=<?php echo $maSolution; ?>#solution" enctype="multipart/form-data" method="POST">
						<div class="form-group form1">
							<div class="input-group" >
								<div class="input-group-addon">Titre</div>
								<input class="form-control" type="text" name="titreSolution" value="<?php  if (isset($_POST["titreSolution"])) echo $_POST["titreSolution"]; else echo$titreSolution; ?>" placeholder="Saisir le titre de la solution">
							</div>
						</div> 
						 
				
						
						<div class="form1">
							<div class="input-group-addon">Contenu </div>
							<textarea  id="description" name="contenuSolution" class="form-control" rows="3" cols="80"  placeholder="Ajouter votre description ici"><?php  if (isset($_POST["contenuSolution"])) echo $_POST["contenuSolution"]; else echo $contenuSolution;?></textarea>
						</div>
						<script>
						// Replace the <textarea id="description"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'description' );
						</script>
						<br>
					
						
					
					<br><br>
					<div class="form1">
					<button type="submit" name="modifier" class="btn btn-primary btn-block" >Modifier solution</button>
					</div>
				</form>
				</div>
				
				
				
				
				<?php
	}
}
else echo ("<p class='bg-danger'>Erreur! Veiller selectionner une solution.</p>");
				?>
</div>
 <?php include('footer.php'); ?> 